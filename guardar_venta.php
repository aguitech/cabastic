<?php
include("includes/includes.php");


?>
<div style="padding:25px;">
	<?php /**
	CERRAR DESACTIVADO
	<div class="card-header header-elements-inline">
    	<h5 class="card-title">&nbsp;</h5>
    	<div class="header-elements">
    		<div class="list-icons">
        		
        		<a class="list-icons-item" data-action="remove" onclick="$('#fondo_especial').hide('slow'); $('#banner_especial').hide('slow');"></a>
        	</div>
    	</div>
    </div>
    */ ?>
    
    
    <!-- 
    <div onclick="$('#fondo_especial').hide('slow'); $('#banner_especial').hide('slow');">
    	CerrarXXX
    </div>
    -->
    
    <?php 
    /**
    <br />
    print_r($_POST);
    print_r($_SESSION);
    */
    ?>
    <?php  ?>
    <?php 
    $indice_actual = 0;
    
    
    /*
    Array ( [id] => 0 [id_cliente] => 1 [id_evento] => 1 )
    Array ( [login] => ok [id_login] => 1 [nombre] => admin [sucede] => algo [cantidad_productos] => 4 [producto] => Array ( [0] => 3 ) [precio] => Array ( [0] => 7790.00 ) [cantidad] => Array ( [0] => 4 ) ) 
    
    *
    id_cliente] => 1 [id_evento] =>
    */
    
    //echo "<hr />";
    
    //echo $_POST["id_evento"];
    //echo "<br />";
    
    if($_POST["id_evento"] != ""){
        
        $id_evento = $_POST["id_evento"];
        
        
        $id_cliente = $_POST["id_cliente"];
        
        $fecha_actual = date("Y-m-d H:i:s");
        
        $monto_total = 0;
        
        foreach($_SESSION["producto"] as $producto){
            
            $producto_val = $_SESSION["producto"][$indice_actual];
            $cantidad_val = $_SESSION["cantidad"][$indice_actual];
            $precio_val = $_SESSION["precio"][$indice_actual];
            
            $monto_total += ($cantidad_val * $precio_val);
            
            //echo $monto_total . "<br />";
            
            $indice_actual++;
        }
        //$monto_total = "";
        
            //$qry_insert_venta = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Calle, Colonia, Id_Codigo_Postal, Fecha_Alta, Activo, Fecha_Cierre, Id_Empleado_Alta, Inventario_Revisado, Fecha_Revision_Inventario, Inventario_Revisado_Dia_Posterior, Fecha_Revision_Inventario_Dia_Posterior)";
        //
        //Textos completos	Id_Venta	Id_Cliente	Fecha_Venta	MontoTotal	Id_Evento	DescuentoPorcentaje	DescuentoPrecio	TipoCambio	MontoTotalMXN	IdEmpleado	plazo	frecuencia	id_Motivo_Cancelacion	fecha_Cancelacion
        //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, DescuentoPorcentaje, DescuentoPrecio, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion)";
        //
        //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, DescuentoPorcentaje, DescuentoPrecio, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}',  $id_evento, )";
        //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, DescuentoPorcentaje, DescuentoPrecio, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}', $monto_total,  $id_evento, )";
        
        $dolar_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");
        
        $dolar_valor = $dolar_val->Valor;
        
        $id_empleado = 1;
        
        $monto_total_dolar = $monto_total / $dolar_valor;
        
        //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}', $monto_total,  $id_evento, )";
        //
        //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado;)";
        //
        //$qry_insert_venta = "insert into ds_tbl_venta (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado) values ($id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado)";
        //
        $qry_venta_val = "select * from ds_tbl_venta order by Id_Venta desc limit 1";
        //echo "QUERY VENTA";
        
        
        
        //echo $qry_venta_val;
        $venta_val = $obj->get_row($qry_venta_val);
        
        //print_r($venta_val);
        
        $id_venta = $venta_val->Id_Venta + 1;
        
        //$qry_insert_venta = "insert into ds_tbl_venta (Id_Venta, Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado) values ($id_venta, $id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado)";
        //$qry_insert_venta = "insert into ds_tbl_venta (Id_Venta, Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado) values ($id_venta, $id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado)";
        //DescuentoPorcentaje	DescuentoPrecio
        $descuento_porcentaje = 0;
        $descuento_precio = 0;
        
        $qry_insert_venta = "insert into ds_tbl_venta (Id_Venta, Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado, DescuentoPorcentaje, DescuentoPrecio) values ($id_venta, $id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado, $descuento_porcentaje, $descuento_precio)";
        //echo $qry_insert_venta; 
        
        $obj->query($qry_insert_venta);
        
        
        //ds_tbl_venta_detalle
        
        $indice_actual_detalle = 0;
        foreach($_SESSION["producto"] as $producto){
            
            $producto_val = $_SESSION["producto"][$indice_actual_detalle];
            $cantidad_val = $_SESSION["cantidad"][$indice_actual_detalle];
            $precio_val = $_SESSION["precio"][$indice_actual_detalle];
            
            $monto_total += ($cantidad_val * $precio_val);
            
            //echo $monto_total . "<br />";
            
            $indice_actual_detalle++;
            
            
            $qry_producto_detalle = "select * from ds_tbl_producto_detalle where Id_Producto = $producto_val";
            $producto_detalle_val = $obj->get_row($qry_producto_detalle);
            
            $id_producto_detalle = $producto_detalle_val->Id_Producto_Detalle;
            
            //$qry_insert_venta_detalle = "insert into ds_tbl_venta_detalle (Id_Producto_Detalle, Cantidad, MontoVenta, Id_Venta, Id_Motivo_Devolucion) values ($producto_val, $cantidad_val, $precio_val, $id_venta, 0)";
            $qry_insert_venta_detalle = "insert into ds_tbl_venta_detalle (Id_Producto_Detalle, Cantidad, MontoVenta, Id_Venta, Id_Motivo_Devolucion) values ($id_producto_detalle, $cantidad_val, $precio_val, $id_venta, 0)";
            
            $obj->query($qry_insert_venta_detalle);
            
            
        }
        
    }
    
    $qry_metodos_pago = "select * from ds_cat_metodo_pago";
    $metodos_pago = $obj->get_results($qry_metodos_pago);
    
    $qry_detalle_venta = "select * from ds_tbl_venta where Id_Venta = $id_venta";
    
    //echo $qry_detalle_venta;
    
    $detalle_venta = $obj->get_row($qry_detalle_venta);
    
    
    ?>
    <div>
    	<div>
    		<div class="form-row">
        		<div class="form-group col-md-4">
        			Fecha de venta:<br />
        			<b style="font-size:20px;"><?php echo $detalle_venta->Fecha_Venta; ?></b>
    		
        		</div>
        		<div class="form-group col-md-4">
        			Monto Total MXN:<br />
        			<b style="font-size:20px;"><?php echo $detalle_venta->MontoTotalMXN; ?></b>
    		
        		</div>
        		<div class="form-group col-md-4">
        			Monto Total USD:<br />
        			<b style="font-size:20px;"><?php echo $detalle_venta->MontoTotal; ?></b>
    		
        		</div>
        	</div>
    		<?php //print_r($detalle_venta); ?>
    		<br />
    		<br />
    		
    		
    	</div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
         	<select class="form-control"  id="id_metodo_pago" name="id_metodo_pago" onchange="activar_metodo_pago(this.value, <?php echo $id_venta; ?>);">
                <option value="">Selecciona</option>
                <?php foreach($metodos_pago as $metodo_pago){ ?>
                	<option value="<?php echo $metodo_pago->Id_Forma_Pago; ?>"><?php echo $metodo_pago->Descripcion; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-6">
         	&nbsp;
        </div>
    </div>
    
    
    
    

</div>