<?php 
include("includes/includes.php");

$id_producto = $_POST["id"];
//$producto = $obj->get_row("select * from ds_tbl_producto where Id_Producto = $id_producto");
//ds_tbl_producto_detalle
//$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Producto = $id_producto");
//$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Producto = $id_producto");
//ds_tbl_precio_venta_producto
$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = $id_producto");
//
print_r($producto);
?>
<div class="form-row">
    <div class="form-group col-md-6">
     	<div>Producto:</div>
		<?php echo $producto->Nombre; ?>
    </div>
   
</div>
<div class="form-row">
    <div class="form-group col-md-6">
     	<div>Precio de venta</div>
		<input type="text" name="" id="" value="<?php echo $producto->Costo_Venta; ?>" />
    </div>
    <div class="form-group col-md-6">
     	<div>Impuesto adicional</div>
        <input type="text" name="" id="" value="<?php echo $producto->Costo_Venta; ?>" />
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
     	<div>Precio de venta en Dolares</div>
		<input type="text" name="" id="" value="<?php echo $producto->Dolar; ?>" />
    </div>
    <div class="form-group col-md-6">
     	<div>Aplica IVA</div>
        <input type="text" name="" id="" value="<?php echo $producto->IVA; ?>" />
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
		<input type="button" value="Guardar" name="" id="" />
    </div>
    
</div>
<div class="form-row">
    <div class="form-group col-md-6">
		Valor USD: <?php echo $producto->Valor_Tipo_Cambio_Dolar; ?>
    </div>
   
</div>