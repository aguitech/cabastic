
<?php include("includes/includes.php"); ?>
<?php /**
<div>
ABC
<?php print_r($_POST); ?>
</div>
Monto 	Terminacion_Tarjerta 	Referenci 	Id_Venta 	Id_Moneda

<h1>RESULTADO</h1>
*/ ?>
<?php //print_r($_POST); ?>
<?php 
$id_venta_val = $_POST["id_venta_val"];

$tipo_metodo_pago_val = $_POST["tipo_metodo_pago"];

//echo $id_venta_val;


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

<div style="padding:25px;">

    <div class="form-row">
    	<div class="form-group col-md-4">
    		<h2>Detalle de venta</h2>
    		Fecha de venta: <?php echo $detalle_venta->Fecha_Venta; ?>
            <br />
            Monto Total MXN: <?php echo $detalle_venta->MontoTotalMXN; ?>
            <br />
            Monto Total USD: <?php echo $detalle_venta->MontoTotal; ?>
    
        </div>
        <div class="form-group col-md-4">
    		<h2>Monto acumulado</h2>
    
            Monto Total USD: <?php echo $monto_acumulado; ?>
            <br />
            Monto Total MXN: <?php echo $monto_acumlado_dolar = $monto_acumulado * $tipo_cambio_dolar; ?>
            		
    	</div>
    	<div class="form-group col-md-4">
    		<h2>Monto restante</h2>
            Monto Restante USD: <?php echo $monto_restante_usd = $detalle_venta->MontoTotal - $monto_acumlado_dolar; ?>
            <br />
            Monto Restante MXN: <?php echo $monto_restante_mxn = $detalle_venta->MontoTotalMXN - $monto_acumulado; ?>
    		
    		<input type="hidden" id="monto_restante_mxn" value="<?php echo $monto_restante_mxn; ?>" />
    		<input type="hidden" id="monto_restante_usd" value="<?php echo $monto_restante_usd; ?>" />
    		
    	</div>
    </div>

</div>

<?php //print_r($detalle_venta); ?>

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
    			<div>Terminaci&oacute;n Tarjerta</div>
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
    	<h4>Billetes</h4>
    	
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			1000
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_1000" id="billete_1000" value="0" class="form-control" onkeyup="calcular_billetes_mil(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_1000" id="resultado_billete_1000" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			500
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_500" id="billete_500" value="0" class="form-control" onkeyup="calcular_billetes_quinientos(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_500" id="resultado_billete_500" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			200
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_200" id="billete_200" value="0" class="form-control" onkeyup="calcular_billetes_doscientos(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_200" id="resultado_billete_200" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			100
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_100" id="billete_100" value="0" class="form-control" onkeyup="calcular_billetes_cien(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_100" id="resultado_billete_100" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			50
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_50" id="billete_50" value="0" class="form-control" onkeyup="calcular_billetes_cincuenta(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_50" id="resultado_billete_50" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			20
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_20" id="billete_20" value="0" class="form-control" onkeyup="calcular_billetes_veinte(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_20" id="resultado_billete_20" value="0" class="form-control" />
            	
            </div>
    	</div>
    	
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			TOTAL
            </div>
            <div class="form-group col-md-3">
    			&nbsp;
    		</div>
    		<div class="form-group col-md-3">
    			<div id="">
    				<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billetes" id="resultado_billetes" value="0" class="form-control" />
            	
    			</div>
            </div>
    	</div>
    	
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			RESTANTE
            </div>
            <div class="form-group col-md-3">
    			&nbsp;
    		</div>
    		<div class="form-group col-md-3">
    			<div id="">
    				<input type="text" readonly="readonly" placeholder="Restante" name="resultado_restante" id="resultado_restante" value="0" class="form-control" />
            	
    			</div>
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			CAMBIO
            </div>
            <div class="form-group col-md-3">
    			&nbsp;
    		</div>
    		<div class="form-group col-md-3">
    			<div id="">
    				<input type="text" readonly="readonly" placeholder="Cambio" name="resultado_cambio" id="resultado_cambio" value="0" class="form-control" />
            	
    			</div>
            </div>
    	</div>
    	
    	
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminaci&oacute;n Tarjerta</div>
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
    			<div>Terminaci&oacute;n Tarjerta</div>
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
    <div>Atenci&oacute;n el resto de la compra ser&aacute; otorgado a cr&eacute;dito</div>
    
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    <div style="padding:20px;">
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="<?php echo $monto_restante_mxn; ?>" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminaci&oacute;n Tarjerta</div>
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