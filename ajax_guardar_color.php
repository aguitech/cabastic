<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_color (Descripcion) values ('{$descripcion_val}')";
    $obj->query($qry_insert);
}


$colores = $obj->get_results("select * from ds_cat_color order by Descripcion asc");
?>
<?php foreach($colores as $color): ?>
<option value="<?php echo $color->Id_Color; ?>"><?php echo $color->Descripcion; ?></option>
<?php endforeach; ?>