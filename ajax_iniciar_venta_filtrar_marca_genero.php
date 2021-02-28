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
<?php /**
<select name="id_producto" id="id_producto" class="form-control" onchange="filtrar_producto(this.value);">
*/ ?>
<select name="id_producto" id="id_producto" class="form-control" >
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

<?php /**
	
<?php include("includes/includes.php"); ?>

<?php //print_r($_POST); ?>
<?php
$id_marca = $_POST["id"];
$id_genero = $_POST["id_genero"];

//$qry_producto = "select * from ds_tbl_producto where Id_Marca = $id_marca";
//$qry_producto = "select * from ds_tbl_producto where Id_Marca = $id_marca group by Nombre";
//$qry_producto = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Marca = $id_marca group by Nombre";

//print_r($_POST);
$where_append = "";
if($id_marca != "" || $id_genero != ""){
    $where_append .= "where ";
}

if($id_marca == ""){
    $where_append .= "";
}else{
    $where_append .= "ds_tbl_producto.Id_Marca = $id_marca";
}

if($id_marca != "" && $id_genero != ""){
    $where_append .= " and ";
}

if($id_genero == ""){
    $where_append .= "";
}else{
    $where_append .= "ds_tbl_producto_detalle.Id_Genero = $id_genero";
}

if($id_genero == ""){
    //$qry_producto = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Marca = $id_marca group by Nombre";
    
}else{
    //$qry_producto = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Marca = $id_marca group by Nombre";
    
    //$qry_producto = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Marca = $id_marca and ds_tbl_producto_detalle.Id_Genero = $id_genero group by Nombre";
    
}
$qry_producto = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto {$where_append} group by Nombre";

//echo $qry_producto;

$productos = $obj->get_results($qry_producto);

//print_r($productos);
?>
<select name="id_producto" id="id_producto" class="form-control" onchange="filtrar_producto(this.value);">
	<option value="">Selecciona un producto</option>
	<?php foreach ($productos as $producto): ?>
	
	<?php if($producto->Id_Producto_Detalle != "") { ?>
	<option value="<?php echo $producto->Nombre; ?>"><?php echo $producto->Nombre; ?></option>
	<?php } ?>
	
	<?php endforeach; ?>
</select>
*/ ?>
