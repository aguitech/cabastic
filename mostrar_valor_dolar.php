<?php include("includes/includes.php");

/**
$tipo_cambio_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");

$tipo_cambio_dolar = $tipo_cambio_val->Valor;

echo $tipo_cambio_dolar;
*/

$id = $_POST["id"];

$qry_producto_detalle = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_producto.Id_Producto = $id";

$producto_detalle = $obj->get_row($qry_producto_detalle);

$id_producto_detalle = $producto_detalle->Id_Producto_Detalle;



$qry_costo_producto_actual = "select * from ds_tbl_costo_compra_producto where ds_tbl_costo_compra_producto.Id_Producto_Detalle = $id_producto_detalle";

//echo $qry_costo_producto_actual . "<br />";
$precio_producto_actual = $obj->get_row($qry_costo_producto_actual);


?>

<?php echo $precio_producto_actual->Dolar; ?>