<?php include("includes/includes.php"); ?>
<?php 

$id_divisa = $_POST["id_divisa"];
$valor_divisa = $_POST["valor_divisa"];

if($id_divisa != "" && $valor_divisa != ""){
    
    
    $qry_update = "update ds_cat_tipo_cambio set Valor = $valor_divisa where Id_Tipo_Cambio = $id_divisa";
    $obj->query($qry_update);
    
}

$qry_mostrar = "select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = $id_divisa";
$divisa = $obj->get_row($qry_mostrar);

//print_r($divisa);


?>
<div>Valor de divisa</div>
<b><?php echo $divisa->Valor; ?></b>