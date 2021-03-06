<?php
//$mueble = new mueble();
//$mueble->get_query = "select * from mueble left join tipomueble on mueble.id_tipomueble = tipomueble.id_tipomueble left join estacion on mueble.id_estacion = estacion.id_estacion";
//$muebles = $mueble->get();

$campania = new campania();
$campania->get_query = "select * from campania where status = 0";
$campanias = $campania->get();

?>