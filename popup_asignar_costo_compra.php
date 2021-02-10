<?php 
include("includes/includes.php");

$id_producto = $_POST["id"];
//$producto = $obj->get_row("select * from ds_tbl_producto where Id_Producto = $id_producto");
//ds_tbl_producto_detalle
//$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Producto = $id_producto");
//$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Producto = $id_producto");
//ds_tbl_precio_venta_producto
//$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = $id_producto");
//ds_tbl_costo_compra_producto
//$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = $id_producto");
//$producto = $obj->get_row("select *, ds_tbl_producto_detalle.Id_Producto_Detalle as Id_Producto_Detalle from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = $id_producto");
$producto = $obj->get_row("select *, ds_tbl_producto_detalle.Id_Producto_Detalle as Id_Producto_Detalle from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = $id_producto");

//Id_Producto_Detalle
//print_r($producto);

// [] => 1 [] => 86897 [impuesto_adicional] => 987987987 [costo_dolares] => 89789789 [iva] => 789798 ) 

// [id_producto] => 1 [costo_compra] => 86897 [impuesto_adicional] => 987987987 [costo_dolares] => 89789789 [iva] => 789798 ) 
// 
/*
if($producto->Id_Producto_Detalle != ""){
    echo "sin producto detalle";
}else{
    $id_producto_detalle = $producto->Id_Producto_Detalle;
    echo "con producto detalle";
}
*/
?>
<form method="post" action="">
	<input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>" />
	<input type="hidden" name="id_producto_detalle" value="<?php echo $producto->Id_Producto_Detalle; ?>" />
    <div class="form-row">
        <div class="form-group col-md-6">
         	<div>Producto:</div>
    		<?php echo $producto->Nombre; ?>
        </div>
       
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
         	<div>Costo de compra</div>
    		<input type="text" name="costo_compra" id="costo_compra" value="<?php echo $producto->Costo_Compra; ?>" />
        </div>
        <div class="form-group col-md-6">
         	<div>Impuesto adicional</div>
            <input type="text" name="impuesto_adicional" id="impuesto_adicional" value="<?php echo $producto->Impuesto_Adicional; ?>" />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
         	<div>Costo de compra en Dolares</div>
    		<input type="text" name="costo_dolares" id="costo_dolares" value="<?php echo $producto->Dolar; ?>" />
        </div>
        <div class="form-group col-md-6">
         	<div>Aplica IVA</div>
            <input type="text" name="iva" id="iva" value="<?php echo $producto->IVA; ?>" />
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-6">
    		<input type="submit" value="Guardar" name="" id="" />
        </div>
        
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
    		Valor USD: <?php echo $producto->Valor_Tipo_Cambio_Dolar; ?>
        </div>
       
    </div>
</form>