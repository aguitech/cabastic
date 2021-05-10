<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_tipo_sustancia (Descripcion) values ('{$descripcion_val}')";
    $obj->query($qry_insert);
}


$sustancias = $obj->get_results("select * from ds_cat_tipo_sustancia order by Descripcion asc");

?>
<?php foreach($sustancias as $sustancia): ?>
<option value="<?php echo $sustancia->Id_Tipo_Sustancia; ?>" ><?php echo $sustancia->Descripcion; ?></option>
<?php endforeach; ?>