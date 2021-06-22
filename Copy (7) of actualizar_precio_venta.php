<?php include("includes/includes.php");
?>
<?php 
$precio = $_POST["precio"];

$id = $_POST["id"];

$divisas = $obj->get_results("select * from ds_cat_tipo_cambio");

$divisa = $_POST["divisa"];


$tipo_cambio_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");

$tipo_cambio_dolar = $tipo_cambio_val->Valor;


$tipo_cambio_euro_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 2");

$tipo_cambio_euro = $tipo_cambio_euro_val->Valor;


//if($_POST["id_producto"] != "" && $_POST["id_producto_detalle"] != "" && $_POST["costo_compra"] != "" ){
if($_POST["id"] != "" && $_POST["precio"] != "" && $_POST["divisa"] != ""){
    
    $qry_producto_detalle = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_producto.Id_Producto = $id";
    
    $producto_detalle = $obj->get_row($qry_producto_detalle);
    $id_producto_detalle = $producto_detalle->Id_Producto_Detalle;
    
    
    
    
    $id_producto = $_POST["id"];
    
    if($divisa == 1){
        //DOLAR
        $precio_compra = $_POST["precio"] * $tipo_cambio_dolar;
        $precio_dolares = $_POST["precio"];
        
        $precio_euros = $_POST["precio"] / $tipo_cambio_euro;
        
    }
    if($divisa == 2){
        //EURO
        $precio_compra = $_POST["precio"] * $tipo_cambio_euro;
        $precio_dolares = $_POST["precio"] / $tipo_cambio_dolar;
        
        $precio_euros = $_POST["precio"];
        
    }
    if($divisa == 3){
        //PESO
        $precio_compra = $_POST["precio"];
        $precio_dolares = $_POST["precio"] / $tipo_cambio_dolar;
        $precio_euros = $_POST["precio"] / $tipo_cambio_euro;
        
        
    }
    
    $precio_venta = $_POST["precio"];
    $impuesto_adicional = 0;
    //$precio_dolares = $_POST["precio"] / $tipo_cambio_dolar;
    $iva = 16;
    $fecha_actualizacion = date("Y-m-d H:i:s");
    
    //$qry_precio_producto_actual = "select * from ds_tbl_costo_compra_producto where ds_tbl_costo_compra_producto.Id_Producto_Detalle = $id_producto_detalle";
    $qry_precio_producto_actual = "select * from ds_tbl_precio_venta_producto where ds_tbl_precio_venta_producto.Id_Producto_Detalle = $id_producto_detalle";
    
    //echo $qry_costo_producto_actual . "<br />";
    $precio_producto_actual = $obj->get_row($qry_precio_producto_actual);
    
    //print_r($precio_producto_actual);
    //echo $precio_producto_actual->Costo_Compra;
    if($precio_producto_actual->Costo_Venta != ""){
        //UPDATE
        //echo "update";
        
        $id_precio_venta_producto = $precio_producto_actual->Id_Precio_Venta;
        $precio_venta_anterior = $precio_producto_actual->Costo_Venta;
        $valor_dolar_anterior = $precio_producto_actual->Valor_Tipo_Cambio_Dolar;
        //$qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //$qry_insert_costo_producto_actual = "insert into  (Id_Producto_Detalle, , , , , , , , ) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //echo "HEY";
        //$qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $costo_dolares, Valor_Tipo_Cambio_Anterior = $costo_dolares)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);
        $qry_update_costo_producto = "update ds_tbl_precio_venta_producto set Costo_Venta = $precio_venta, Costo_Venta_Anterior = $precio_venta_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $precio_dolares, Valor_Tipo_Cambio_Dolar = $tipo_cambio_dolar, Valor_Tipo_Cambio_Anterior = $valor_dolar_anterior where Id_Producto_Detalle = $id_producto_detalle and Id_Precio_Venta = $id_precio_venta_producto";
        //echo $qry_update_costo_producto;
        $obj->query($qry_update_costo_producto);
        
        
        
        if($precio_producto_actual->Dolar != $precio_dolares && ($precio_dolares != 0 || $precio_dolares != "")){
            $ch = curl_init();
            // Establecer URL y otras opciones apropiadas
            $url_correo = "http://cabastic.info/correo_cambio_precio.php?precio_actual=" . $precio_producto_actual->Dolar . "&precio_nuevo=" . $precio_dolares . "&id_producto=" . $id_producto . "&usuario=" . $_SESSION["username"];
            //echo $url_correo;
            
            curl_setopt($ch, CURLOPT_URL, $url_correo);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            
            // Capturar la URL y pasarla al navegador
            curl_exec($ch);
            // Cerrar el recurso cURL y liberar recursos del sistema
            curl_close($ch);
        }
        
    }else{
        //echo "insert";
        //INSERT
        //
        //Id_Costo_Producto 	 	Costo_Mxn 	Costo_Dolar 	 	 	 	 	 	 	Euro 	Libra
        
        //$qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $tipo_cambio_dolar, $tipo_cambio_dolar)";
        $qry_insert_costo_producto_actual = "insert into ds_tbl_precio_venta_producto (Id_Producto_Detalle, Costo_Venta, Costo_Venta_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $precio_venta, $precio_venta, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $precio_dolares, $tipo_cambio_dolar, $tipo_cambio_dolar)";
        
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);

        //echo $qry_insert_costo_producto_actual . "<br />";
        //echo $qry_insert_costo_producto_actual;
        $obj->query($qry_insert_costo_producto_actual);
    }
    
    
    
    
    
    $qry_precio_resultado = "select * from ds_tbl_precio_venta_producto where ds_tbl_precio_venta_producto.Id_Producto_Detalle = $id_producto_detalle";
    //echo $qry_costo_resultado;
    $precio_producto_actual = $obj->get_row($qry_precio_resultado);
    
    //print_r($costo_producto_actual);
    
    //echo $costo_producto_actual->Costo_Compra;
    
    //echo "HA";
    
    $id_resultado = $producto_detalle->Id_Producto;
    ?>
    
    <div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($precio_producto_actual->Dolar != ""){ $dolar_precio = $precio_producto_actual->Dolar * $tipo_cambio_dolar; $res_pintar_precio = "$" . number_format($dolar_precio, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><select name="select_divisa_precio<?php echo $id_resultado; ?>" id="select_divisa_precio<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $precio_producto_actual->Dolar; ?>" style=" width:55px;" /><i class="icon-checkmark4 mr-3 icon-1x" onclick="actualizar_precio($('#input_precio<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);"></i></div>
    								
    
    <?php /**
    <div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($precio_producto_actual->Costo_Venta != ""){ $res_pintar_precio = $precio_producto_actual->Costo_Venta; }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $precio_producto_actual->Costo_Venta; ?>" onblur="actualizar_precio(this.value, <?php echo $id_resultado; ?>);" /></div>

    
    <div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $costo_producto_actual->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div>
    */ ?>
    <?php 
    
    
}
?>
<?php 
if($_POST["id"] != "" && $_POST["precio"] == ""){
    $qry_producto_detalle = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_producto.Id_Producto = $id";
    
    $producto_detalle = $obj->get_row($qry_producto_detalle);
    $id_producto_detalle = $producto_detalle->Id_Producto_Detalle;
    
    $qry_precio_resultado = "select * from ds_tbl_precio_venta_producto where ds_tbl_precio_venta_producto.Id_Producto_Detalle = $id_producto_detalle";
    //echo $qry_costo_resultado;
    $precio_producto_actual = $obj->get_row($qry_precio_resultado);
    
    //print_r($costo_producto_actual);
    
    //echo $costo_producto_actual->Costo_Compra;
    
    //echo "HA";
    
    $id_resultado = $producto_detalle->Id_Producto;
    ?>
    
    <div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($precio_producto_actual->Dolar != ""){ $dolar_precio = $precio_producto_actual->Dolar * $tipo_cambio_dolar; $res_pintar_precio = "$" . number_format($dolar_precio, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><select name="select_divisa_precio<?php echo $id_resultado; ?>" id="select_divisa_precio<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input_precio<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $precio_producto_actual->Dolar; ?>" style=" width:55px;" /><i class="icon-checkmark4 mr-3 icon-1x" onclick="actualizar_precio($('#input_precio<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);"></i></div>
    
    
    <?php 
    /**
    <div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($precio_producto_actual->Costo_Venta != ""){ $res_pintar_precio = "$" . number_format($precio_producto_actual->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><select name="select_divisa_precio<?php echo $id_resultado; ?>" id="select_divisa_precio<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input_precio<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $precio_producto_actual->Costo_Venta; ?>" style=" width:55px;" /><i class="icon-checkmark4 mr-3 icon-1x" onclick="actualizar_precio($('#input_precio<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);"></i></div>
    
     * 
     * 
    <div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($precio_producto_actual->Costo_Venta != ""){ $res_pintar_precio = "$" . number_format($precio_producto_actual->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $precio_producto_actual->Costo_Venta; ?>" onblur="actualizar_precio(this.value, <?php echo $id_resultado; ?>);" style=" width:55px;" /></div>
    
     * 
     * <div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($precio_producto_actual->Costo_Venta != ""){ $res_pintar_precio = number_format($precio_producto_actual->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $precio_producto_actual->Costo_Venta; ?>" onblur="actualizar_precio(this.value, <?php echo $id_resultado; ?>);" /></div>
    
    */
}
?>