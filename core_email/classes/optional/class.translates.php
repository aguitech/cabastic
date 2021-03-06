<?php
class translates {
	var $obj;
	
	function translates($obj){ 
		$this->obj = $obj;
	}
	
	function translate($var){
		if(array_key_exists($var,$this->obj->translate))
			return $this->obj->translate[$var];
		else 
			return $var;
	}
}
?>