<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_tipo_producto (Descripcion) values ('{$descripcion_val}')";
    $obj->query($qry_insert);
}


$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");

?>
<?php foreach($tipos_producto as $tipo_producto): ?>
<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
<?php endforeach; ?>

