<?php include("includes/includes.php"); ?>
<?php //print_r($_POST); ?>
<?php 

$id = $_POST["id"];
//$qry_entrega = "select * from ds_tbl_entrega_venta_productos where Id_Entrega = $id";
//$qry_entrega = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_producto_detalle on ds_tbl_entrega_venta_productos.Id_Producto_detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_entrega_venta_productos.Id_Entrega = $id";
$qry_entrega = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_producto_detalle on ds_tbl_entrega_venta_productos.Id_Producto_detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_entrega_venta_productos.Id_Entrega = $id";
//echo $qry_entrega;
$entrega = $obj->get_row($qry_entrega);

$motivos_cancelacion = $obj->get_results("select * from ds_cat_motivo_cancelacion_venta");

$motivos_devolucion = $obj->get_results("select * from ds_cat_motivo_devolucion_venta");


$estatus_entrega_producto = $obj->get_results("select * from ds_cat_estatus_entrega_producto");

print_r($_POST);
?>
<hr />
<?php //print_r($entrega); ?>
<h2>Detalle de entrega</h2>
<div class="card-header header-elements-inline">
	<h5 class="card-title">&nbsp;</h5>
	<div class="header-elements">
		<div class="list-icons">
    		<!-- 
    		<a class="list-icons-item" data-action="collapse"></a>
    		<a class="list-icons-item" data-action="reload"></a>
    		-->
    		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
    	</div>
	</div>
</div>
<form method="post" action="">
    <div>
    			<input type="hidden" name="id_entrega" id="id_entrega" value="<?php echo $entrega->Id_Entrega; ?>" />
    			
	</div>
	<div>
    		<?php echo $entrega->Cantidad; ?>
	</div>
    		<div>
    		<?php echo $entrega->Nombre; ?>
    		</div>
    		<div>
				
				<select class="status_entrega" name="Id_Estatus_Entrega_Producto">
				<option value="0" <?php if(0 == $entrega->Id_Estatus_Entrega_Producto){ ?>selected="selected"<?php } ?>>Selecciona</option>
				<?php foreach($estatus_entrega_producto as $status_entrega){ ?>
					<option value="<?php echo $status_entrega->Id_Estatus_Entrega_Producto; ?>" <?php if($status_entrega->Id_Estatus_Entrega_Producto == $entrega->Id_Estatus_Entrega_Producto){ ?>selected="selected"<?php } ?>><?php echo $status_entrega->Descripcion; ?></option>
				<?php } ?>
				</select>
				
    		</div>
    		<div>
    			Num_Referencia_Envio
    			<input type="text" name="Num_Referencia_Envio" value="<?php echo $entrega->Num_Referencia_Envio; ?>" />
    		</div>
    		<div>
    			Nombre_Recibio
    			<input type="text" name="Nombre_Recibio" value="<?php echo $entrega->Nombre_Recibio; ?>" />
    		</div>
    		<div>
    			Paqueteria
    			<input type="text" name="Paqueteria" value="<?php echo $entrega->Paqueteria; ?>" />
    		</div>
    		<div>
    			Notas
    			<input type="text" name="Notas" value="<?php echo $entrega->Notas; ?>" />
    		</div>
    		
    		<?php  /**
    		<td>
    			<select name="motivo_devolucion">
    			<?php foreach($motivos_devolucion as $motivo): ?>
    			<option value="<?php echo $motivo->idMotivoDevolucionVenta; ?>"><?php echo $motivo->motivoDevolucionVenta; ?></option>	
    			<?php endforeach; ?>
    			</select>
    			
    			<select name="motivo_cancelacion">
    			<?php foreach($motivos_cancelacion as $motivo): ?>
    			<option value="<?php echo $motivo->idMotivoCancelacionVenta; ?>"><?php echo $motivo->motivoCancelacionVenta; ?></option>	
    			<?php endforeach; ?>
    			</select>
    		</td>
    		*/ ?>
    	
    <div class="form-row">
        <div class="form-group col-md-6">
             &nbsp;
        </div>
        <div class="form-group col-md-6">
         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>ACTUALIZAR<?php endif; ?> <i class="material-icons right">send</i></button>
        </div>
    </div>
</form>