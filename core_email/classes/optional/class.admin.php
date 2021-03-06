<?php
class admin
{
	var $data;
	var $global;
	var $obj;
	var $list_fields;
	var $translate;
	
	function admin($global, $obj){
		$this->global = $global;
		$this->obj = $obj;
		$curpage = curpage();
		$this->translate = new translates($this->obj);
		
		if(curpage() == "listar.php"){
			foreach($obj->fields as $key=>$value){
				if(!in_array($key, $obj->list_field_remove))
					$this->list_fields[$key] =$value;
			}			
		}
		
		if(curpage() == "editar.php"){
			foreach($obj->fields as $key=>$value){
				if(!in_array($key, $obj->form_field_remove))
					$this->list_fields[$key] =$value;
			}		
		}
	}
	
	function replace_content($oldtable = null, $idoldtable = null){
		$table = get_class($this->obj);
		if(curpage() != "editar.php"){
			$this->obj = new $table();
		}
		$table = get_parent_class($this->obj);
		$table2 = get_class($this->obj);
		
		if($table == "db")
			$table = get_class($this->obj);
		
		$this->obj->paging(25);
		$items = $this->obj->get(0);
		$self = curpage();
		
		
		foreach($items as $item){
			$content .= "<tr>\n";
			$content .= "<th id='r85' scope='row' class='texto_general'>" . $this->obj->print_no() . "</th>\n";

			reset($this->list_fields);
			while(list($x,$y) = each($this->list_fields)){
				if(!(strpos($x,"id_") === false)){
					$_table = str_replace("id_","",$x);
					
					$_obj = new $_table();
					
					$_fields = $_obj->get($item[$x]);

					$content .= "<td class='texto_general'>" . $_fields[$_table] . "</td>\n";

				} else{
					if(empty($this->obj->flag_field[$x]))
						$content .= "<td class='texto_general'>" . $item[$x] . "</td>\n";
					else 
						$content .= "<td class='texto_general'>" . $this->obj->flag_field[$x][$item[$x]] . "</td>\n";
				}
			}

			if(empty($oldtable)){
				$content .= "<td><a href='./editar.php?action=edit&table=$table2&id=" . $item["id_" . $table] . "'><div align='center'>Editar</div></a></td>\n";
				$content .= "<td><a href='./$self?" . querystring("action=delete&table=$table2&id=" . $item["id_" . $table]) . "' onclick=\"return confirm('¿Estas seguro de querer eliminar esta {$this->translate->translate($table2)}?')\"><div align='center'>Eliminar</div></a></td>\n";
			}
			else{
				$content .= "<td><a href='./editar.php?action=edit&parentmultiple=$oldtable&parentid=$idoldtable&table=$table2&id=" . $item["id_" . $table] . "'>Editar</a></td>\n";
				$content .= "<td><a href='./$self?" . querystring("action=delete&redirect=true&parentmultiple=$oldtable&parentid=$idoldtable&table=$table2&id=" . $item["id_" . $table]) . "' onclick=\"return confirm('¿Estas seguro de querer eliminar esta {$this->translate->translate($table2)}?')\">Eliminar</a></td>\n";
			}
			$content .= "</tr>\n";
		}
		
		return $content;
	}
	
	function replace_content_view($oldtable = null, $idoldtable = null){
		$table = get_class($this->obj);
		if(curpage() != "editar.php"){
			$this->obj = new $table();			
		}

		$this->obj->paging(25);
		$items = $this->obj->get(0);
		$self = curpage();
		
		$content = "";
		foreach($items as $item){
			$content .= "<tr>\n";
			$content .= "<th id='r85' scope='row' class='texto_general'>" . $this->obj->print_no() . "</th>\n";

			reset($this->list_fields);
			while(list($x,$y) = each($this->list_fields)){
				if(!(strpos($x,"id_") === false)){
					$_table = str_replace("id_","",$x);
					
					$_obj = new $_table();
					
					$_fields = $_obj->get($item[$x]);
					$content .= "<td class='texto_general'>" . $_fields[$_table] . "</td>\n";
				} else
					$content .= "<td class='texto_general'>" . $item[$x] . "</td>\n";
			}

			if(empty($oldtable)){
				$content .= "<td><a href='./editar.php?action=edit&table=$table&id=" . $item["id_" . $table] . "' style='color:blue;'><div align='center'>Ver</div></a></td>\n";
			}
			else{
				$content .= "<td><a href='./editar.php?action=edit&parentmultiple=$oldtable&parentid=$idoldtable&table=$table&id=" . $item["id_" . $table] . "'>Ver</a></td>\n";
				$content .= "<td><a href='./$self?" . querystring("action=delete&redirect=true&parentmultiple=$oldtable&parentid=$idoldtable&table=$table&id=" . $item["id_" . $table]) . "' onclick=\"return confirm('¿Estas seguro de querer eliminar este " . $this->translate->translate($table) . "?')\">Eliminar</a></td>\n";
			}
			$content .= "</tr>\n";
		}
		
		return $content;
	}
	
