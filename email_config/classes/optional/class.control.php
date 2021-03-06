<?php
class control {
	var $table;
	var $db;
	
	function control($table = ''){
		$this->db = new dbMn();
		$this->db->query("SET NAMES utf8");
		$this->table = $table;
	}
	
	
	function combo($field, $update="", $attr = ''){
		$res = "<select name='{$field}' id='{$field}' {$attr}>\n";
		$res .= "\t<option value='0'>Selecciona un valor</option>\n";
		
		$arr = explode("_",$field);
		$table = $arr[1];
		$query = "select {$field}, {$table} from $table";
		
		$rows = $this->db->get_results($query);
		foreach($rows as $row){
			$selected = $this->selected($row->$field, $update);
			$res .= "\t<option {$selected} value='{$row->$field}'>{$row->$table}</option>\n";
		}
		
		$res .= "</select>";
		return $res;
	}
	
	function comborel($table1, $table2, $id, $update="", $attr = ''){
		$res = "<select name='id_{$table2}' id='id_{$table2}' {$attr}>\n";
		$res .= "\t<option value='0'>Selecciona un valor</option>\n";
		
		$query = "select {$table2}.id_{$table2} as id, {$table2}.{$table2} from $table2 inner join {$table1}_{$table2} on {$table1}_{$table2}.id_{$table2} = {$table2}.id_{$table2} where {$table1}_{$table2}.id_{$table1} = {$id}";
		
		$rows = $this->db->get_results($query);
		foreach($rows as $row){
			$selected = $this->selected($row->id, $update);
			$res .= "\t<option {$selected} value='{$row->id}'>{$row->$table2}</option>\n";
		}
		
		$res .= "</select>";
		return $res;
	}
	
	function combomes($idname, $update="", $attr=''){
		$res = "<select name='{$idname}' id='{$idname}' {$attr}>\n";
		$res .= "\t<option value='0'>mes</option>\n";
		
		$rows[1] = "Enero";
		$rows[2] = "Febrero";
		$rows[3] = "Marzo";
		$rows[4] = "Abril";
		$rows[5] = "Mayo";
		$rows[6] = "Junio";
		$rows[7] = "Julio";
		$rows[8] = "Agosto";
		$rows[9] = "Septiembre";
		$rows[10] = "Octubre";
		$rows[11] = "Noviembre";
		$rows[12] = "Diciembre";
		
		foreach($rows as $key=>$value){
			$selected = $this->selected($key, $update);
			$res .= "\t<option {$selected} value='$key'>{$value}</option>\n";
		}
		
		$res .= "</select>";
		return $res;		
	}

	function comboanio($idname, $update="", $attr=''){
		$res = "<select name='{$idname}' id='{$idname}' {$attr}>\n";
		$res .= "\t<option value='0'>año</option>\n";
		
		$rows = $this->nums(2000,2020);
		
		foreach($rows as $row){
			$selected = $this->selected($row, $update);
			$res .= "\t<option {$selected} value='{$row}'>{$row}</option>\n";
		}
		
		$res .= "</select>";
		return $res;		
	}
	
	function combodia($idname, $update="", $attr=''){
		$res = "<select name='{$idname}' id='{$idname}' {$attr}>\n";
		$res .= "\t<option value='0'>día</option>\n";
		
		$rows = $this->nums(1,31);
		
		foreach($rows as $row){
			$selected = $this->selected($row, $update);
			$res .= "\t<option {$selected} value='{$row}'>{$row}</option>\n";
		}
		
		$res .= "</select>";
		return $res;
	}
	
	function checkbox($field, $cols = 3){
		$res = "<table cellpading='0' cellspacing='0' border='0' style='font-size:12px;font:verdana'>\n";
		
		$arr = explode("_",$field);
		$table = $arr[1];
		$query = "select {$field}, {$table} from $table";

		$rows = $this->db->get_results($query);
		$tot = count($rows);
		
		$tmpx = 0;
		while($tmpx < $tot) {
			$tmpy = 1;
			$res .= "<tr>\n";
			
			while(list($x,$row) = each($rows)){
				$res .= "<td>\n";
				$res .= "<input type='checkbox' value='{$row->$field}' name='{$field}[]'>" . $row->$table;
				$res .= "</td>\n";
				$tmpy++;
				
				if($tmpy > $cols) {
					$tmpy = 0;
					break;
				}
			}
			
			$res .= "</tr>\n";
			$tmpx++;
		}
		
		$res .= "</table>\n";
		return $res;
	}
	
	function comboTxtList($field, $update=array(), $attr=""){
		$attr .= " id='{$field}' onChange=\"$('#comboTxtLst').append('<span><input checked type=\\'checkbox\\' value=\\'' + $(this).val() + '\\' name=\\'{$field}[]\\' /><b>' + $('#{$field} option:selected').text() + '</b><br/></span>').fadeIn();\"";
		
		if(count($update) > 0){
			$_field = str_replace("id_","",$field);
			$res = $this->combo($field,$update[count($update) - 1], $attr);
			
			foreach($update as $id){
				$value = $this->db->get_var("select {$_field} from {$_field} where {$field} = {$id}");
				$res .= "<br/><span><input checked type='checkbox' value='{$id}' name='{$field}[]' /><b>{$value}</b></span>";
			}
		} else {
			$res = $this->combo($field,"", $attr);
		}
		
		$res .= "<div id='comboTxtLst'></div>";
		
		return $res;
	}
	
	function listTable($fields, $table, $qry="", $attr=""){
		$res = "<table>";
		$res .= "<tr>";
		
		$qry = "select ";
		
		foreach($fields as $field){
			$_title = $field["title"];
			$_field = $field["field"];
			
			$qry .= "{$_field}, ";
			$res .= "<td>{$_title}</td>";
		}
		
		$qry = substr($qry, -2);
		$res .= "</tr>";
		$qry .= " from {$table}";
		
		$rows = $this->db->get_results($qry);
		echo $qry;
	}
	
function selected($id_selected, $id_tocheck, $type = "selected", $default=false){
	if($id_selected == $id_tocheck){
		return $type;
	}
	else {
		if($default && !isset($_GET["action"])){
			return $type;
		}
		else
			return;
	}
}
	
	function nums($y,$z){
		for($x=$y;$x<=$z;$x++)
			$res[] = $x;
			
		return $res;
	}
}