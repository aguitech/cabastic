<?php include("includes/includes.php"); ?>
<?php print_r($_POST); ?>
<?php
$id_producto = $_POST["id_producto"];
$id_talla = $_POST["id"];
//$qry_talla = "select * from ds_tbl_producto_detalle where Id_Producto = $id_producto";
//$qry_talla = "select * from ds_tbl_producto_detalle left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla where ds_tbl_producto_detalle.Id_Producto = $id_producto";
//$id_talla
$qry_color = "select * from ds_tbl_producto_detalle left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color where ds_tbl_producto_detalle.Id_Producto = $id_producto and ds_tbl_producto_detalle.Id_Talla = $id_talla";
$colores = $obj->get_results($qry_color);
?>
<select name="" id="id_color" class="form-control" onchange="filtrar_color(this.value);">
	<option value="">Selecciona un producto</option>
	<?php foreach ($colores as $color): ?>
	<option value="<?php echo $color->Id_Color; ?>"><?php echo $color->Descripcion; ?></option>
	<?php endforeach; ?>
</select>