	function replace_infopagina(){
		$content = "<td colspan='" . count($this->list_fields) . "'>" . $this->translate->translate(get_class($this->obj)) . " " . $this->obj->pageinfo['start'] . " - " . $this->obj->pageinfo['end'] . " de " . $this->obj->pageinfo['total'] . " [Total " . $this->obj->pageinfo['total_pages'] . " Paginas]</td>";
		return $content;
	}
	
	function replace_vars(){
		$this->data = str_replace("<!--appname-->",$this->global["appname"], $this->data);
		$this->data = str_replace("<!--appwebsite-->",$this->global["appwebsite"], $this->data);
		$this->data = str_replace("<!--tablename-->",ucfirst($this->translate->translate(get_class($this->obj))), $this->data);
		$this->data = str_replace("<!--cleantablename-->",get_class($this->obj), $this->data);
		$this->data = str_replace("<!--tablenameplural-->",$this->obj->plural, $this->data);
		$this->data = str_replace("<!--year-->",date('Y'), $this->data);
	}
	
	function replace_headers(){
		$result = "";
		$self = curpage();
		
		while(list($x,$y) = each($this->list_fields)){
			$result .= "<td bgcolor='#C6D7CF' class='titulo_columna'><a class='titulo_columna' href='./$self?" . querystring("order=$x") . "'>" . $this->translate->translate(str_replace("id_","",$x)) . "</a></td>\n";
		}
		
		return $result;
	}
	
	function replace_mainmenu(){
		$this->data = str_replace("<!--menuprincipal-->",file_get_contents("./common_files/grupo_menu.php"),$this->data);
	}
	
	function replace_alertmsg($arr){
		if($arr[0]=="error")
			$this->data = str_replace("<!--alert-->",alertMsg($arr[1]),$this->data);
		else
			$this->data = str_replace("<!--alert-->",alertMsg($this->global, get_class($this->obj)),$this->data);
	}
	
	function replace_form($fields){
		$result = "";
		
		reset($this->list_fields);
		while(list($x,$y) = each($this->list_fields)){
			if(in_array($x, $this->obj->form_field_filter))
				continue;
	
			$required = "false";
			if(in_array($x,$this->obj->required_fields))
				$required = "true";
				
			$update = $fields[$x];
			$result .= "<tr align='left'>\n";
			$result .= "<td class='titulo_insert'>" . ucfirst($this->translate->translate(str_replace("id_","",$x))) . ":</td>\n";

			if(array_key_exists($x,$this->obj->form_type_field)){
				$result .= $this->type_field($this->obj->form_type_field[$x],$update, $required, $x);
			}
			elseif(!(strpos($x,"id_") === false))
				$result .= $this->type_field("dropdownlist",$update, $required, $x);
			else
				$result .= "<td><input class='txt' type='text' maxlength='75' size='35' name='$x' value='$update' required='$required'/>\n";

				$result .= "</td>\n";
			$result .= "</tr>\n";
			
			if(!empty($update) && $this->obj->form_type_field[$x] == "image" && strlen(trim($update)) > 3){
				$result .= "<tr align='left'>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "<td><img src='../archivos/$update' width='200'/>\n";
				$result .= "</td>\n";
				$result .= "</tr>\n";				
			}
		}
		
		if(isset($_GET['multiple'])){
			$field = "id_" . $_GET["multiple"];
			$value = $_GET[$field];
			if(class_exists($_GET["multiple"])){
				$tmp_obj = $_GET["multiple"];
				$tmp_obj = new $tmp_obj();
				$p = get_parent_class($tmp_obj);
				if($p != "db")
				$field = "id_" . $p;
			}

			$hiddenfield = "<input type='hidden' name='$field' value='$value'/>";
			$this->data = str_replace("<!--hiddenfield-->",$hiddenfield,$this->data);
		}
		$this->data = str_replace("<!--form-->",$result,$this->data);
	}
	
	function replace_importexcelform(){
		$result = "";
		
		$result .= "<tr align='left'>\n";
		$result .= "<td class='titulo_insert'>Importar de excel:</td>\n";
		$result .= "<td><input class='txt' type='file' name='excel'/>\n";
		$result .= "</td>\n";
		$result .= "</tr>\n";
		
		$this->data = str_replace("<!--form-->",$result,$this->data);
	}
	
