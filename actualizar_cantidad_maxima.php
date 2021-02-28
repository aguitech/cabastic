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
    
    $qry_existencia_actual = "select * from ds_tbl_cantidad_minima_producto where Id_Producto_Detalle = $id_producto_detalle";

    $existencia_actual = $obj->get_row($qry_existencia_actual);
    
    
    if($existencia_actual->Cantidad_Minima != "" || $existencia_actual->Cantidad_Maxima != ""){
        //UPDATE
        
        $id_existencia_producto = $existencia_actual->Id_Cantidad_Producto;
        
        $qry_inventario_producto = "update ds_tbl_cantidad_minima_producto set Cantidad_Maxima = $existencia, Fecha_Actualiza = '{$fecha_actualizacion}' where Id_Producto_Detalle = $id_producto_detalle and Id_Cantidad_Producto = $id_existencia_producto";
        $obj->query($qry_inventario_producto);
        
    }else{

        $qry_insert_inventario_actual = "insert into ds_tbl_cantidad_minima_producto (Id_Producto_Detalle, Cantidad_Maxima) values ($id_producto_detalle, $wxistencia)";
        $obj->query($qry_insert_inventario_actual);
    }
    
    
    
    
    
    $qry_inventario_resultado = "select * from ds_tbl_cantidad_minima_producto where ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = $id_producto_detalle";
    $inventario_actual = $obj->get_row($qry_inventario_resultado);
    
    
    $id_resultado = $producto_detalle->Id_Producto;
    ?>
    <div id="resultado_input_cantidad_maxima<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_cantidad_maxima<?php echo $id_resultado; ?>').show(); $('#input_cantidad_maxima<?php echo $id_resultado; ?>').focus();"><?php echo $inventario_actual->Cantidad_Maxima; //echo $resultado->Costo_Venta; ?></div>
    
    
    <?php /**
    <div id="resultado_input_existencia<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_existencia<?php echo $id_resultado; ?>').show(); $('#input_existencia<?php echo $id_resultado; ?>').focus();"><?php echo $inventario_actual->Cantidad_Inventario; //echo $resultado->Costo_Venta; ?></div>
    <div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $costo_producto_actual->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div>
    */ ?>
    <?php 
    
    
}
?>



