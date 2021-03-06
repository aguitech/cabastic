<?php 
include("includes/includes.php");

if($_SESSION["username"] != ""){
    header("Location: home.php");
}
/*

$sistemas = $obj->get_results('select * from sistema');



foreach($sistemas as $sistema){
	
	//$url_redirect = $sistema["permalink"] . "/";
	$url_redirect = $sistema->permalink . "/";
	
	if($_SESSION["sistema1"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema2"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema3"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema4"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema5"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema6"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema7"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema8"] != ""){
		header("Location: {$url_redirect}");
	}
	if($_SESSION["sistema9"] != ""){
		header("Location: {$url_redirect}");
	}
	
	
}

*/
if($_SESSION["logued"] != ""){
	header("Location: admin.php");
}

$username = $_POST["usuario"];
$contrasenia = md5($_POST["password"]);


//$qry = $obj->get_var("select Id_Empleado from ds_tbl_empleado where Nombre = '{$username}' and Contrasena_Usuario = '{$contrasenia}'");
//echo $qry;
//$usuario = $usuario->get($qry);
//$usuario = $usuario->get_results($qry);
//$usuario = $usuario->get_row($qry);
//$usuario = $obj->get_row("select * from usuario where usuario = '{$username}' and contrasenia = '{$contrasenia}'");
//$qry_usaurio = "select * from ds_tbl_empleado where Nombre = '{$username}' and Contrasena_Usuario = '{$contrasenia}'";
$qry_usaurio = "select * from ds_tbl_empleado left join ds_cat_empleado_rol on ds_cat_empleado_rol.Id_Empleado_Rol = ds_tbl_empleado.Id_Empleado_Rol where ds_tbl_empleado.Nombre = '{$username}' and ds_tbl_empleado.Contrasena_Usuario = '{$contrasenia}'";

//echo $qry_usaurio;
$usuario = $obj->get_row($qry_usaurio);


