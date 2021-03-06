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

class producto_pedido extends db {
	function producto_pedido() {
		$this->db();
	}
}