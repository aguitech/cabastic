<?php
include("includes/includes.php");


$id_producto_detalle = $_POST["id_producto_detalle"];

$cantidad_inventario = $_POST["cantidad_inventario"];

$id_evento = $_POST["id_evento"];

print_r($_POST);

$fecha_acutal = date("Y-m-d H:i:s");


$qry_inventario_almacen = "select * from ds_tbl_inventario_almacen where Id_Producto_Detalle = $id_producto_detalle";

$inventario_almacen = $obj->get_row($qry_inventario_almacen);


//$qry_consulta = "select * from ds_tbl_inventario_evento where Id_Evento = $id_evento and Id_Producto_Detalle = $id_producto_detalle";
$qry_consulta = "select * from ds_tbl_inventario_evento where Id_Evento = $id_evento and Id_Producto_Detalle = $id_producto_detalle";

$consulta_inventario = $obj->get_row($qry_consulta);

$id_inventario_evento = $consulta_inventario->Id_Inventario_Evento;

print_r($consulta_inventario);

if($consulta_inventario->Id_Inventario_Evento != ""){
    //ACTUALIZAR
    //$fecha_acutal
    //$qry_update = "update ds_tbl_inventario_evento set Cantidad = $cantidad_inventario where Id_Inventario_Evento = $id_inventario_evento";
    //Fecha_Registro
    $qry_update = "update ds_tbl_inventario_evento set Cantidad = $cantidad_inventario, Fecha_Registro = '{$fecha_acutal}' where Id_Inventario_Evento = $id_inventario_evento";
    //
    echo $qry_update;
    $obj->query($qry_update);
}else{
    //INSERTAR
    $qry_insertar = "insert into ds_tbl_inventario_evento (Id_Evento, Id_Producto_Detalle, Cantidad, Fecha_Registro) values ($id_evento, $id_producto_detalle, $cantidad_inventario, '{$fecha_acutal}')";
    echo $qry_insertar;
    $obj->query($qry_insertar);
}
//ds_tbl_inventario_evento



?>
















