<?php 
/**
if($_GET["id"] != ""){
	$id = $_GET["id"];	
}else{
	header("Location: index.php");
}
$ficha = new fichaseguimiento();
$ficha = $ficha->get($id);
*/
//$mueble = new mueble();
//$mueble->get_query = "select * from mueble left join tipomueble on mueble.id_tipomueble = tipomueble.id_tipomueble left join estacion on mueble.id_estacion = estacion.id_estacion";
//$muebles = $mueble->get();

$estacion = new estacion();
$estaciones = $estacion->get();
?>