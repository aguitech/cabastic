<?php include("includes/includes.php"); ?>
<?php 
$id_empleado = $_POST["id_empleado"];
$id_evento = $_POST["id_evento"];

$qry_empleado_evento_actual = "select * from ds_tbl_evento_empleado where Id_Envento = $id_evento and Id_Empleado = $id_empleado";
$empleado_evento_actual = $obj->get_row($qry_empleado_evento_actual);

$qry_last_id = "select * from ds_tbl_evento_empleado order by Contador desc limit 1";
$last_id = $obj->get_row($qry_last_id);
$last_id_value = $last_id->Contador + 1;

$fecha_hoy = date("Y-m-d H:i:s");

if($empleado_evento_actual->Contador != ""){
    //Quitarlo
    $qry_delete = "delete from ds_tbl_evento_empleado where Id_Envento = $id_evento and Id_Empleado = $id_empleado";
    $obj->query($qry_delete);
}else{
    //Asgianrlo
    //$qry_insert = "insert into ds_tbl_evento_empleado (Id_Envento, Id_Empleado) values ($id_evento, $id_empleado)";
    //$qry_insert = "insert into ds_tbl_evento_empleado (Id_Envento, Id_Empleado, Contador) values ($id_evento, $id_empleado, $last_id_value)";
    $qry_insert = "insert into ds_tbl_evento_empleado (Id_Envento, Id_Empleado, Contador, Fecha_Asignación) values ($id_evento, $id_empleado, $last_id_value, '{$fecha_hoy}')";
    
    
    $obj->query($qry_insert);
    
}
?>