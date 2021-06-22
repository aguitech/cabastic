<?php if(empty($_SESSION) || $_SESSION["cantidad_productos"] == 0 || $_SESSION["cantidad_productos"] == ""): ?>
sin resultados
<?php else: ?>
<!--	<form id = "paypal_checkout" action = "https://www.paypal.com/cgi-bin/webscr" method = "post">-->
<!--							<INPUT TYPE="hidden" name="charset" value="utf-8">-->
		<input type="hidden" name="charset" value="utf-8">
        <input name = "cmd" value = "_cart" type = "hidden">
        <input name = "upload" value = "1" type = "hidden">
        <input name = "no_note" value = "0" type = "hidden">
        <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
        <input name = "tax" value = "0" type = "hidden">
        <input name = "rm" value = "2" type = "hidden">
        
        <!-- Supongo es de descuento -->
<!--        <input type="hidden" name="baseamt" value="10.00" />-->
<!--        <input type="hidden" name="basedes" value="2nd Item @20.00" />-->
<!--        <input type="hidden" name="basedes" value="@20.00" />-->
     
<!--        <input name = "business" value = "hector@aguitech.com" type = "hidden">-->
        <input name = "business" value = "m_carrasco_@hotmail.com" type = "hidden">
        <input name = "handling_cart" value = "0" type = "hidden">
        <input name = "currency_code" value = "MXN" type = "hidden">
        <input name = "lc" value = "MX" type = "hidden">
<!--					        <input name = "return" value = "http://mysite/myreturnpage" type = "hidden">-->
<!--					        <input name = "cbt" value = "Return to My Site" type = "hidden">-->
<!--					        <input name = "cancel_return" value = "http://mysite/mycancelpage" type = "hidden">-->
        <input name = "return" value = "https://sevignemexico.com/transaccion.php" type = "hidden">
        <input name = "cbt" value = "Return to My Site" type = "hidden">
        <input name = "cancel_return" value = "https://sevignemexico.com/revisar-carrito.php" type = "hidden">
        <input name = "custom" value = "" type = "hidden">
        
        
<!--        <input name = "return" value = "http://blacklionsoftwarecompany.com/sevigne/transaccion.php" type = "hidden">-->
<!--        <input name = "cbt" value = "Return to My Site" type = "hidden">-->
<!--        <input name = "cancel_return" value = "http://blacklionsoftwarecompany.com/sevigne/revisar-carrito.php" type = "hidden">-->
<!--        <input name = "custom" value = "" type = "hidden">-->
        
     
<!--					        <div id = "item_1" class = "itemwrap">-->
<!--					            <input name = "item_name_1" value = "Gold Tickets" type = "hidden">-->
<!--					            <input name = "quantity_1" value = "4" type = "hidden">-->
<!--					            <input name = "amount_1" value = "30" type = "hidden">-->
<!--					            <input name = "shipping_1" value = "0" type = "hidden">-->
<!--					        </div>-->

