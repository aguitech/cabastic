<?php
@session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', '0');

//session_start();

//echo($_SESSION['login']);
$url = "index.php";

if(isset($_SESSION['login'])){
	//header("location index.php");
	//echo "IS SET";

	if($_SESSION['login']=="out"){
		//echo "NOT NOT NOT";
		//header("location: index.php");
		//echo "bye";

		echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; 
        exit;
	}

}else{
	//header("location: index.php");
	//echo "NOT NOT NOT";
	header("location: index.php");
}

//unset($_SESSION['login']);
//$_SESSION['login'] = "out";
//header("location: index.php");


/*
$_SESSION['id_login']  = $id_usuario;
$_SESSION['nombre']  = $nombre;
*/

$login_usuario = $_SESSION['nombre'];
$login_id = $_SESSION['id_login'];


?>