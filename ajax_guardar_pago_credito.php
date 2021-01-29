<?php 
include("includes/includes.php");

?>
<?php print_r($_POST); ?>
<hr />
<?php print_r($_FILES); ?>
<hr />
<?php print_r($_REQUEST); ?>
<?php 
$prefix_fecha_thumb = "comprobante_" . date("YmdHis") . "_";
$destino = 'images/comprobantes';
copy($_FILES['file']['tmp_name'], $destino . '/' . $prefix_fecha_thumb . $_FILES['file']['name']);

$thumb_name = $prefix_fecha_thumb . $_FILES['file']['name'];

$metodo_pago = $_POST["metodo_pago"];
$monto_pago = $_POST["monto_pago"];
$id_venta = $_POST["id_venta"];


//$qry_insert = "insert into XXX () values ('{$thumb_name}', '')";
//Id_Venta_Abono 	Monto_Abono 	Fecha_Abono 	Id_Venta 	Comprobante_Pago 	Id_Metodo_Pago 

$qry_insert = "insert into ds_tbl_venta_abono (Comprobante_Pago, Monto_Abono, Id_Metodo_Pago, Id_Venta) values ('{$thumb_name}', $monto_pago, $metodo_pago, $id_venta)";
echo "<hr />";
echo $qry_insert; 
$obj->query($qry_insert);

?>