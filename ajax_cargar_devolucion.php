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
?>
<?php //print_r($entrega); ?>

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
    <table class="table datatable-basic">
    	<tr>
    		<th>Disponibles</th>
    		<th>Cantidad</th>
    		<th>Producto</th>
    		<th>Motivo devoluci&oacute;n</th>
    	</tr>
    	<tr>
    		<td>
    			<input type="hidden" name="id_entrega" id="id_entrega" value="<?php echo $entrega->Id_Entrega; ?>" />
    			<select name="devolucion_cantidad" id="devolucion_cantidad" class="form-control">
    				<?php for($i=0; $i<=$entrega->Cantidad; $i++): ?>
    				<option <?php if($i==$entrega->Cantidad): ?>selected="selected"<?php endif; ?>><?php echo $i; ?></option>
    				<?php endfor; ?>
    			</select>
    		</td>
    		<td><?php echo $entrega->Cantidad; ?></td>
    		<td><?php echo $entrega->Nombre; ?></td>
    		<td>

    			<select name="motivo_devolucion">
    			<?php foreach($motivos_devolucion as $motivo): ?>
    			<option value="<?php echo $motivo->idMotivoDevolucionVenta; ?>"><?php echo $motivo->motivoDevolucionVenta; ?></option>	
    			<?php endforeach; ?>
    			</select>
    		</td>
    		<td>
    			<select name="motivo_cancelacion">
    			<?php foreach($motivos_cancelacion as $motivo): ?>
    			<option value="<?php echo $motivo->idMotivoCancelacionVenta; ?>"><?php echo $motivo->motivoCancelacionVenta; ?></option>	
    			<?php endforeach; ?>
    			</select>
    		</td>
    	</tr>
    </table>
    <div class="form-row">
        <div class="form-group col-md-6">
             &nbsp;
        </div>
        <div class="form-group col-md-6">
         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>DEVOLVER<?php else: ?>DEVOLVER<?php endif; ?> <i class="material-icons right">send</i></button>
        </div>
    </div>
</form>