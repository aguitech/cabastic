<?php
/**
*		@name Abstract db class
* 
*		Original code from:
*		@author 	Daniel Rosiles (daniel@rosiles.com.mx)
*					http://www.daniel.rosiles.com.mx
*
*		Dependencias:
*		@uses 		class.sql.php - ez_sql MySql Management class.
* 		@uses 		functions.php - daniel rosiles personal functions.
* 		@uses 		config.php - trademarketing config file.
*/

class db extends dbMn {
	var $table;
	var $drop_tables;
	var $fields;
	var $get_query;
	var $tmp_query;
	var $required_fields; //array con campos requeridos al insertar datos
	var $fields_exist_value; //array con campos qno permiten insertar valores repetidos en un campo
	var $fields_default_values; //array con campos a los cuales insertarles un valor de manera automatica al agregar registro
	var $error_info;
	var $form_type_field; //array especificando el tipo de campo a usar.
	var $form_field_filter; //arrays especificando que campos no usar en el formulario.
	var $list_field_remove; //array especificando que campos se eliminar del listado (admin)
	var $form_field_remove; //array especificando que campos se eliminar del formulario (admin)
	var $multipe; //objeto con relacion 1 muchos respecto al objeto actual
	
	// ** Paging vars ** //
	var $koneksi;
	var $p;
	var $page;
	var $pageinfo; //$page[start] - $page[end] de $page[total] [Total $page[total_pages] Paginas]
	var $q;
	var $next;
	var $prev;
	var $number;
	var $link;
	// ** End Paging vars ** //
	
	function db(){
		$this->dbMn();
		$this->table = get_parent_class($this);
		if($this->table == "db")
			$this->table = get_class($this);

		$this->query("SET NAMES utf8");
		//$this->get_query = "select * from $this->table order by id_$this->table desc";
		$this->get_query = "select * from $this->table";
		
		$this->drop_tables = array($this->table);
		$this->tmp_query = "show fields from $this->table";
		
		$_fields = $this->get(0,true);
		foreach($_fields as $_field){
			if(!($_field["Field"] == "id_".$this->table))
				$this->fields[$_field["Field"]] = $_field["Type"];
		}
		
		$this->required_fields = array();
		$this->fields_exist_value = array();
	}
	
	function drop($id) {
		if(!is_numeric($id))
			return false;
			
		$table = $this->table;
		
		foreach($this->drop_tables as $drop_table) {
			$sql = "delete from $drop_table where id_$table = $id";
			$this->query($sql);
		}
	}
	
	function get($id = 0, $tmp_query = false){
		if(!is_numeric($id))
			return false;
		
		if($tmp_query)
			$sql = $this->tmp_query;
		else 
			$sql = $this->get_query;
			
		$table = $this->table;
		$result = array();
			
		if($id == 0) {
			$result = $this->get_results($sql, ARRAY_A);
		} else {
			$sql = "select * from $table where id_$table = $id order by id_$table desc";
			$result = $this->get_row($sql, ARRAY_A);
		}
		
		if(empty($result))
			$result = array();
			
		return $result;
	}
	
	function get_lastid(){
		$id = $this->get_var("select id_$this->table from $this->table order by id_$this->table desc limit 1");
		return $id;
	}
	
	function update($id, $fields){
		if(!is_numeric($id))
			return false;
		
		$table = $this->table;
		$values = "";
			
		while(list($key, $value) = each($fields)){
			$tmpValue = $this->formatField($key, $value, true);
			if(!is_numeric($tmpValue) && empty($tmpValue))
				continue;
			
			$values .= "$key = $tmpValue, ";
		}
		
		$values = substr($values, 0, strlen($values) - 2);
		$sql = "update $table set $values where id_$table = $id";
		
		if(strlen($values)>0)
			$this->query($sql);
	}
	
	function add($fields){
		$table = $this->table;
		$keys = "";
		$values = "";
		
		while(list($key,$value) = each($this->fields_default_values)){
			if(!in_array($key,$fields))
				$fields[$key] = $value;
		}

		while(list($key, $value) = each($fields)){
			$keys .= $key.",";
			$values .= $this->formatField($key, $value).",";
			
			if(in_array($key,$this->fields_exist_value)){
				$tmpvalue = $this->formatField($key, $value);
				if(!(strpos(substr($tmpvalue,0,1),"'") === false))
					$oper = "like";
				else 
					$oper = "=";
				if($this->existvalue("select $key from $this->table where $key $oper $tmpvalue limit 1")){
					$this->error_info = "El registro $value ya existe";
					return 0;	
				}
			}
			if(in_array($key, $this->required_fields)){
				if(empty($value)){
					$this->error_info = "Es necesario un valor en el campo $key para agregar el registro.";
					return 0;
				}
			}
		}
		
		foreach($this->required_fields as $tmpfield){
			if(!array_key_exists($tmpfield, $fields)){
				$this->error_info = "Es necesario un valor en el campo $key para agregar el registro.";
				return 0;				
			}
		}
		
		$keys = substr($keys, 0, strlen($keys) - 1);
		$values = substr($values, 0, strlen($values) - 1);
		
		$sql = "insert into $table($keys) values($values)";

		if(strlen($values)>0)
			$this->query($sql);
		
		$this->last_query = $sql;
		return 1;
	}
	
