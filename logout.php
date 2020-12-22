<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

@session_start();


if(isset($_SESSION['login'])){
	//header("location index.php");
}else{
	//header("location: index.php");
}

unset($_SESSION['login']);
//$_SESSION['login'] = "out";
header("location: index.php");




?>

