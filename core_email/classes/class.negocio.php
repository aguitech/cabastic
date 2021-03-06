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

class negocio extends db {
	function negocio() {
		$this->db();
		
		/*
		$this->list_field_remove[] = "email";
		$this->list_field_remove[] = "longitud";
		$this->list_field_remove[] = "latitud";
		$this->list_field_remove[] = "streetview";
		$this->list_field_remove[] = "descripcion";
		$this->list_field_remove[] = "rapida";
		$this->list_field_remove[] = "domicilio";
		$this->list_field_remove[] = "telefono";
		$this->list_field_remove[] = "paginaweb";
		
		$this->form_type_field["rapida"] = "flag";
		$this->form_type_field["domicilio"] = "flag";
		
		$this->flag_field["rapida"] = array("1" =>"Si", "0"=>"No");
		$this->flag_field["domicilio"] = array("1" =>"Si", "0"=>"No");
		
		$this->translate["rapida"] = "Servicio comida rapida";
		$this->translate["domicilio"] = "Servicio a domicilio";

		$this->form_type_field["descripcion"] = "text";
		$this->form_type_field["streetview"] = "text";
		
		$this->translate["calle"] = "Calle y Num";
		
		$this->plural = "Negocios";
		*/
	}
}