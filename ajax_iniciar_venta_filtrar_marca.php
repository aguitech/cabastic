<?php include("includes/includes.php"); ?>
<?php //print_r($_POST); ?>
<?php
$id_marca = $_POST["id"];

//$qry_producto = "select * from ds_tbl_producto where Id_Marca = $id_marca";
//$qry_producto = "select * from ds_tbl_producto where Id_Marca = $id_marca group by Nombre";
$qry_producto = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Marca = $id_marca group by Nombre";

$productos = $obj->get_results($qry_producto);

//print_r($productos);
?>
<select name="id_producto" id="id_producto" class="form-control" onchange="filtrar_producto(this.value);">
	<option value="">Selecciona un producto</option>
	<?php foreach ($productos as $producto): ?>
	
	<?php if($producto->Id_Producto_Detalle != "") { ?>
	<option value="<?php echo $producto->Nombre; ?>"><?php echo $producto->Nombre; ?></option>
	<?php } ?>
	<?php /**
	<option value="<?php echo $producto->Id_Producto; ?>"><?php echo $producto->Nombre; ?></option>
	*/ ?>
	<?php endforeach; ?>
</select>
