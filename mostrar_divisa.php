<?php include("includes/includes.php"); ?>
<?php
$id_divisa = $_POST["id"];
$qry_mostrar = "select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = $id_divisa";
$divisa = $obj->get_row($qry_mostrar);

//print_r($divisa);


?>
<div>Valor de divisa</div>
<input type="text" name="nuevo_divisa" id="nuevo_divisa" value="<?php echo $divisa->Valor; ?>" class="form-control" />
<br /><br />
<!-- 
<input type="button" value="Guardar" onclick="actualizar_divisa();" />
-->
<button class="btn waves-effect waves-light bg_aguitech" id="btn_guardar_divisa" type="button" name="action" onclick="actualizar_divisa(); $(this).hide('slow');">Guardar <i class="material-icons right">send</i></button>
                            	