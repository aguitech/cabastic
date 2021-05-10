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
<?php /**
<div>Valor de divisa</div>
<b><?php echo $divisa->Valor; ?></b>
*/ ?>
<div>Valor de divisa</div>
<input type="text" name="nuevo_divisa" id="nuevo_divisa" value="<?php echo $divisa->Valor; ?>" class="form-control" />
<br /><br />
<!-- 
<input type="button" value="Guardar" onclick="actualizar_divisa();" />

Bton guardar
<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="actualizar_divisa()">Guardar <i class="material-icons right">send</i></button>

-->
<?php /**
<input type="text" name="nuevo_divisa" id="nuevo_divisa" value="<?php echo $divisa->Valor; ?>" class="form-control" />
<br /><br />
<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="actualizar_divisa()">Guardar <i class="material-icons right">send</i></button>

*/ ?>