	function replace_form_view($fields){
		$result = "";
		
		reset($this->list_fields);
		while(list($x,$y) = each($this->list_fields)){
			if(in_array($x, $this->obj->form_field_filter))
				continue;
				
			$required = "false";
			if(in_array($x,$this->obj->required_fields))
				$required = "true";
				
			$update = $fields[$x];
			$result .= "<tr align='left'>\n";
			$result .= "<td class='titulo_insert'>" . ucfirst(str_replace("id_","",$x)) . ":</td>\n";

			if(array_key_exists($x,$this->obj->form_type_field)){
				$result .= $this->type_field_view($this->obj->form_type_field[$x],$update, $required, $x);
			}
			elseif(!(strpos($x,"id_") === false))
				$result .= $this->type_field("dropdownlist",$update, $required, $x);
			else
				$result .= "<td>$update\n";

				$result .= "</td>\n";
			$result .= "</tr>\n";
			
			if(!empty($update) && $this->obj->form_type_field[$x] == "image"){
				$result .= "<tr align='left'>\n";
				$result .= "<td>&nbsp;</td>\n";
				$result .= "<td><img src='../archivos/$update'/>\n";
				$result .= "</td>\n";
				$result .= "</tr>\n";				
			}
		}
		
		if(isset($_GET['multiple'])){
			$field = "id_" . $_GET["multiple"];
			$value = $_GET[$field];
			$hiddenfield = "<input type='hidden' name='$field' value='$value'/>";
			$this->data = str_replace("<!--hiddenfield-->",$hiddenfield,$this->data);
		}
		$this->data = str_replace("<!--form-->",$result,$this->data);
	}
	
	function replace_formvalues($fields){
		$this->data = str_replace("<!--formvalues-->",formvalues(curpage(), $fields),$this->data);
	}
	
	function replace_multiple(){
		if(empty($this->obj->multiple) || !(isset($_GET["action"]) && ($_GET["action"] == "edit" || $_GET["action"] == "update")) || !(isset($_GET["id"]) && is_numeric($_GET["id"])))
			return;

		$content = "";
			
		foreach($this->obj->multiple as $table){
			$content .= $this->get_multipletable($table);
		}
		
		return $content;
	}
	
	function get_multipletable($table){
		$oldtable = get_class($this->obj);
		$poldtable = get_parent_class($this->obj);
		if($poldtable != "db")
			$oldtable = $poldtable;
		$obj = new $table();
		
		$_obj = $this->obj;
		$this->obj = $obj; $this->translate->obj = $this->obj;
		
		$id = $_GET["id"];
		$this->obj->get_query = "select * from $table where id_" . $oldtable . " = $id";
		
		$this->list_fields = array();
		foreach($this->obj->fields as $key=>$value){
			if(!in_array($key, $this->obj->list_field_remove))
				$this->list_fields[$key] =$value;
		}
		
		$content = "<table summary='$table'>";
		$content .= "<thead>";
		$content .= "<tr><td colspan='" . (count($this->list_fields)+3) . "' bgcolor='#FFFFFF' class='titulo_tabla' align='center'>Listado de $table</td></tr>";
		$content .= "<tr>";
		$content .= "<th bgcolor='#FFE00F' class='titulo_columna' scope='col'>#</th>";
		$content .= $this->replace_headers();
		$content .= "<th bgcolor='#FFE00F' class='titulo_columna' scope='col'>Editar</th>";
		$content .= "<th bgcolor='#FFE00F' class='titulo_columna' scope='col'>Eliminar</th>";
		$content .= "</tr>";
		$content .= "</thead>";
		$content .= "<tfoot>";
		$content .= "<tr>";
		if($table != "paginarevista")
		$_content = $this->replace_content($oldtable, $id);
		$content .= "<td colspan='" . (count($this->list_fields)+3) . "' align='right'><a href='./editar.php?table=$table&id_$oldtable=$id&multiple=$oldtable&parentmultiple=$oldtable&parentid=$id'>Agregar $table</a></td>";
		$content .= "</tr>";
		$content .= "</tfoot>";
		$content .= "<tbody>";
		$content .= $_content;
		$content .= "</tbody>";
		$content .= "</table><br/><br/>";
		$content .= $this->obj->print_link();
				
		$this->obj = $_obj;
		$this->translate->obj = $this->obj;
		
		$this->list_fields = array();
		foreach($this->obj->fields as $key=>$value){
			if(!in_array($key, $this->obj->list_field_remove))
				$this->list_fields[$key] =$value;
		}
		
		return $content;
	}
	