<h3>Productos agregados</h3>
<table class="table datatable-basic">
	<thead>
	<tr>
		<th>&nbsp;</th>
		    
		<th colspan="3">CANTIDAD</th>
		<th>Producto</th>
		<th>Marca</th>
		<th>Color</th>
		<th>Talla</th>
		<th>Precio MXN</th>
		<th>Total</th>
		<th>Quitar</th>
		<!-- 
		<td colspan="3">CANTIDAD</td>
		<td>PRODUCTO</td>
		<td>PRECIO UNITARIO</td>
		<td>DESC. UNIT.</td>
		<td>PRECIO TOTAL</td>
		-->
	</tr>
	</thead>
	<tbody>
	<?php 
	//exit;
	$inc = 0;
	?>
	<?php foreach($_SESSION["producto"] as $clave => $valor){ ?>
	<tr>
		<?php $i = $clave; ?>
		<?php if($_SESSION["cantidad"][$i] != 0){ ?>
		<td>
			<?php 
			$qry_producto = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = {$_SESSION['producto'][$i]}";
			$producto = $obj->get_row($qry_producto);
		
			?>
			
		</td>
		<td>
			<div style="float:left; width:25px; cursor:pointer;" onclick="restar_producto('<?php echo $producto->Id_Producto; ?>')">
			
				(-)
			</div>
		</td>
		<td><?php echo $_SESSION["cantidad"][$i]; ?></td>
		<td>
			<?php /**
			<div style="float:left; width:25px; cursor:pointer;" onclick="agregar_producto('<?php echo $producto->id_inventario; ?>', 'agregar');">
			*/ ?>
			<div style="float:left; width:25px; cursor:pointer;" onclick="agregar_producto('<?php echo $producto->Id_Producto; ?>');">
				(+)
			</div>
		</td>
		<td><?php echo $producto->Nombre; ?></td>
		<?php /**?>
		*/ ?>
		<td><?php echo $producto->marca; ?></td>
		<td><?php echo $producto->color; ?></td>
		<td><?php echo $producto->talla; ?></td>
		<td><div id="resultado_precio_normal" onclick="$(this).hide(); $('#resultado_precio_actualizar<?php echo $producto->Id_Producto; ?>').show();"><?php echo "$" . number_format($producto->Costo_Venta, 2); ?></div><div id="resultado_precio_actualizar<?php echo $producto->Id_Producto; ?>" style="display:none;"><input type="text" name="" value="<?php echo $producto->Costo_Venta; ?>" onkeyup="actualizar_precio_admin(this.value, <?php echo $_SESSION["cantidad"][$i]; ?>, <?php echo $producto->Id_Producto; ?>)" /></div></td>
		<?php /**
		<td><?php echo "$" . number_format($producto->Costo_Venta, 2); ?></td>
		*/ ?>
		<td>
			<span id="resultado_precio_administrador<?php echo $producto->Id_Producto; ?>">
			<?php echo "$" . number_format($producto->Costo_Venta * $_SESSION["cantidad"][$i], 2); ?>
			<?php print_r($_SESSION); ?>
			<br />
			<?php echo $_SESSION["precio"][$i]; ?>
			</span>
		</td>
		
		
			
		
			<?php 
			$cantidad_precio = $producto->Costo_Venta * $_SESSION["cantidad"][$i];
			$importe_total+=$cantidad_precio;
			
			?>
			

			<div style="float:left; margin-left:20px; width:100px; cursor:pointer;" onclick="quitar_producto('<?php echo $producto->Id_Producto; ?>', 'quitar');">
				<i class="icon-cross3"></i>
			</div>
			<?php //exit();
			?>
			<?php $inc = $i+1; ?>
			<div id = "item_<?php echo $inc; ?>" class = "itemwrap">
	            <input name = "item_name_<?php echo $inc; ?>" value = "<?php echo $producto->Nombre; ?>" type = "hidden">
	            <input name = "quantity_<?php echo $inc; ?>" value = "<?php echo $_SESSION["cantidad"][$i]; ?>" type = "hidden">
	            <?php /**
	            <input name = "amount_<?php echo $inc; ?>" value = "<?php echo $producto["precio"] * (100 - $producto["descuento"]); ?>" type = "hidden">
	            <input name = "amount_<?php echo $inc; ?>" value = "<?php echo $producto["precio"] - ((100 / $producto["precio"]) * ($producto["descuento"])); ?>" type = "hidden">
	            */ ?>
	            
	            <input name = "amount_<?php echo $inc; ?>" value = "<?php echo $producto->Costo_Venta; ?>" type = "hidden">
	            
	            <?php /**
	            <?php if($producto->descuento == "" || $producto->descuento == "0"){ ?>
	            <input name = "amount_<?php echo $inc; ?>" value = "<?php echo $producto->precio; ?>" type = "hidden">
	            <?php }else{ ?>
	            <input name = "amount_<?php echo $inc; ?>" value = "<?php echo $precio_descuento; ?>" type = "hidden">
	            <?php } ?>
	            */ ?>
	            
	            <input name = "shipping_<?php echo $inc; ?>" value = "0" type = "hidden">
	        </div>
	        <?php $inc++; ?>
			<?php /**
			<?php $inc = $i+1; ?>
			<div id = "item_<?php echo $i; ?>" class = "itemwrap">
	            <input name = "item_name_<?php echo $inc; ?>" value = "<?php echo $producto["nombre_producto"]; ?>" type = "hidden">
	            <input name = "quantity_<?php echo $inc; ?>" value = "<?php echo $_SESSION["cantidad"][$i]; ?>" type = "hidden">
	            <input name = "amount_<?php echo $inc; ?>" value = "<?php echo $producto["precio"]; ?>" type = "hidden">
	            <input name = "shipping_<?php echo $inc; ?>" value = "0" type = "hidden">
	        </div>
	        */ ?>
			
		</td>
		
		<?php } ?>
	</tr>
	<?php } ?>
	<tr>
		<td colspan="9">
			&nbsp;
		</td>
		<td><b>$<?php echo number_format($importe_total, 2); ?></b></td>
	</tr>
	</tbody>
