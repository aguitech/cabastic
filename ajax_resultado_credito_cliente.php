<?php include("includes/includes.php"); ?>
<?php //print_r($_POST); ?>
<?php 
$id_cliente = $_POST["cliente"];

//$qry_result = "select * from ds_tbl_venta where Id_Cliente = $id_cliente";
//left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta
$qry_result = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id_cliente and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
$resultados = $obj->get_results($qry_result);

//print_r($resultados);
$qry_cliente = "select * from ds_tbl_cliente where Id_Cliente = $id_cliente";
$cliente = $obj->get_row($qry_cliente);

?>

<div id="resultados_ventas">
	<div class="card-header header-elements-inline">
    	<h5 class="card-title">&nbsp;</h5>
    	<div class="header-elements">
    		<div class="list-icons">
        		<!-- 
        		<a class="list-icons-item" data-action="collapse"></a>
        		<a class="list-icons-item" data-action="reload"></a>
        		-->
        		<a class="list-icons-item" data-action="remove" onclick="$('#banner_fondo').hide(); $('#banner_contenido').hide(); "></a>
        	</div>
    	</div>
    </div>
	<b style="font-size:18px; padding-left:40px;"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></b>
	<table class="table datatable-basic">
		<thead>
			<tr>
				<th>Fecha de Venta</th>
				<th>Monto</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				
				<th class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
							<?php $sumatoria_total = 0; ?>
							<?php foreach($resultados as $resultado): ?>
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
							
							
							
							$resultado->MontoTotalMXN;
							$qry_abonos = "select sum(Monto_Abono) as sumatoria from ds_tbl_venta_abono where Id_Venta = $id_resultado";
							$res_abono = $obj->get_row($qry_abonos);
							
							$deuda_restante = $resultado->MontoTotalMXN - $res_abono->sumatoria;
							
							?>
						
                        	<?php if($deuda_restante > 0): ?>
							<tr id="element<?php echo $id_resultado; ?>">
                    			<td><?php echo $resultado->Fecha_Venta; ?></td>
                    			<td>$ <?php echo number_format($deuda_restante, 2); ?> MXN</td>
								<td>&nbsp;<?php //if($resultado->Activo == 1): echo "Activo"; else: echo "Inactivo"; endif; ?></td>
								<?php $sumatoria_total += $deuda_restante; ?>
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
												<?php /**
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><!-- <i class="icon-bin"></i>--> Pagar</a>
												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												*/ ?>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php endif; ?>
							<?php //endfor; ?>
							<?php endforeach; ?>
							
						</tbody>
						<tr>
            				<th><b>Total</b></th>
            				<th><b>$ <?php echo number_format($sumatoria_total, 2); ?> MXN</b></th>
            				<th>&nbsp;</th>
            				<th>&nbsp;</th>
            				<th>&nbsp;</th>
            				
            				<th class="text-center">&nbsp;</th>
            			</tr>
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
