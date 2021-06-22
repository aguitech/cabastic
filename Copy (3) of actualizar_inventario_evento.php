<?php
include("includes/includes.php");


$id_producto_detalle = $_POST["id_producto_detalle"];

$cantidad_inventario = $_POST["cantidad_inventario"];

$id_evento = $_POST["id_evento"];

print_r($_POST);

$qry_consulta = "select * from ds_tbl_inventario_evento where Id_Evento = $id_evento and Id_Producto_Detalle = $id_producto_detalle";

$consulta_inventario = $obj->get_row($qry_consulta);

print_r($consulta_inventario);


//ds_tbl_inventario_evento



?>