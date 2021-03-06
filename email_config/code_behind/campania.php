<?php
//$mueble = new mueble();
//$mueble->get_query = "select * from mueble left join tipomueble on mueble.id_tipomueble = tipomueble.id_tipomueble left join estacion on mueble.id_estacion = estacion.id_estacion";
//$muebles = $mueble->get();

$estacion = new estacion();
$estaciones = $estacion->get();

$campania = new campania();
$fields = $campania->postArray();
if($_POST["campania"] != ""){
	$campania->add($fields);
	echo "<script>window.location='campanias.php'</script>";
}

?>