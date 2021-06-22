<?php 
include("includes/includes.php");

$id = $_GET["id"];

echo $id;
$qry_cliente = "select * from ds_tbl_cliente where Id_Cliente = {$id}";
$cliente = $obj->get_row($qry_cliente);

print_r($cliente);

$qry_result = "select sum(ds_tbl_venta.MontoTotalMXN) as total from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//echo $qry_result;
//exit;
$result = $obj->get_row($qry_result);


$qry_result_abonos = "select sum(ds_tbl_venta_abono.Monto_Abono) as total from ds_tbl_venta_abono left join ds_tbl_venta on ds_tbl_venta.Id_Venta = ds_tbl_venta_abono.Id_Venta where ds_tbl_venta.Id_Cliente = $id";
//echo $qry_result;
//exit;
$result_abono = $obj->get_row($qry_result_abonos);


$total_restante = $result->total - $result_abono->total;
?>
<table style="width:100%;">
		<tr>
			 <td>
			 	<b>Detalle de la venta</b><br />
			 	<span style="font-size:15px; "><?php echo $result->Fecha_Venta; ?></span>
			 	
				
			 </td>
			 <?php
			 
			
			 ?>
			 <td style="text-align:right;">Deuda restante<br /><b style="font-size:18px; padding-left:40px;">$ <?php echo number_format($total_restante, 2); ?> MXN</b></td>
		</tr>
	</table>
	<?php 
	
	$qry_ventas = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
	//echo $qry_result;
	//exit;
	$ventas = $obj->get_results($qry_ventas);
	
	?>
	<?php foreach($ventas as $venta): ?>
	<hr />
	<div>
		<div>
			Monto Total: <?php echo $venta->MontoTotalMXN; ?>
		</div>
		<div>
			Fecha de Venta: <?php echo $venta->Fecha_Venta; ?>
		</div>
		<?php //print_r($venta);
		$id_venta = $venta->Id_Venta;
		
		$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_venta_detalle.Id_Venta = $id_venta";
		//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
		
		$productos = $obj->get_results($qry_productos);
		
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
        			
    				<td class="text-center">
    					<div class="list-icons">
    						<div class="dropdown">
    							<a href="#" class="list-icons-item" data-toggle="dropdown">
    								<i class="icon-menu9"></i>
    							</a>
    
    							<div class="dropdown-menu dropdown-menu-right">
    								<?php /**
    								<a href="#" class="dropdown-item" onclick="realizar_pago(<?php echo $id_venta; ?>);"><!-- <i class="icon-bin"></i>--> Pagar</a>
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
		
		
		
		
		
		<?php 
					
		$qry_abono_res = "select * from ds_tbl_venta_abono where ds_tbl_venta_abono.Id_Venta = $id_venta";
		//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
		//echo $qry_abono_res . "<br />";
		$abono_res = $obj->get_results($qry_abono_res);
		
		
		//print_r($abono_res);
		?>
		<table class="table datatable-basic">
			<thead>
				<tr>
    				<th>Fecha</th>
    				<th>Monto</th>
    			</tr>
			</thead>
			<tbody>
				<?php foreach($abono_res as $abono): ?>
				<?php $id_abono = $abono->Id_Venta_Abono; ?>
				
    			<tr id="element<?php echo $id_abono; ?>">
					<td><?php echo $abono->Fecha_Abono; ?></td>
					
        			<td>$<?php echo number_format($abono->Monto_Abono, 2); ?>MXN</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>	
		
		
	</div>
	
	
	<?php endforeach; ?>