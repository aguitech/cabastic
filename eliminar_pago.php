<?php 
include("includes/includes.php");
print_r($_POST);
$id = $_POST["id"];
if($_POST["id"] != ""){
    $qry_delete = "delete from ds_tbl_venta_metodo_pago where Id_Venta_Metodo = $id";
    echo $qry_delete;
    $obj->query($qry_delete);
}
?>