
<?php include("includes/includes.php"); ?>
<?php //print_r($_POST); ?>
<?php 
$id_venta = $_POST["venta"];

//$qry_result = "select * from ds_tbl_venta where Id_Cliente = $id_cliente";
//left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta
//$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id_cliente and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Venta = $id_venta and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Venta = $id_venta and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id_venta and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Venta = $id_venta and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//$resultados = $obj->get_results($qry_result);
//$resultado = $obj->get_results($qry_result);
$resultado = $obj->get_row($qry_result);

//print_r($resultados);
//$qry_cliente = "select * from ds_tbl_cliente where Id_Cliente = $id_cliente";
//ds_tbl_venta
//$qry_cliente = "select * from ds_tbl_venta left join ds_tbl_cliente on ds_tbl_venta.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta.Id_Venta = $id_venta";
//
$qry_cliente = "select * from ds_tbl_venta left join ds_tbl_cliente on ds_tbl_venta.Id_Cliente = ds_tbl_cliente.Id_Cliente left join ds_tbl_venta_detalle on ds_tbl_venta_detalle.Id_Venta = ds_tbl_venta.Id_Venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Venta = $id_venta";
$cliente = $obj->get_row($qry_cliente);
//print_r($cliente);
?>
<div id="">
	<hr />
	<table style="width:100%;">
		<tr>
			<?php /*
			<td><b style="font-size:18px; padding-left:40px;"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></b></td>
			
			 *<td style="text-align:right;"><b style="font-size:18px; padding-left:40px;">$ <?php echo $resultado->MontoTotal; ?> USD</b><br /><span style="font-size:15px; padding-left:40px;"><?php echo $resultado->Fecha_Venta; ?></span></td>
			<td><b style="font-size:18px; padding-left:40px;"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></b></td>
			
			 */ ?>
			 <td>
			 	<b>Detalle de la venta</b><br />
			 	<span style="font-size:15px; "><?php echo $resultado->Fecha_Venta; ?></span>
			 	
				
			 </td>
			 <?php
			 
			 $resultado->MontoTotalMXN;
			 $qry_abonos = "select sum(Monto_Abono) as sumatoria from ds_tbl_venta_abono where Id_Venta = $id_venta";
			 $res_abono = $obj->get_row($qry_abonos);
			 
			 $deuda_restante = $resultado->MontoTotalMXN - $res_abono->sumatoria;
			 ?>
			 <td style="text-align:right;">Deuda restante<br /><b style="font-size:18px; padding-left:40px;">$ <?php echo number_format($deuda_restante, 2); ?> MXN</b></td>
			<?php /**
			<td><?php echo $qry_abonos; print_r($res_abono); ?></td>
			*/ ?>
		</tr>
	</table>
	
	
	
	
					
					<?php 
					//$qry_productos = "select * from ds_tbl_venta_detalle where Id_Venta = $id_venta";
					//$productos = $obj->get_results($qry_productos);
					//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle  where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					
					$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					
					$productos = $obj->get_results($qry_productos);
					
					
					
					$qry_tipo_cambio = "select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1";
					$tipo_cambio = $obj->get_row($qry_tipo_cambio);
					
					//print_r($productos);
					?>
					<table class="table datatable-basic">
						<thead>
    						<tr>
                				<th>Cantidad</th>
                				<th>C&oacute;digo de Barras</th>
                				<th>Producto</th>
                				<th>Descripci&oacute;n</th>
                				
                				<th class="text-center">&nbsp;</th>
                			</tr>
            			</thead>
            			<tbody>
            				<?php foreach($productos as $producto): ?>
            				<?php $id_producto = $producto->Id_Producto; ?>
            				
                			<tr id="element<?php echo $id_producto; ?>">
    								
    								
                    			<td><?php echo $producto->Cantidad; ?></td>
    							<td><?php echo $producto->Codigo_Barras; ?></td>
    							<td><?php echo $producto->Nombre; ?></td>
                    			<td><?php echo $producto->Descripcion; //print_r($producto); ?></td>
                    			
                    			<?php /**
    							<td><?php echo (($producto->Dolar * ($producto->IVA / 100)) + $producto->Dolar); //echo $producto->MontoVenta; ?></td>
    							
    							
    							<td><?php echo ($producto->Dolar * ($producto->IVA / 100)) + $producto->Dolar; //echo $producto->MontoVenta; ?></td>
    							
    							<td><?php echo (($producto->MontoVenta * 1.16) / $tipo_cambio->Valor); //echo $producto->MontoVenta; ?></td>
    							<td><?php echo (($producto->MontoVenta * 1.16) / $tipo_cambio->Valor); //echo $producto->MontoVenta; ?></td>
    							
    							<td><?php echo $producto->MontoVenta; //echo $producto->MontoVenta; ?></td>
    							<td><?php echo ($producto->Dolar * ($producto->IVA / 100)) + $producto->Dolar; //echo $producto->MontoVenta; ?></td>
    							*/ ?>
    							<td class="text-center">
    								<div class="list-icons">
    									<div class="dropdown">
    										<a href="#" class="list-icons-item" data-toggle="dropdown">
    											<i class="icon-menu9"></i>
    										</a>
    
    										<div class="dropdown-menu dropdown-menu-right">
    											<a href="#" class="dropdown-item" onclick="realizar_pago(<?php echo $id_venta; ?>);"><!-- <i class="icon-bin"></i>--> Pagar</a>
    											<?php /**
    											<a onclick="detalle_venta('<?php echo $id_producto; ?>')" class="dropdown-item"><!-- <i class="icon-pencil4"></i>--> Ver detalle</a>
    											<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
    											*/ ?>
    										</div>
    									</div>
    								</div>
    							</td>
    						</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
					
					<table style="width:100%;">
                		<tr>
                			<?php /*
                			<td><b style="font-size:18px; padding-left:40px;"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></b></td>
                			
                			 *<td style="text-align:right;"><b style="font-size:18px; padding-left:40px;">$ <?php echo $resultado->MontoTotal; ?> USD</b><br /><span style="font-size:15px; padding-left:40px;"><?php echo $resultado->Fecha_Venta; ?></span></td>
                			<td><b style="font-size:18px; padding-left:40px;"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></b></td>
                			
                			 */ ?>
                			 <td>
                			 	<b>Detalle pagos</b><br />
                			 	<span style="font-size:15px; "><?php echo $resultado->Fecha_Venta; ?></span>
                			 	
                				
                			 </td>
                			 <?php
                			 
                			 $resultado->MontoTotalMXN;
                			 $qry_abonos = "select sum(Monto_Abono) as sumatoria from ds_tbl_venta_abono where Id_Venta = $id_venta";
                			 $res_abono = $obj->get_row($qry_abonos);
                			 
                			 $deuda_restante = $resultado->MontoTotalMXN - $res_abono->sumatoria;
                			 ?>
                			 <td style="text-align:right;">Deuda total<br /><b style="font-size:18px; padding-left:40px;">$ <?php echo number_format($resultado->MontoTotalMXN, 2); ?> MXN</b></td>
                			 <td style="text-align:right;">Deuda restante<br /><b style="font-size:18px; padding-left:40px;">$ <?php echo number_format($deuda_restante, 2); ?> MXN</b></td>
                			<?php  /**
                			<td><?php echo $qry_abonos; print_r($res_abono); ?></td>
                			*/ ?>
                		</tr>
                	</table>
                	
                	
                	
                	<?php 
					
					$qry_abono_res = "select * from ds_tbl_venta_abono where ds_tbl_venta_abono.Id_Venta = $id_venta";
					//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					
					$abono_res = $obj->get_results($qry_abono_res);
					
					
					
					//print_r($productos);
					?>
					<table class="table datatable-basic">
						<thead>
    						<tr>
                				<th>Fecha</th>
                				<th>Monto</th>
                				
                				<?php /**
                				<th class="text-center">&nbsp;</th>
                				*/ ?>
                			</tr>
            			</thead>
            			<tbody>
            				<?php foreach($abono_res as $abono): ?>
            				<?php $id_abono = $abono->Id_Venta_Abono; ?>
            				
                			<tr id="element<?php echo $id_abono; ?>">
    							<td><?php echo $abono->Fecha_Abono; ?></td>
    							
                    			<td>$<?php echo number_format($abono->Monto_Abono, 2); ?>MXN</td>
                    			<?php /**
                    			<td><?php echo (($producto->Dolar * ($producto->IVA / 100)) + $producto->Dolar); //echo $producto->MontoVenta; ?></td>
    							<td><?php echo ($producto->Dolar * ($producto->IVA / 100)) + $producto->Dolar; //echo $producto->MontoVenta; ?></td>
    							
    							<td><?php echo (($producto->MontoVenta * 1.16) / $tipo_cambio->Valor); //echo $producto->MontoVenta; ?></td>
    							<td><?php echo (($producto->MontoVenta * 1.16) / $tipo_cambio->Valor); //echo $producto->MontoVenta; ?></td>
    							
    							<td><?php echo $producto->MontoVenta; //echo $producto->MontoVenta; ?></td>
    							<td><?php echo ($producto->Dolar * ($producto->IVA / 100)) + $producto->Dolar; //echo $producto->MontoVenta; ?></td>
    							
    							*
    							*/ ?>
    							<?php /**
    							<td class="text-center">
    								<div class="list-icons">
    									<div class="dropdown">
    										<a href="#" class="list-icons-item" data-toggle="dropdown">
    											<i class="icon-menu9"></i>
    										</a>
    
    										<div class="dropdown-menu dropdown-menu-right">
    											<a href="#" class="dropdown-item" onclick="realizar_pago(<?php echo $id_venta; ?>);"><!-- <i class="icon-bin"></i>--> Pagar</a>
    											
    										</div>
    									</div>
    								</div>
    							</td>
    							*/ ?>
    						</tr>
							<?php endforeach; ?>
						</tbody>
					</table>					
				</div>
				<button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-left rounded-round" onclick="realizar_pago(<?php echo $id_venta; ?>)"><b><i class="icon-reading"></i></b> Realizar pago</button>