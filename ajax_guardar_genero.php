<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_genero (Descripcion) values ('{$descripcion_val}')";
    $obj->query($qry_insert);
}


$generos = $obj->get_results("select * from ds_cat_genero order by Descripcion asc");

?>
<?php foreach($generos as $genero): ?>
<option value="<?php echo $genero->Id_Genero; ?>"><?php echo $genero->Descripcion; ?></option>
<?php endforeach; ?>