	function existvalue($query){
		$res = $this->get_var($query);
		if(empty($res))
			return false;
		else
			return true;
	}
	
	function formatField($key, $value, $update = false) {
		$result = null;

		if(!(strpos($this->fields[$key],"int") === false)){
			if(is_numeric($value))
				$result = $value;
			else  {
				$result = "0";
				if($update)
					$result = null;
			}
		}
		else {
			if(empty($value) && !($value === "0")){
				$result = "''";
				if($update)
					$result = null;
			}
			else 
				$result = "'$value'";
		}
			
		return $result;
	}
	
	function postArray($count = null){
		$result = array();
		
		if(empty($count) && !($count === 0)){
			while(list($key, $value) = each($this->fields)){
				if(isset($_POST[$key]))
					$result[$key] = validField($_POST[$key], $this->fields[$key]);
				else 
					$result[$key] = null;
			}
		} else {
			while(list($key, $value) = each($this->fields)){
				if(isset($_POST[$key][$count]))
					$result[$key] = validField($_POST[$key][$count], $this->fields[$key]);
				else 
					$result[$key] = null;
			}
			reset($this->fields);
		}
		
		return $result;
	}
	
	function getArray(){
		$result = array();
		
		while(list($key, $value) = each($this->fields)){
			if(isset($_GET[$key])) {
				$result[$key] = validField($_GET[$key], $this->fields[$key]);
			}
			else 
				$result[$key] = null;
		}
		
		return $result;
	}
	
	function updateArray($id){
		$results = $this->get($id);
		$result = array();
		reset($this->fields);
		
		while(list($key, $value) = each($this->fields)){
			$result[$key] = $results[$key];
		}
		
		return $result;
	}
	
