<?php include("includes/includes.php"); ?>
<?php 
$cp = $_POST["cp"];

$qry_cp = "select * from sepomex where codigo_postal like '%{$cp}%'";

//echo $qry_cp;

$direcciones = $obj->get_results($qry_cp);

//print_r($direcciones);
?>
<select class="form-control" onchange="seleccionar_codigo_postal_envio(this.value)" name="envio_colonia">
	<option value="">Selecciona</option>
	<?php foreach($direcciones as $direccion): ?>
	<option value="<?php echo $direccion->id_sepomex; ?>"><?php echo $direccion->colonia; ?></option>
	<?php endforeach; ?>
</select>