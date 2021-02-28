<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_marca (Descripcion) values ('{$descripcion_val}')";
    $obj->query($qry_insert);
}


$marcas = $obj->get_results("select * from ds_cat_marca order by Descripcion asc");

?>
<?php foreach($marcas as $marca): ?>
<option value="<?php echo $marca->Id_Marca; ?>" ><?php echo $marca->Descripcion; ?></option>
<?php endforeach; ?>