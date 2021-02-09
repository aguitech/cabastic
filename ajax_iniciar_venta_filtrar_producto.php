<?php include("includes/includes.php"); ?>
<?php //print_r($_POST); ?>
<?php
$id_producto = $_POST["id"];
//$qry_talla = "select * from ds_tbl_producto_detalle where Id_Producto = $id_producto";
//$qry_talla = "select * from ds_tbl_producto_detalle left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla where ds_tbl_producto_detalle.Id_Producto = $id_producto";
//$qry_talla = "select * from ds_tbl_producto_detalle left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla where ds_tbl_producto.Nombre = ?{$id_producto}'";
//$qry_talla = "select *, ds_cat_talla.Descripcion as talla from ds_tbl_producto_detalle left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_producto.Nombre = '{$id_producto}'";
$qry_talla = "select *, ds_cat_talla.Descripcion as talla from ds_tbl_producto_detalle left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_producto.Nombre = '{$id_producto}' group by talla";
$tallas = $obj->get_results($qry_talla);
?>
<select name="id_talla" id="id_talla" class="form-control" onchange="filtrar_talla(this.value);">
	<option value="">Selecciona un talla</option>
	<?php foreach ($tallas as $talla): ?>
	<option value="<?php echo $talla->Id_Talla; ?>"><?php echo $talla->talla; ?></option>
	<?php endforeach; ?>
</select>