<?php
include("includes/includes.php");

$tipo_cambio_dolar_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");

$tipo_cambio_dolar = $tipo_cambio_dolar_val->Valor;

$tipo_cambio_euro_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 2");

$tipo_cambio_euro = $tipo_cambio_euro_val->Valor;
//<hr />
?>
<?php //print_r($_POST); ?>
<?php //print_r($_FILES); ?>
<?php //print_r($_REQUEST); ?>
<?php 
$prefix_fecha_thumb = "comprobante_" . date("YmdHis") . "_";
$destino = 'images/comprobantes';
copy($_FILES['file']['tmp_name'], $destino . '/' . $prefix_fecha_thumb . $_FILES['file']['name']);

$thumb_name = $prefix_fecha_thumb . $_FILES['file']['name'];

$metodo_pago = $_POST["metodo_pago"];
$monto_pago = $_POST["monto_pago"];
$id_venta = $_POST["id_venta"];
$divisa = $_POST["moneda_pago"];

if($divisa == 1){
    //DOLAR
    $monto = $_POST["monto_pago"] * $tipo_cambio_dolar;
    $monto_dolares = $_POST["monto_pago"];
    
    $monto_euros = $monto / $tipo_cambio_euro;
    $divisa_costo = "USD";
}
if($divisa == 2){
    //EURO
    $monto = $_POST["monto_pago"] * $tipo_cambio_euro;
    $monto_dolares = $monto / $tipo_cambio_dolar;
    
    $monto_euros = $_POST["monto_pago"];
    $divisa_costo = "EURO";
    
}
if($divisa == 3){
    //PESO
    $monto = $_POST["monto_pago"];
    $monto_dolares = $_POST["monto_pago"] / $tipo_cambio_dolar;
    $monto_euros = $_POST["monto_pago"] / $tipo_cambio_euro;
    
    $divisa_costo = "MXN";
    
}

//$qry_insert = "insert into XXX () values ('{$thumb_name}', '')";
//Id_Venta_Abono 	Monto_Abono 	Fecha_Abono 	Id_Venta 	Comprobante_Pago 	Id_Metodo_Pago 

//$qry_insert = "insert into ds_tbl_venta_abono (Comprobante_Pago, Monto_Abono, Id_Metodo_Pago, Id_Venta) values ('{$thumb_name}', $monto_pago, $metodo_pago, $id_venta)";
/*
 * 
Textos completos	Id_Venta_Abono	Monto_Abono	id_Moneda	Dolar	Valor_Tipo_Cambio_Dolar	Euro	Valor_Tipo_Cambio_Euro	Fecha_Abono	Id_Venta	Comprobante_Pago	Id_Metodo_Pago
	Editar Editar	Copiar Copiar	Borrar Borrar	1 	
*/
$qry_insert = "insert into ds_tbl_venta_abono (Comprobante_Pago, Monto_Abono, Id_Moneda, Dolar, Euro, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Euro, Id_Metodo_Pago, Id_Venta) values ('{$thumb_name}', $monto, $divisa, $monto_dolares, $monto_euros, $tipo_cambio_dolar, $tipo_cambio_euro, $metodo_pago, $id_venta)";
//echo "<hr />";
//echo $qry_insert; 
$obj->query($qry_insert);

$qry_venta_actual = "select * from ds_tbl_venta where Id_Venta = {$id_venta}";
$venta_actual = $obj->get_row($qry_venta_actual);
echo $venta_actual->Id_Cliente;
?>