/** 
 * 
 * SEGURO DE IDENTIDAD POR MAC ADDRESS
 * 
 * 
//$usuario = $usuario->get();
//print_r($usuario);
//if($usuario["REMOTE_ADDR_first"] == "" || $usuario["HTTP_X_REAL_IP_first"] == "" || $usuario["HTTP_USER_AGENT_first"] == ""){
if($usuario->REMOTE_ADDR_first == "" || $usuario->HTTP_X_REAL_IP_first == "" || $usuario->HTTP_USER_AGENT_first == ""){
	
	//$qry_update = "update usuario set REMOTE_ADDR_first = '" . $_SERVER['REMOTE_ADDR'] . "', HTTP_X_REAL_IP_first = '" . $_SERVER['HTTP_X_REAL_IP'] . "', HTTP_USER_AGENT_first = '" . $_SERVER['HTTP_USER_AGENT'] . "' where id_usuario = '" . $usuario["id_usuario"] . "'";
	$qry_update = "update usuario set REMOTE_ADDR_first = '" . $_SERVER['REMOTE_ADDR'] . "', HTTP_X_REAL_IP_first = '" . $_SERVER['HTTP_X_REAL_IP'] . "', HTTP_USER_AGENT_first = '" . $_SERVER['HTTP_USER_AGENT'] . "' where id_usuario = '" . $usuario->id_usuario . "'";
	//echo $qry_update;
	$obj->query($qry_update);
}else{
	
	//$qry_update = "update usuario set REMOTE_ADDR_update = '" . $_SERVER['REMOTE_ADDR'] . "', HTTP_X_REAL_IP_update = '" . $_SERVER['HTTP_X_REAL_IP'] . "', HTTP_USER_AGENT_update = '" . $_SERVER['HTTP_USER_AGENT'] . "' where id_usuario = '" . $usuario["id_usuario"] . "'";
	$qry_update = "update usuario set REMOTE_ADDR_update = '" . $_SERVER['REMOTE_ADDR'] . "', HTTP_X_REAL_IP_update = '" . $_SERVER['HTTP_X_REAL_IP'] . "', HTTP_USER_AGENT_update = '" . $_SERVER['HTTP_USER_AGENT'] . "' where id_usuario = '" . $usuario->id_usuario . "'";
	//echo $qry_update;
	$obj->query($qry_update);
}

//if($usuario["seguro_identidad"] == "1"){
if($usuario->seguro_identidad == "1"){
	//$usuario_validate = new usuario();
	//$usuario_validate = $usuario_validate->get($usuario["id_usuario"]);
	//$usuario_validate = $usuario_validate->get($usuario["id_usuario"]);
	$usuario_validate = $obj->get_row("select * from usuario where id_usuario = '{$usuario->id_usuario}'");
	//$usuario = $obj->get_row("select * from usuario where usuario = '{$username}' and contrasenia = '{$contrasenia}'");
	
	
	//if($usuario_validate["REMOTE_ADDR_first"] == $usuario_validate["REMOTE_ADDR_update"] && $usuario_validate["HTTP_USER_AGENT_first"] == $usuario_validate["HTTP_USER_AGENT_update"]){
	if($usuario_validate->REMOTE_ADDR_first == $usuario_validate->REMOTE_ADDR_update && $usuario_validate->HTTP_USER_AGENT_first == $usuario_validate->HTTP_USER_AGENT_update){
		$val_seguro_identidad = "1";
	}else{
		$val_seguro_identidad = "0";
	}
	
}else{
	$val_seguro_identidad = "1";
}

*/
$val_seguro_identidad = "1";
if($_POST["CKdo"] == "CKini" && $val_seguro_identidad == "1"){
	//if($username == $usuario['usuario'] && $contrasenia == $usuario['contrasenia']) {
    if($username == $usuario->Nombre && $contrasenia == $usuario->Contrasena_Usuario) {
		session_start();
		
		$_SESSION["idusuario"] = $usuario->Id_Empleado;
		
		/*
		$_SESSION["idcreador"] = $usuario->id_creador;
		$_SESSION["nivel"] = $usuario->id_nivel;
		*/
		$_SESSION["rol"] = $usuario->Id_Empleado_Rol;
		
		
		$_SESSION["username"] = $usuario->Nombre;
		
		$_SESSION["rol_name"] = $usuario->Descripcion;
		
		//$_SESSION["logued"] = true;
		//$_SESSION["logued"] = $username;
		//header("Location: admin.php");
		
		header("Location: home.php");
		/**
		foreach($sistemas as $sistema){
			if($sistema->id_sistema == $usuario->id_sistema){
				$url_togo = $sistema->permalink . "/";
				
				if($sistema->id_sistema == 1){
					$_SESSION["sistema1"] = $username;
				}
				if($sistema->id_sistema == 2){
					$_SESSION["sistema2"] = $username;
				}
				if($sistema->id_sistema == 3){
					$_SESSION["sistema3"] = $username;
				}
				if($sistema->id_sistema == 4){
					$_SESSION["sistema4"] = $username;
				}
				if($sistema->id_sistema == 5){
					$_SESSION["sistema5"] = $username;
				}
				if($sistema->id_sistema == 6){
					$_SESSION["sistema6"] = $username;
				}
				if($sistema->id_sistema == 7){
					$_SESSION["sistema7"] = $username;
				}
				if($sistema->id_sistema == 8){
					$_SESSION["sistema8"] = $username;
				}
				if($sistema->id_sistema == 9){
					$_SESSION["sistema9"] = $username;
				}
				
				
				
				
				header("Location: {$url_togo}");
				break;
			}
		}
		*/
		
		//header("Location: admin.php");
		
		
		//header("Location: connect/");
		//echo "Bienvenido";
	}else{
		header("Location: login.php?e=22");
	}

}else{
	header("Location: login.php?e=23");
}
?>