<?php include("includes/includes.php"); ?>
<?php print_r($_POST); ?>
<?php
$id_producto = $_POST["id"];
//$qry_talla = "select * from ds_tbl_producto_detalle where Id_Producto = $id_producto";
$qry_talla = "select * from ds_tbl_producto_detalle left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla where ds_tbl_producto_detalle.Id_Producto = $id_producto";
$tallas = $obj->get_results($qry_talla);
?>
<select name="" id="id_talla" class="form-control" onchange="filtrar_talla(this.value);">
	<option value="">Selecciona un producto</option>
	<?php foreach ($tallas as $talla): ?>
	<option value="<?php echo $talla->Id_Talla; ?>"><?php echo $talla->Descripcion; ?></option>
	<?php endforeach; ?>
</select>