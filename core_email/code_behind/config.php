<?php
if($show_error)
	error_reporting(E_ALL);
else 
	error_reporting(0);

$modo = "desarrollo";
if($aplicacion_en_produccion)
	$modo = "produccion";

$arrModo = $$modo;

define('DB_USER', $arrModo['db_user']);
define('DB_PASSWORD', $arrModo['db_password']);
define('DB_NAME', $arrModo['db_name']);
define('DB_HOST', $arrModo['db_host']);
define('EMAIL_FROM',$arrModo['email_from']);
define('EMAIL_FROM_NAME',$arrModo['email_from_name']);
define('EMAIL_HOST', $arrModo['email_host']);
define('EMAIL_LOGIN_USER', $arrModo['email_login_user']);
define('EMAIL_LOGIN_PASSWORD', $arrModo['email_login_password']);
define('MAILER', $arrModo['mailer']);

session_start();
?>