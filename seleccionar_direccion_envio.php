<?php include("includes/includes.php"); ?>
<?php 
$id = $_POST["id"];
$qry_cp = "select * from ds_tbl_cliente_domicilio_entrega where Id_Cliente_Domicilio_Entrega = $id";

//echo $qry_cp;

$direccion = $obj->get_row($qry_cp);

//print_r($direccion);

echo json_encode($direccion);
?>