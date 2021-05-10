<?php include("includes/includes.php");
include("common_files/sesion.php");
?>
<?php 
$total = 0;
$i = 0;
foreach($_SESSION["producto"] as $resultado){
    $total += $_SESSION["cantidad"][$i] * $_SESSION["precio"][$i];
    //echo $total . "<br />";
    $i++;
}
$importe_total = $total;
echo "$" . number_format($total, 2);

$tipo_cambio_dolar_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");

$tipo_cambio_dolar = $tipo_cambio_dolar_val->Valor;

$tipo_cambio = $_POST["tipo_cambio"];
$descuento = $_POST["descuento"];
$porcentaje = $_POST["porcentaje"];

if($tipo_cambio != ""){
    $tipo_cambio_dolar = $tipo_cambio;
}
if($descuento != ""){
    $importe_total = $importe_total - $descuento;
}
if($porcentaje != ""){
    //$descuento_porcentaje_val = ($importe_total * $porcentaje) / 100;
    $descuento_porcentaje_val = ($importe_total / 100) * $porcentaje;
    $importe_total = $importe_total - $descuento_porcentaje_val;
}
?>
<?php //print_r($_POST);?>
<div class="form-row">
    <div class="form-group col-md-3">
     	<span class="iniciar_venta_totales_titulos">Sub Total sin descuento</span>
     </div>
     <div class="form-group col-md-3">
		<b>$<?php echo number_format($total, 2); ?></b>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
     	<span class="iniciar_venta_totales_titulos">Descuento MXN:</span>
     </div>
     <div class="form-group col-md-3">
		<b>$<?php echo number_format($total - $importe_total, 2); ?></b>
		
    </div>
</div>
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
		<b class="resultado_iva_normal">$<?php echo number_format((($importe_total * 1.16) / $tipo_cambio_dolar) , 2); ?></b>
		<b class="resultado_excentar_iva" style="display:none;"><?php echo number_format((($importe_total * 1.0) / $tipo_cambio_dolar) , 2); ?></b>
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