	function return_excel($archivo){
		header("Content-Type:  application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$archivo.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$results = $this->get();
		$count = 0;
		echo "<table>";
		foreach ($results as $result){
			echo "<tr align='center'>";
			while(list($x,$y) = each($result)){
				if($count == 0){
					echo "<td>$x</td>";
					$firsty[] = $y;
				}
				else
					echo "<td>$y</td>";
			}
			echo "</tr>";
			
			if($count == 0){
				echo "<tr align='center'>";
				foreach($firsty as $y)
					echo "<td>$y</td>";
				echo "</tr>";
			}
			
			$count++;
		}
		echo "</table>";
	}
	
	function return_json($condition, $valueCondition, $others = null){
		$field1 = "id_$this->table";
		$field2 = $this->table;

		if(!empty($others)){
			$field1 = $others[0];
			$field2 = $others[1];
		}
				
		$sql = "select $field1, RTRIM($field2) as $field2 from $this->table where $condition = $valueCondition";
		$sql = "select subdivision.id_subdivision, RTRIM(subdivision) as subdivision from subdivision inner join division_subdivision on division_subdivision.id_subdivision = subdivision.id_subdivision where division_subdivision.id_division = {$valueCondition}";
		$this->get_query = $sql;
		
		$results = $this->get();
		$result = "[";
		$count = 1;
		
		foreach($results as $_result){
			if($count > 1)
				$result .= ",";
			
			$result .= "{optionValue:" . $_result[$field1] . ", optionDisplay:'" . $_result[$field2]. "'}";
			$count++;
		}
		
		$result .= "]";
		return $result;
	}
	
	function validLogin($value1, $value2, $var1 = "usuario", $var2 = "password"){
		$sql = "select * from $this->table where $var1 like '$value1' and $var2 like '$value2' limit 1";
		$result = $this->get_row($sql, ARRAY_A);

		return $result;
	}
	
	function validLogin2($value1, $value2, $var1 = "usuario", $var2 = "password"){
		$sql = "select * from $this->table where $var1 like '$value1' and $var2 like '$value2' and (es_admin = 1 || es_admin2 = 1) limit 1";
		$result = $this->get_row($sql, ARRAY_A);

		return $result;
	}
	
	//** Paging functions **//

	function paging($baris=20, $langkah=5, $prev="anterior", $next="siguiente", $number="[%%number%%]")
	{
		$this->next=$next;
		$this->prev=$prev;
		$this->number=$number;
		$this->p["baris"]=$baris;
		$this->p["langkah"]=$langkah;
		$_SERVER["QUERY_STRING"]=preg_replace("/&page=[0-9]*/","",$_SERVER["QUERY_STRING"]);
		if (empty($_GET["page"])) {
			$this->page=1;
		} else {
			$this->page=$_GET["page"];
		}
		
		$this->db_paging(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$this->pquery($this->get_query);
		$this->pageinfo = $this->print_info();
	}

	function db_paging($host,$username,$password,$dbname)
	{
		$this->koneksi=mysql_connect($host, $username, $password) or die("Connection Error");
		mysql_select_db($dbname);
		return $this->koneksi;
	}

	function pquery($query)
	{
		if(isset($_GET["order"])){
			$query = $this->get_query;
			//$query = "select * from $this->table";
			$order = "order by ". $_GET["order"];
			$query .= " ".$order;
		}
		
		$kondisi=false;
		// only select
		if (!preg_match("/^[\s]*select*/i",$query)) {
			$query="select ".$query;
		}

		$querytemp = mysql_query($query);
		$this->p["count"]= mysql_num_rows($querytemp);

		// total page
		$this->p["total_page"]=ceil($this->p["count"]/$this->p["baris"]);

		// filter page
		if  ($this->page<=1)
			$this->page=1;
		elseif ($this->page>$this->p["total_page"])
			$this->page=$this->p["total_page"];

		// awal data yang diambil
		$this->p["mulai"]=$this->page*$this->p["baris"]-$this->p["baris"];

		$query=$query." limit ".$this->p["mulai"].",".$this->p["baris"];
		$this->get_query = $query;
	}

	function print_no()
	{
		$number=$this->p["mulai"]+=1;
		return $number;
	}
	
	function print_color($color1,$color2)
	{
		if (empty($this->p["count_color"]))
			$this->p["count_color"] = 0;
		if ( $this->p["count_color"]++ % 2 == 0 ) {
			return $color=$color1;
		} else {
			return $color=$color2;
		}
	}

	function print_info()
	{
		$page=array();
		$page["start"]=$this->p["mulai"]+1;
		$page["end"]=$this->p["mulai"]+$this->p["baris"];
		$page["total"]=$this->p["count"];
		$page["total_pages"]=$this->p["total_page"];
			if ($page["end"] > $page["total"]) {
				$page["end"]=$page["total"];
			}
			if (empty($this->p["count"])) {
				$page["start"]=0;
			}

		return $page;
	}

	function print_link($arr = false, $attr = false)
	{
		$link = array();
		$query_string = "";
		
		if(!empty($_SERVER["QUERY_STRING"])){
			foreach($_GET as $key => $value){
				if($key != "page" && $key != "x")
					$query_string .= $key."=".$value."&";
			}
			//$query_string = substr($query_string,0,strlen($query_string) - 1);
		}
		//generate template
		$print_link = false;

		if ($this->p["count"]>$this->p["baris"]) {

			// print prev
			if ($this->page>1){
				//$print_link .= "<a href=\"".$_SERVER["PHP_SELF"]."?".$query_string."page=".($this->page-1)."\">".$this->prev."</a>\n";
				//$link["prev"] = "<a $attr href=\"".$_SERVER["PHP_SELF"]."?".$query_string."page=".($this->page-1)."\">".$this->prev."</a>\n";
			} else {
				$link["prev"] = null;
			}

			// set number
			$this->p["bawah"]=$this->page-$this->p["langkah"];
				if ($this->p["bawah"]<1) $this->p["bawah"]=1;

			$this->p["atas"]=$this->page+$this->p["langkah"];
				if ($this->p["atas"]>$this->p["total_page"]) $this->p["atas"]=$this->p["total_page"];

			// print start
			if ($this->page<>1)
			{
				for ($i=$this->p["bawah"];$i<=$this->page-1;$i++)
					$print_link .="<a style='text-decoration:none'; href=\"".$_SERVER["PHP_SELF"]."?".$query_string."page=$i\">".$this->number2($i,$this->number)."</a>\n";
			}
			// print active
			if ($this->p["total_page"]>1)
				$print_link .= $this->number2($this->page,$this->number,true)."\n";

			// print end
			for ($i=$this->page+1;$i<=$this->p["atas"];$i++)
			$print_link .= "<a style='text-decoration:none;' href=\"".$_SERVER["PHP_SELF"]."?".$query_string."page=$i\">".$this->number2($i,$this->number)."</a>\n";

			// print next
			if ($this->page<$this->p["total_page"]){
				//$print_link .= "<a href=\"".$_SERVER["PHP_SELF"]."?".$query_string."page=".($this->page+1)."\">".$this->next."</a>\n";
				//$link["next"] = "<a $attr href=\"".$_SERVER["PHP_SELF"]."?".$query_string."page=".($this->page+1)."\">".$this->next."</a>\n";
			} else {
				$link["next"] = null;
			}

			if($arr)
				$this->link = $link;
			else
				return $print_link;
		}
	}
	
		function number2($i,$number,$ac=false)
		{
			//return ereg_replace("^(.*)%%number%%(.*)$","\\1$i\\2",$number);
			if($ac)
				return "<span class='link_num_activo'>$i</span>";
			else
				return "<span class='link_num'>$i</span>";
		}
	//** End Paging functions **//
}
?>