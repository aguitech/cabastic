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

class bolsatrabajo extends db {
	function bolsatrabajo() {
		$this->db();
		$this->form_type_field["descripcion"] = "text";
		
		$this->list_field_remove[] = "id_bolsatrabajo";
		$this->list_field_remove[] = "descripcion";
		$this->list_field_remove[] = "salario";
		$this->list_field_remove[] = "comienzo";
		$this->list_field_remove[] = "duracion";
		$this->list_field_remove[] = "fecha";
		$this->list_field_remove[] = "categoria";
		$this->list_field_remove[] = "tipotrabajo";
		$this->list_field_remove[] = "direccion";
		
		$this->form_field_remove[] = "fecha";
		
		$this->flag_field["status"] = array("1" =>"Activo", "0"=>"Inactivo");
		$this->form_type_field["status"] = "flag";
		
		$this->flag_field["tipotrabajo"] = array("0" =>"Cualquiera", "1"=>"Tiempo Completo", "2"=>"Medio Tiempo", "3"=>"Por Horas", "4"=>"Temporal", "5"=>"Beca / Practica", "6"=>"Desde Casa");
		$this->form_type_field["tipotrabajo"] = "flag";
	}
}