</table>




<div style="padding:20px;">
	<div class="form-row">
        <div class="form-group col-md-3">
         	<div>Descuento</div>
 			<input type="text" readonly="readonly" placeholder="Descuento porcentaje" name="descuento_porcentaje" id="descuento_porcentaje" value="" class="form-control" />
        </div>
        <div class="form-group col-md-3">
         	<div>Descuento en precio</div>
 			<input type="text" readonly="readonly"  placeholder="Descuento en precio" name="descuento_precio" id="descuento_precio" value="" class="form-control" />
        </div>
        <div class="form-group col-md-3">
         	<div>Tipo de cambio</div>
 		<input type="text" readonly="readonly"  placeholder="Tipo de cambio" name="tipo_cambio" id="tipo_cambio" value="" class="form-control" />

        </div>
        
    </div>
    <div style="margin-bottom:15px;">
    	<b>Desglose de precios</b>
    </div>
    <!-- 


    Sub Total MXN:
    
    $0.00
    
    Descuento:
    
    $0.00
    
    IVA:
    
    $0.00
    
    Total MXN:
    
    $0.00
    
    Total USD:
    
    $0.00
    ¿Exentar I.V.A.?
    
     -->
     <style>
       .iniciar_venta_totales_titulos{
            width:200px;
       }
    </style>

    <div class="form-row">
        <div class="form-group col-md-3">
         	<span class="iniciar_venta_totales_titulos">Sub Total MXN</span>
         </div>
         <div class="form-group col-md-3">
 			<b>$<?php echo number_format($importe_total, 2); ?></b>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
         	<span class="iniciar_venta_totales_titulos">Descuento:</span>
         </div>
         <div class="form-group col-md-3">
 			<b><?php echo number_format(0, 2); ?>%</b>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
         	<span class="iniciar_venta_totales_titulos">IVA:</span>
         </div>
         <div class="form-group col-md-3">
 			<b class="resultado_iva_normal">$<?php echo number_format(($importe_total * .16), 2); ?></b>
 			<b class="resultado_excentar_iva" style="display:none;">$<?php echo number_format(($importe_total * .0), 2); ?></b>
        </div>
	</div>
    <div class="form-row">
        <div class="form-group col-md-3">
         	<span class="iniciar_venta_totales_titulos">Total MXN</span>
         </div>
         <div class="form-group col-md-3">
 			<b class="resultado_iva_normal">$<?php echo number_format(($importe_total * 1.16) , 2); ?></b>
 			<b class="resultado_excentar_iva" style="display:none;">$<?php echo number_format(($importe_total * 1.00) , 2); ?></b>
        </div>
        <div class="form-group col-md-3">
         	<span class="iniciar_venta_totales_titulos">Total USD:</span>
         </div>
         <div class="form-group col-md-3">
 			<b class="resultado_iva_normal">$<?php echo number_format(($importe_total * 1.16) , 2); ?></b>
 			<b class="resultado_excentar_iva" style="display:none;"><?php echo number_format(($importe_total * 1.0) , 2); ?></b>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
        	<input type="checkbox" name="excentar_iva" id="excentar_iva" onchange="$('.resultado_excentar_iva').toggle(); $('.resultado_iva_normal').toggle();" />
        </div>
        <div class="form-group col-md-3">
        	<div>¿Exentar I.V.A.?</div>
        	
        	
        </div>
    </div>

</div>

<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="if(confirm('Tu venta ser&aacute; cerrada\ny no podr&aacute;s agregar mas productos.')){ guardar_venta(); }"><?php if(isset($resultado->id_venta) && $resultado->id_venta != ""): ?>ACTUALIZAR<?php else: ?>COBRAR<?php endif; ?> <i class="material-icons right">send</i></button>

<?php endif; ?>