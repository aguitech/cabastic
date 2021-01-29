<?php include("includes/includes.php"); ?>
<?php //print_r($_POST); ?>
<?php 
$id_venta = $_POST["venta"];

//$qry_result = "select * from ds_tbl_venta where Id_Cliente = $id_cliente";
//left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta
//$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id_cliente and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Venta = $id_venta and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
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
print_r($cliente);
?>
<div id="">
	<b style="font-size:18px; padding-left:40px;"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></b>
	<table class="table datatable-basic">
		<thead>
			<tr>
				<th>ID</th>
				<th>Fecha de Venta</th>
				<th>Monto USD</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				
				<th class="text-center">Actions</th>
			</tr>
		</thead>
		<tbody>
							<?php $sumatoria_total = 0; ?>
							<?php //foreach($resultados as $resultado): ?>
							<?php $id_resultado = $resultado->Id_Venta; ?>

							<?php 
							
							$id_resultado=$resultado->Id_Venta;
							$nombre=$resultado->Fecha_Venta;
							$hexadecimal=$resultado->Id_Venta;
							$id_nivel="Hola";
							$extension="Hola";
							$area="Hola";
							$completo="Hola";
							$niveles="Hola";
							$id_usuario = $id_resultado;
							?>
						
                        
							<tr id="element<?php echo $id_resultado; ?>">
								
								
								<td><?php echo $id_resultado; ?></td>
                    			<td><a href="usuarios_editar.php?id=<?php echo $id_resultado; ?>"><?php echo $resultado->Fecha_Venta; ?></td>
                    			<td>$ <?php echo $resultado->MontoTotal; ?> USD</td>
								<td>&nbsp;<?php //if($resultado->Activo == 1): echo "Activo"; else: echo "Inactivo"; endif; ?></td>
								<?php $sumatoria_total += $resultado->MontoTotal?>
								
								
								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div></td>
								<td>&nbsp;</td>
								

								<?php /**
								<td><?php echo $hexadecimal; ?></td>
								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $color->Codigo_Hexadecimal; ?>"></div> <?php echo $color->Codigo_Hexadecimal; ?></td>
								*/ ?>
								
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a onclick="detalle_venta('<?php echo $id_resultado; ?>')" class="dropdown-item"><!-- <i class="icon-pencil4"></i>--> Ver detalle</a>
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><!-- <i class="icon-bin"></i>--> Pagar</a>
												<?php /**
												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												*/ ?>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php //endfor; ?>
							<?php //endforeach; ?>
							
						</tbody>
						<tr>
            				<th>Total</th>
            				<th>&nbsp;</th>
            				<th>$ <?php echo $sumatoria_total; ?> USD</th>
            				<th>&nbsp;</th>
            				<th>&nbsp;</th>
            				<th>&nbsp;</th>
            				
            				<th class="text-center">&nbsp;</th>
            			</tr>
					</table>
					
					
					
					<?php 
					//$qry_productos = "select * from ds_tbl_venta_detalle where Id_Venta = $id_venta";
					//$productos = $obj->get_results($qry_productos);
					//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle  where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					$productos = $obj->get_results($qry_productos);
					?>
					<table class="table datatable-basic">
						<thead>
    						<tr>
    							<th>ID</th>
                				<th>Cantidad</th>
                				<th>Producto</th>
                				<th>Descripci&oacute;n</th>
                				<th>Monto de Venta</th>
                				<th>C&oacute;digo de Barras</th>
                				
                				<th class="text-center">&nbsp;</th>
                			</tr>
            			</thead>
            			<tbody>
            				<?php foreach($productos as $producto): ?>
            				<?php $id_producto = $producto->Id_Producto; ?>
            				
                			<tr id="element<?php echo $id_producto; ?>">
    								
    								
    							<td><?php echo $id_producto; ?></td>
                    			<td><?php echo $producto->Cantidad; ?></td>
    							<td><a href="usuarios_editar.php?id=<?php echo $id_producto; ?>"><?php echo $producto->Nombre; ?></td>
                    			<td><?php echo $producto->Descripcion; ?></td>
    							<td><?php echo $producto->MontoVenta; ?></td>
    							<td><?php echo $producto->Codigo_Barras; ?></td>
    							<td class="text-center">
    								<div class="list-icons">
    									<div class="dropdown">
    										<a href="#" class="list-icons-item" data-toggle="dropdown">
    											<i class="icon-menu9"></i>
    										</a>
    
    										<div class="dropdown-menu dropdown-menu-right">
    											<a onclick="detalle_venta('<?php echo $id_producto; ?>')" class="dropdown-item"><!-- <i class="icon-pencil4"></i>--> Ver detalle</a>
    											<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_producto; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><!-- <i class="icon-bin"></i>--> Pagar</a>
    											<?php /**
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
					
				</div>

<?php /**

<table class="table datatable-basic">
	<thead>
		<tr>
			<th>ID</th>
			<th>Fecha</th>
			<th>Monto USD</th>
			
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			
			
			<th class="text-center">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($resultados as $resultado): ?>
		<?php $id_resultado = $resultado->Id_Venta; ?>
		<tr id="element<?php echo $id_resultado; ?>">
			<td><?php echo $id_resultado; ?></td>
			<td><a href="usuarios_editar.php?id=<?php echo $id_resultado; ?>"><?php echo $resultado->Fecha_Venta; ?></td>
			<td>$ <?php echo $resultado->MontoTotal; ?> USD</td>
			
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			
			
			
			<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'');"><i class="icon-bin"></i> Remove</a>
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
						
						</div>
					</div>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php //endfor; ?>

	</tbody>
</table>
*/ ?>
