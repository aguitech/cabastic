<?php
include("includes/includes.php");
//print_r($_POST);
$id_venta_val = $_POST["id_venta_val"];

$tipo_metodo_pago_val = $_POST["tipo_metodo_pago"];

$qry_detalle_venta = "select * from ds_tbl_venta where Id_Venta = $id_venta_val";




$tipo_cambio_dolar_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");

$tipo_cambio_dolar = $tipo_cambio_dolar_val->Valor;

$tipo_cambio_euro_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 2");

$tipo_cambio_euro = $tipo_cambio_euro_val->Valor;
?>

<?php /**
<?php 
//echo $qry_detalle_venta;
$qry_pagos_realizados = "select * from ds_tbl_venta_metodo_pago where Id_Venta = $id_venta_val";
$pagos_realizados = $obj->get_results($qry_pagos_realizados);
?>
<?php foreach($pagos_realizados as $pago_realizado): ?>
<div>
	<?php print_r($pago_realizado); ?>
</div>


<?php endforeach; ?>
*/ ?>








<?php 


//	Id_Venta_Metodo	Id_Metodo_Pago	Monto	Terminacion_Tarjerta	Referenci	Id_Venta	Id_Moneda
//monto_val=12345&terminacion_tarjeta_val=1234&referencia_val=1234&id_venta_val=1234&id_moneda_val=1234&id_metodo_pago=1

//Id_Venta_Metodo	Id_Metodo_Pago	Monto	Terminacion_Tarjerta	Referenci	Id_Venta	Id_Moneda

$last_id_venta_metodo_pago = $obj->get_row("select * from ds_tbl_venta_metodo_pago order by Id_Venta_Metodo desc limit 1");

$id_venta_metodo_pago = $last_id_venta_metodo_pago->Id_Venta_Metodo + 1;

$monto_val = $_POST["monto_val"];
$terminacion_tarjeta_val = 0;
$referencia_val = 0;
$id_venta_val = $_POST["id_venta_val"];
$id_moneda_val = $_POST["id_moneda_val"];
$id_metodo_pago = $_POST["id_metodo_pago"];

$qry_insert_pago = "insert into ds_tbl_venta_metodo_pago (Id_Venta_Metodo, Id_Metodo_Pago, Monto, Terminacion_Tarjerta, Referenci, Id_Venta, Id_Moneda) values ($id_venta_metodo_pago, $id_metodo_pago, $monto_val, $terminacion_tarjeta_val, $referencia_val, $id_venta_val, $id_moneda_val)";
$obj->query($qry_insert_pago);

?>





<?php 
$qry_pagos_realizados = "select * from ds_tbl_venta_metodo_pago where Id_Venta = $id_venta_val";
$pagos_realizados = $obj->get_results($qry_pagos_realizados);

$monto_acumulado = 0;
?>
<?php foreach($pagos_realizados as $pago_realizado): ?>
	<?php //print_r($pago_realizado); ?>
	<?php 
	
	$monto_val = $pago_realizado->Monto;
	
	$id_moneda = $pago_realizado->Id_Moneda;
	
	$monto_acumulado += $pago_realizado->Monto;
	?>
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






<?php /**

<?php 
$detalle_venta = $obj->get_row($qry_detalle_venta);
?>

<?php //print_r($detalle_venta); ?>
Fecha de venta: <?php echo $detalle_venta->Fecha_Venta; ?>
<br />
Monto Total MXN: <?php echo $detalle_venta->MontoTotalMXN; ?>
<br />
Monto Total USD: <?php echo $detalle_venta->MontoTotal; ?>
<br />
*/ ?>
<div class="form-row">
	<div class="form-group col-md-3">
    	Monto
	</div>
	<div class="form-group col-md-3">
    	Moneda
	</div>
	<div class="form-group col-md-3">
    	Terminaci&oacute;n Tarjeta
	</div>
	<div class="form-group col-md-3">
    	Referencia
	</div>
	
</div>
<?php foreach($pagos_realizados as $pago_realizado): ?>
<div class="form-row">
	<div class="form-group col-md-3">
    	<?php echo $pago_realizado->Monto; ?>
	</div>
	<div class="form-group col-md-3">
    	<?php //echo $pago_realizado->Id_Venta; ?>
    	<?php echo $pago_realizado->Id_Moneda; ?>
	</div>
	<div class="form-group col-md-3">
    	<?php echo $pago_realizado->Terminacion_Tarjerta; ?>
	</div>
	<div class="form-group col-md-3">
    	<?php echo $pago_realizado->Referenci; ?>
	</div>
	
</div>
<?php endforeach; ?>
