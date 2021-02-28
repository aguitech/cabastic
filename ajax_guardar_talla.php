<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_talla (Descripcion) values ('{$descripcion_val}')";
    $obj->query($qry_insert);
}


$tallas = $obj->get_results("select * from ds_cat_talla order by Descripcion asc");

?>
<?php foreach($tallas as $talla): ?>
<option value="<?php echo $talla->Id_Talla; ?>"><?php echo $talla->Descripcion; ?></option>
<?php endforeach; ?>