	function replace_regresar(){
		if(!(isset($_GET["parentmultiple"]) && isset($_GET["parentid"])))
			return;
			
		$parentmultiple = $_GET["parentmultiple"];
		$parentid = $_GET["parentid"];

		$content = "<a href='./editar.php?action=edit&table=$parentmultiple&id=$parentid'>regresar</a>";
		
		return $content;
	}
	
	function type_field($type, $update, $required, $x){
		switch($type){
			case "date":
				return "<td><input class='txt' type='text' id='date' size='35' name='$x' value='$update' required='$required'/>\n";
				break;
			case ($type == "file" || $type == "image" || !(strpos($type, "thumbnail") === false)):
				return "<td><input class='txt' type='file' size='23' name='$x'/> <input type='checkbox' name='$x' value='borrar' /> Cancelar\n";
				break;
			case "multiplefile":
				return "<td><input class='multi' type='file' size='23' name='$x'/>\n";
				break;
			case "richtext":
				return "<td><textarea name='$x' cols='50' rows='15' id='richtext' required='$required'>$update</textarea>\n";
				break;
			case "text":
				return "<td><textarea name='$x' cols='50' rows='15' id='text$x' required='$required'>$update</textarea>\n";
				break;
			case "dropdownlist":
				$_table = str_replace("id_","",$x);
				$_obj = new $_table();
				$arr = $_obj->get();
				
				$result = "<td><select name='$x'>\n";
				foreach($arr as $_arr){
					$result .= "<option value='" . $_arr[$x] . "'" . selected($update, $_arr[$x]) . ">" . $_arr[$_table] . "</option>\n";
				}
				$result .= "</select>\n";
				return $result;	
				break;
			case "flag":
				$result = "<td><select name='$x'>\n";
				foreach($this->obj->flag_field[$x] as $key=>$value){
					if(empty($_GET["action"]))
						$result .= "<option value='" . $key . "'>" . $value . "</option>\n";
					else
						$result .= "<option value='" . $key . "'" . selected($update, $key) . ">" . $value . "</option>\n";
				}
				$result .= "</select>\n";
				return $result;	
				break;
			case "option":
				$_table = str_replace("id_","",$x);
				$_obj = new $_table();
				$arr = $_obj->get();
				
				$result = "<td>";
				foreach($arr as $_arr){
					$result .= "<input type='radio' name='$x' value='" . $_arr[$x] . "'". selected($update, $_arr[$x],"checked") .">" . $_arr[$_table]."\n";
				}
				return $result;	
				break;
			case "multiple":
				$_curtable = get_parent_class($this->obj);
				if($_curtable == "db")
					$_curtable = get_class($this->obj);
				$_idcurtable = $_GET["id"];
				$_reftable = str_replace("id_","",$x);
				$_table =  $_curtable . "_" . $_reftable;
				$_obj = new $_reftable;
				
				$_obj->get_query = "select * from $_table where id_$_curtable = $_idcurtable";
				$arr = $_obj->get();
				
				foreach($arr as $_arr){
					$__arr[] = $_arr["id_" . $_reftable];
				}
				
				$arr = $__arr;
				
				$_obj->get_query = "select * from $_reftable";
				$arr2 = $_obj->get();
				
				$result = "<td>";
				$result .= "<select size='5' multiple name='$x"."[]'>\n";
				
				foreach($arr2 as $_arr2){
					if(in_array($_arr2["id_" . $_reftable],$arr))
						$result .= "<option value='" . $_arr2["id_" . $_reftable] . "' selected>" . $_arr2[$_reftable] . " </option>\n";
					else
						$result .= "<option value='" . $_arr2["id_" . $_reftable] . "'>" . $_arr2[$_reftable] . " </option>\n";
				}
				
				$result .= "</select>\n";
				return $result;
				break;
			case "checkbox":
				$_curtable = get_parent_class($this->obj);
				if($_curtable == "db")
					$_curtable = get_class($this->obj);
				$_idcurtable = $_GET["id"];
				$_reftable = str_replace("id_","",$x);
				$_table =  $_curtable . "_" . $_reftable;
				$_obj = new $_reftable;
				
				$_obj->get_query = "select * from $_table where id_$_curtable = $_idcurtable";
				$arr = $_obj->get();
				
				foreach($arr as $_arr){
					$__arr[] = $_arr["id_" . $_reftable];
				}
				
				$arr = $__arr;
				
				$_obj->get_query = "select * from $_reftable";
				$arr2 = $_obj->get();
				
				$result .= "<td><table cellpading='0' cellspacing='0' border='0' style='font-size:12px;font:verdana'>";
				
				while($tmpx == 0) {
					$tmpy = 1;
					while(list($x,$_arr2) = each($arr2)){
						$result.= "<td>";
						if(in_array($_arr2["id_" . $_reftable],$arr))
							$result .= "<input type='checkbox' value='" . $_arr2["id_" . $_reftable] . "' name='id_" . $_reftable . "[]' checked>" . $_arr2[$_reftable];
						else
							$result .= "<input type='checkbox' value='" . $_arr2["id_" . $_reftable] . "' name='id_" . $_reftable . "[]'>" . $_arr2[$_reftable];
						$tmpy++;
						$result .= "</td>";
						if($tmpy > 3) {
							$tmpy = 0;
							break;
						}
					}
					$result .= "</tr>";
					if(!current($arr2)) $tmpx = 1;
				}
				$result .= "</table>";
				return $result;
				break;
		}
	}
	
