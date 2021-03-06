<?php
class importexcel {
	var $excel;
	var $obj;
	
	function importexcel($table, $excel){
		$this->excel = new Spreadsheet_Excel_Reader();
		$this->obj = new $table();
		
		$this->excel->setOutputEncoding('CP1251');
		$this->excel->read("../archivos/$excel");
		$eheader = array();
		$econtent = array();
		
		for ($i = 1; $i <= $this->excel->sheets[0]['numRows']; $i++) {
			$econtent = array();
			for ($j = 1; $j <= $this->excel->sheets[0]['numCols']; $j++) {
				if($i==1)
					$eheader[] = strtolower(trim($this->excel->sheets[0]['cells'][$i][$j]));
				else
					$econtent[] = trim($this->excel->sheets[0]['cells'][$i][$j]);
			}
			$this->add_row($eheader,$econtent);
		}			
	}
	
	function add_row($eheader, $econtent){
		$fields = array();
		$tmp_count = count($eheader);
	print_r($econtent);
		for($i=0;$i<=$tmp_count;$i++){
			$field = $eheader[$i];
			$value = trim($econtent[$i]);
			
			if(empty($value))
				continue;

			if(array_key_exists($field,$this->obj->fields))
				$fields[$field] = $value;
			elseif(array_key_exists("id".$field,$this->obj->fields)){
				$id_field = $this->obj->get_var("select id_$field from $field where $field like '$value'");
				
				if(empty($id_field)){
					$obj = new $field();
					$tmpfields[$field] = $value;
					$obj->add($tmpfields);
					$id_field = $obj->get_lastid();
				}
				
				$fields["id_".$field] = $id_field;
			}
		}
		
		$this->obj->add($fields);
	}
}

function importExcel($table){
	if(!empty($_POST["submit"])){
		$excel = upload_file($_FILES['excel'], "../archivos");
	}
	
	if(!empty($excel)){
		$obj = new importexcel($table, $excel);
	}
}
?>