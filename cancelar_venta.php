<?php
include("includes/includes.php");

$id = $_POST["id"];

$qry_delete_venta = "delete from ds_tbl_venta where Id_Venta = {$id}";
$obj->query($qry_delete_venta);

$qry_delete_venta_detalle = "delete from ds_tbl_venta_detalle where Id_Venta = {$id}";
$obj->query($qry_delete_venta_detalle);