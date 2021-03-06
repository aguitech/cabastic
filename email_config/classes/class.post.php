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

class post extends db {
	function post() {
		$this->db();
		
		$this->list_field_remove[] = "imagen";
		$this->list_field_remove[] = "post";

		$this->form_type_field["post"] = "richtext";
		$this->form_type_field["imagen"] = "image";
		$this->form_type_field["thumb"] = "image";
		$this->form_type_field["evento"] = "flag";
		
		$this->flag_field["evento"] = array("1" =>"Si", "0"=>"No");
		
		$this->plural = "Posts";
	}
}