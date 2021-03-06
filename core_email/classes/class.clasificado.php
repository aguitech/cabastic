<?php
/**
*		@name table management Class
* 
*		@author 	Hector Aguilar (hector@aguitech.com)
*					http://www.hector-aguilar.com
*
*		Dependencias:
*		@uses 		class.sql.php - ez_sql MySql Management class.
*		@uses 		class.db.php - extend ez_sql MySql Management class by daniel rosiles.
* 		@uses 		functions.php - Hector Aguilar personal functions.
* 		@uses 		config.php - global config file.
*/

class clasificado extends db {
	function clasificado() {
		$this->db();
		$this->form_type_field["descripcion"] = "text";
		
		$this->list_field_remove[] = "descripcion";
		$this->list_field_remove[] = "status";
		
		$this->flag_field["status"] = array("1" =>"Activo", "0"=>"Inactivo");
		$this->form_type_field["status"] = "flag";
	}
}
