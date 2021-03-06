<?php
class form {
	var $obj;
	var $table;
	var $parenttable;
	var $paging;
	var $page;
	
	function form($obj, $paging = 25){
		$this->obj = $obj;
		$this->paging = $paging;
		$this->parenttable = get_parent_class($this->obj);
		$this->table = get_class($this->obj);
		$this->page = curpage();
	}
	
	function retrievelist(){
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
				$content .= "<td><a href='./$self?" . querystring("action=delete&table=$table2&id=" . $item["id_" . $table]) . "' onclick=\"return confirm('¿Estas seguro de querer eliminar este $table2?')\"><div align='center'>Eliminar</div></a></td>\n";
			}
			else{
				$content .= "<td><a href='./editar.php?action=edit&parentmultiple=$oldtable&parentid=$idoldtable&table=$table2&id=" . $item["id_" . $table] . "'>Editar</a></td>\n";
				$content .= "<td><a href='./$self?" . querystring("action=delete&redirect=true&parentmultiple=$oldtable&parentid=$idoldtable&table=$table2&id=" . $item["id_" . $table]) . "' onclick=\"return confirm('¿Estas seguro de querer eliminar este $table2?')\">Eliminar</a></td>\n";
			}
			$content .= "</tr>\n";
		}
	}
}
?>