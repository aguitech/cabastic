<?php 
$idcampania = $_GET["id"];
$reportefotografico = new reporte_fotografico();
//$reportefotografico->get_query = "select * from reporte_fotografico where id_campania = '$idcampania'";
//$reportefotografico->get_query = "select * from reporte_fotografico where id_campania = '$idcampania'";
//$reportefotografico->get_query = "select * from reporte_fotografico where id_campania = $idcampania";
//$reportefotografico->get_query = "select * from reporte_fotografico left join mueble on reporte_fotografico.id_mueble = mueble.id_mueble where id_campania = $idcampania";
//$reportefotografico->get_query = "select * from reporte_fotografico left join mueble on reporte_fotografico.id_mueble = mueble.id_mueble left join campania on reporte_fotografico.id_campania = campania.id_campania where reporte_fotografico.id_campania = $idcampania";
//id_tipomueble
//$reportefotografico->get_query = "select * from reporte_fotografico left join mueble on reporte_fotografico.id_mueble = mueble.id_mueble left join campania on reporte_fotografico.id_campania = campania.id_campania left join tipomueble on mueble.id_tipomueble = tipomueble.id_tipomueble where reporte_fotografico.id_campania = $idcampania";
$reportefotografico->get_query = "select * from reporte_fotografico left join mueble on reporte_fotografico.id_mueble = mueble.id_mueble left join campania on reporte_fotografico.id_campania = campania.id_campania left join tipomueble on mueble.id_tipomueble = tipomueble.id_tipomueble left join estacion on mueble.id_estacion = estacion.id_estacion where reporte_fotografico.id_campania = $idcampania";




//Textos completos 	id_reporte_fotografico 	id_mueble 	mueble 	id_mueble_campania 	id_campania 	id_estacion 	fecha 	hora 	id_usuario 	foto1 	foto2 	foto3 	foto4 	foto5 	marcar_error 	comentario_error 	observaciones
//Textos completos 	id_reporte_fotografico 	id_mueble 	mueble 	id_mueble_campania 	id_campania 	id_estacion 	fecha 	hora 	id_usuario 	foto1 	foto2 	foto3 	foto4 	foto5 	marcar_error 	comentario_error 	observaciones

$reportes = $reportefotografico->get();
?>