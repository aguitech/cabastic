<?php include("includes/includes.php"); ?>
<?php /**
<div>
ABC
<?php print_r($_POST); ?>
</div>
Monto 	Terminacion_Tarjerta 	Referenci 	Id_Venta 	Id_Moneda

*/ ?>
<h1>RESULTADO</h1>
<?php print_r($_POST); ?>
<?php 
$id_venta_val = $_POST["id_venta_val"];

$tipo_metodo_pago_val = $_POST["tipo_metodo_pago"];

echo $id_venta_val;


$monedas = $obj->get_results("select * from ds_cat_moneda");


?>
<?php 
$qry_detalle_venta = "select * from ds_tbl_venta where Id_Venta = $id_venta_val";


//echo $qry_detalle_venta;
$qry_pagos_realizados = "select * from ds_tbl_venta_metodo_pago where Id_Venta = $id_venta_val";
$pagos_realizados = $obj->get_results($qry_pagos_realizados);
?>
<?php 
$monto_acumulado = 0;
?>
<?php foreach($pagos_realizados as $pago_realizado): ?>
<div>
	<?php print_r($pago_realizado); ?>
	<?php 
	
	$monto_val = $pago_realizado->Monto;
	
	$id_moneda = $pago_realizado->Id_Moneda;
	
	$monto_acumulado += $pago_realizado->Monto;
	?>
</div>
<?php endforeach; ?>

<?php 
$detalle_venta = $obj->get_row($qry_detalle_venta);

$tipo_cambio = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");
$tipo_cambio_dolar = $tipo_cambio->Valor;
?>

<?php //print_r($detalle_venta); ?>
Fecha de venta: <?php echo $detalle_venta->Fecha_Venta; ?>
<br />
Monto Total MXN: <?php echo $detalle_venta->MontoTotalMXN; ?>
<br />
Monto Total USD: <?php echo $detalle_venta->MontoTotal; ?>
<br />
<hr />

<h2>Monto acuulado</h2>

Monto Total USD: <?php echo $monto_acumulado; ?>
<br />
Monto Total MXN: <?php echo $monto_acumulado * $tipo_cambio_dolar; ?>
<br />



<style>
.titulo_seccion_interior{
	font-size:26px;
}
.subtitulo_seccion_interior{
	font-size:22px;
}
</style>
<div style="padding:25px; margin-top:1px solid gray;">

	<input type="hidden" name="metodo_pago_seleccionado" id="metodo_pago_seleccionado" value="<?php echo $_POST["tipo_metodo_pago"]; ?>" />
    
    <?php if($_POST["tipo_metodo_pago"] == 1): ?>
    <div class="subtitulo_seccion_interior">Tarjeta</div>
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referencia</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_tarjeta();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
            </div>
        </div>
		
	</div>
    <?php endif; ?>
    <?php if($_POST["tipo_metodo_pago"] == 2): ?>
    <div class="subtitulo_seccion_interior">Efectivo</div>
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referencia</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_efectivo();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
            </div>
        </div>
		
	</div>
    <?php endif; ?>
    <?php if($_POST["tipo_metodo_pago"] == 3): ?>
    <div class="subtitulo_seccion_interior">Cortes&iacute;a</div>
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referencia</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_cortesia();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
            </div>
        </div>
		
	</div>
    <?php endif; ?>
    <?php if($_POST["tipo_metodo_pago"] == 4): ?>
    <div class="subtitulo_seccion_interior">Cr&eacute;dito</div>
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referencia</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_credito();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
            </div>
        </div>
		
	</div>
    <?php endif; ?>
</div>
<div id="ancla_metodo_pago"></div>