<?php include("includes/includes.php");
?>
<?php 
/**
 * $qry_resultado_detalle_cantidad_producto = "select * from ds_tbl_cantidad_minima_producto where Id_Producto_Detalle = {$id_producto_detalle} and Fecha_alta = '{$val_fecha_alta}' limit 1";
    $resultado_detalle_cantidad_producto = $obj->get_row($qry_resultado_detalle_cantidad_producto);
    
    $id_cantidad_producto = $resultado_detalle_cantidad_producto->Id_Cantidad_Producto;
    
    $qry_insert_detalle_inventario_almacen = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Cantidad_Inventario, Id_Cantidad_Producto, Fecha_Actualizacion) values ({$id_producto_detalle}, {$cantidad_inventario}, {$id_cantidad_producto}, '{$val_fecha_alta}')";
    $obj->query($qry_insert_detalle_cantidad_producto);
*/
?>
<?php 
$existencia = $_POST["existencia"];

$id = $_POST["id"];



//if($_POST["id_producto"] != "" && $_POST["id_producto_detalle"] != "" && $_POST["costo_compra"] != "" ){
if($_POST["id"] != "" && $_POST["existencia"] != ""){
    
    $qry_producto_detalle = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_producto.Id_Producto = $id";
    
    $producto_detalle = $obj->get_row($qry_producto_detalle);
    $id_producto_detalle = $producto_detalle->Id_Producto_Detalle;
    
    
    
    
    $id_producto = $_POST["id"];
    $impuesto_adicional = 0;
    
    $iva = 16;
    $fecha_actualizacion = date("Y-m-d H:i:s");
    
    //$qry_costo_producto_actual = "select * from ds_tbl_costo_compra_producto where ds_tbl_costo_compra_producto.Id_Producto_Detalle = $id_producto_detalle";
    //select * from ds_tbl_cantidad_minima_producto where Id_Producto_Detalle = {$id_producto_detalle} and Fecha_alta = '{$val_fecha_alta}' limit 1
    $qry_existencia_actual = "select * from ds_tbl_inventario_almacen where Id_Producto_Detalle = $id_producto_detalle";
    //
    
    //echo $qry_costo_producto_actual . "<br />";
    $existencia_actual = $obj->get_row($qry_existencia_actual);
    
    //print_r($precio_producto_actual);
    //echo $precio_producto_actual->Costo_Compra;
    if($existencia_actual->Cantidad_Inventario != ""){
        //UPDATE
        //echo "update";
        
        $id_existencia_producto = $existencia_actual->Id_Inventario;
        
        //$qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //$qry_insert_costo_producto_actual = "insert into  (Id_Producto_Detalle, , , , , , , , ) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //echo "HEY";
        //$qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $costo_dolares, Valor_Tipo_Cambio_Anterior = $costo_dolares)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);
        //$qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $tipo_cambio_dolar, Valor_Tipo_Cambio_Anterior = $valor_dolar_anterior where Id_Producto_Detalle = $id_producto_detalle and Id_Costo_Producto = $id_costo_compra_producto";
        //echo $qry_update_costo_producto;
        //$qry_inventario_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $tipo_cambio_dolar, Valor_Tipo_Cambio_Anterior = $valor_dolar_anterior where Id_Producto_Detalle = $id_producto_detalle and Id_Costo_Producto = $id_costo_compra_producto";
        $qry_inventario_producto = "update ds_tbl_inventario_almacen set Cantidad_Inventario = $existencia, Fecha_Actualizacion = '{$fecha_actualizacion}' where Id_Producto_Detalle = $id_producto_detalle and Id_Inventario = $id_existencia_producto";
        $obj->query($qry_inventario_producto);
        
    }else{
        //echo "insert";
        //INSERT
        //
        //Id_Costo_Producto 	 	Costo_Mxn 	Costo_Dolar 	 	 	 	 	 	 	Euro 	Libra
        
        //$qry_insert_inventario_actual = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $tipo_cambio_dolar, $tipo_cambio_dolar)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);

        $qry_insert_inventario_actual = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Cantidad_Inventario) values ($id_producto_detalle, $wxistencia)";
        //
        //echo $qry_insert_costo_producto_actual . "<br />";
        //echo $qry_insert_costo_producto_actual;
        $obj->query($qry_insert_inventario_actual);
    }
    
    
    
    
    
    $qry_inventario_resultado = "select * from ds_tbl_inventario_almacen where ds_tbl_inventario_almacen.Id_Producto_Detalle = $id_producto_detalle";
    //echo $qry_costo_resultado;
    $inventario_actual = $obj->get_row($qry_inventario_resultado);
    
    //print_r($costo_producto_actual);
    
    //echo $costo_producto_actual->Costo_Compra;
    
    //echo "HA";
    
    $id_resultado = $producto_detalle->Id_Producto;
    ?>
    <div id="resultado_input_existencia<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_existencia<?php echo $id_resultado; ?>').show(); $('#input_existencia<?php echo $id_resultado; ?>').focus();"><?php echo $inventario_actual->Cantidad_Inventario; //echo $resultado->Costo_Venta; ?></div>
    
    
    <?php /**
    <div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $costo_producto_actual->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div>
    */ ?>
    <?php 
    
    
}
?>



