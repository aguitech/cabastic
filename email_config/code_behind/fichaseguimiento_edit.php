<?php 
if($_GET["id"] != ""){
	$id = $_GET["id"];	
}else{
	header("Location: index.php");
}
$ficha = new fichaseguimiento();
$ficha = $ficha->get($id);

?>