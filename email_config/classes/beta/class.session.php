<?php
class session extends _Session {
	var $is_logged;
	var $sesion;
	var $global;

	function session($sesion, $global){
		if($global["page"] != "fichatecnica.php" && $global["page"] != "gracias_recuperar.php"){
			$this->sesion = $sesion;
			$this->global = $global;
			$this->is_logged = $this->get($this->sesion["logged"]);
	
			if(empty($this->is_logged) && $global["page"] != $this->sesion["page"]["login"])
				redirect($this->sesion["page"]["login"]);
				
			$this->id_{$this->sesion["logintable"]} = $this->get("id_" . $this->sesion["logintable"]);
	
			foreach ($this->sesion["customvar"] as $customvar){
				$this->{$customvar} = $this->get($customvar);
			}
		}
	}
	
	function login($user, $pass, $arr = null){
		if($this->is_logged != null)
			redirect($this->sesion["page"]["index"]);
		
		$obj = new $this->sesion["logintable"];
		$obj_row = $obj->validLogin($user,$pass);

		$this->id_{$this->sesion["logintable"]} = $obj_row["id_" . $this->sesion["logintable"]];
		
		if($arr != null){
			if(!(trim($obj_row[$arr[0]]) == $arr[1]))
				$this->id_{$this->sesion["logintable"]} = null;
		}
		
		if(!empty($this->id_{$this->sesion["logintable"]})){
			$this->register($this->sesion["logged"],true);
			$this->register("id_".$this->sesion["logintable"],$this->id_{$this->sesion["logintable"]});
			
			foreach ($this->sesion["customvar"] as $customvar){
				$this->register($customvar, $obj_row[$customvar]);
			}
			
			redirect($this->sesion["page"]["index"]);
		}
	}
	
	function login2($user, $pass, $arr = null){
		if($this->is_logged != null)
			redirect($this->sesion["page"]["index"]);
		
		$obj = new $this->sesion["logintable"];
		$obj_row = $obj->validLogin2($user,$pass);

		$this->id_{$this->sesion["logintable"]} = $obj_row["id_" . $this->sesion["logintable"]];
		
		if($arr != null){
			if(!(trim($obj_row[$arr[0]]) == $arr[1]))
				$this->id_{$this->sesion["logintable"]} = null;
		}
		
		if(!empty($this->id_{$this->sesion["logintable"]})){
			$this->register($this->sesion["logged"],true);
			$this->register("id_".$this->sesion["logintable"],$this->id_{$this->sesion["logintable"]});
			
			foreach ($this->sesion["customvar"] as $customvar){
				$this->register($customvar, $obj_row[$customvar]);
			}
			
			redirect($this->sesion["page"]["index"]);
		}
	}
	
	function logout(){
		$this->finish();
		redirect($this->sesion["page"]["login"]);
	}
}
?>