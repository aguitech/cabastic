<?php include("includes/includes.php"); ?>
<?php 
$id = $_POST["id"];
$qry_cp = "select * from sepomex where id_sepomex = $id";

//echo $qry_cp;

$direccion = $obj->get_row($qry_cp);

//print_r($direccion);

echo json_encode($direccion);
?>