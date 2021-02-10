<?php include("includes/includes.php");
?>
<?php 
$costo = $_POST["costo"];

$id = $_POST["id"];


$tipo_cambio_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");

$tipo_cambio_dolar = $tipo_cambio_val->Valor;

//if($_POST["id_producto"] != "" && $_POST["id_producto_detalle"] != "" && $_POST["costo_compra"] != "" ){
if($_POST["id"] != "" && $_POST["costo"] != ""){
    
    $qry_producto_detalle = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_producto.Id_Producto = $id";
    
    $producto_detalle = $obj->get_row($qry_producto_detalle);
    $id_producto_detalle = $producto_detalle->Id_Producto_Detalle;
    
    
    
    
    $id_producto = $_POST["id"];
    $costo_compra = $_POST["costo"];
    $impuesto_adicional = 0;
    $costo_dolares = $_POST["costo"] / $tipo_cambio_dolar;
    $iva = 16;
    $fecha_actualizacion = date("Y-m-d H:i:s");
    
    $qry_costo_producto_actual = "select * from ds_tbl_costo_compra_producto where ds_tbl_costo_compra_producto.Id_Producto_Detalle = $id_producto_detalle";
    
    //echo $qry_costo_producto_actual . "<br />";
    $precio_producto_actual = $obj->get_row($qry_costo_producto_actual);
    
    //print_r($precio_producto_actual);
    //echo $precio_producto_actual->Costo_Compra;
    if($precio_producto_actual->Costo_Compra != ""){
        //UPDATE
        //echo "update";
        
        $id_costo_compra_producto = $precio_producto_actual->Id_Costo_Producto;
        $costo_compra_anterior = $precio_producto_actual->Costo_Compra;
        $valor_dolar_anterior = $precio_producto_actual->Valor_Tipo_Cambio_Dolar;
        //$qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //$qry_insert_costo_producto_actual = "insert into  (Id_Producto_Detalle, , , , , , , , ) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //echo "HEY";
        //$qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $costo_dolares, Valor_Tipo_Cambio_Anterior = $costo_dolares)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);
        $qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $tipo_cambio_dolar, Valor_Tipo_Cambio_Anterior = $valor_dolar_anterior where Id_Producto_Detalle = $id_producto_detalle and Id_Costo_Producto = $id_costo_compra_producto";
        //echo $qry_update_costo_producto;
        $obj->query($qry_update_costo_producto);
        
    }else{
        //echo "insert";
        //INSERT
        //
        //Id_Costo_Producto 	 	Costo_Mxn 	Costo_Dolar 	 	 	 	 	 	 	Euro 	Libra
        
        $qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $tipo_cambio_dolar, $tipo_cambio_dolar)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);

        //echo $qry_insert_costo_producto_actual . "<br />";
        //echo $qry_insert_costo_producto_actual;
        $obj->query($qry_insert_costo_producto_actual);
    }
    
    
    
    
    
    $qry_costo_resultado = "select * from ds_tbl_costo_compra_producto where ds_tbl_costo_compra_producto.Id_Producto_Detalle = $id_producto_detalle";
    //echo $qry_costo_resultado;
    $costo_producto_actual = $obj->get_row($qry_costo_resultado);
    
    //print_r($costo_producto_actual);
    
    //echo $costo_producto_actual->Costo_Compra;
    
    //echo "HA";
    
    $id_resultado = $producto_detalle->Id_Producto;
    ?>
    
    <div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php echo $costo_producto_actual->Costo_Compra; //echo $resultado->Costo_Venta; ?></div>
    
    
    <?php /**
    <div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $costo_producto_actual->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div>
    */ ?>
    <?php 
    
    
}
?>