	function type_field_view($type, $update, $required, $x){
		switch($type){
			case "date":
				return "<td>$update\n";
				break;
			case ($type == "file" || $type == "image" || !(strpos($type, "thumbnail") === false)):
				return "<td><a href='../archivos/$update' target='_blank'>$update</a>\n";
				break;
			case "multiplefile":
				return "<td>\n";
				break;
			case "richtext":
				return "<td>$update\n";
				break;
			case "text":
				return "<td>$update\n";
				break;
			case "dropdownlist":
				$_table = str_replace("id_","",$x);
				$_obj = new $_table();
				$arr = $_obj->get();
				
				$result = "<td>\n";
				foreach($arr as $_arr){
					if(selected($update, $_arr[$x]) == "selected")
					$result .= $_arr[$_table];
				}
				$result .= "\n";
				return $result;	
				break;
			case "option":
				$_table = str_replace("id_","",$x);
				$_obj = new $_table();
				$arr = $_obj->get();
				
				$result = "<td>";
				foreach($arr as $_arr){
					if(selected($update, $_arr[$x]) == "selected")
					$result .= $_arr[$_table];
				}
				return $result;	
				break;
		}
	}
	
	function print_listar(){
		$this->data = file_get_contents("./templates/listar_default.php");
		$this->replace_vars();
		$this->data = str_replace("<!--tableheader-->", $this->replace_headers(), $this->data);
		if(!isset($this->obj->view))
			$this->data = str_replace("<!--contentlist-->",$this->replace_content(), $this->data);
		else 
			$this->data = str_replace("<!--contentlist-->",$this->replace_content_view(), $this->data);
		$this->data = str_replace("<!--links-->",$this->obj->print_link(), $this->data);
		$this->data = str_replace("<!--infopagina-->",$this->replace_infopagina(), $this->data);
		$this->data = str_replace("<!--columns-->",count($this->list_fields)+3, $this->data);
		$this->replace_mainmenu();
		if(!isset($this->obj->view)){
			$this->data = str_replace("<!--Editar-->","Editar", $this->data);
			$this->data = str_replace("<!--Agregar-->","Agregar", $this->data);
			$this->data = str_replace("<!--Eliminar-->","<th scope='col'>Eliminar</th>", $this->data);
			$this->data = str_replace("numtype","2", $this->data);
		}
		else {
			$this->data = str_replace("<!--Editar-->","Ver", $this->data);
			$this->data = str_replace("disablelink","onClick='return false;'", $this->data);
			$this->data = str_replace("numtype","1", $this->data);
		}
			
		if(isset($this->obj->links))
			$this->data = str_replace("<!--link-->",$this->obj->links . " - ", $this->data);
		
		print($this->data);
	}
	
	function print_form($fields){
		$this->data = file_get_contents("./templates/editar_default.php");
		$this->replace_vars();
		$this->replace_mainmenu();
		$this->replace_alertmsg($fields);
		if(!isset($this->obj->view))
			if(empty($_GET["excel"]))
				$this->replace_form($fields);
			else 
				$this->replace_importexcelform();
		else 
			$this->replace_form_view($fields);
		$this->replace_formvalues($fields);
		$this->data = str_replace("<!--multiple-->",$this->replace_multiple(), $this->data);
		$this->data = str_replace("<!--regresar-->",$this->replace_regresar(), $this->data);
		if(!isset($this->obj->view))
			$this->data = str_replace("<!--submit-->","<input class='btn' type='submit' name='submit' value='Guardar' />", $this->data);
		
		print($this->data);
	}
}
?>