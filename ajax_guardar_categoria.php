<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
$tipo_producto_val = $_POST["tipo_producto"];


//tipo_producto_select

if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_categoria_producto (Descripcion, Id_Tipo_Producto) values ('{$descripcion_val}', $tipo_producto_val)";
    $obj->query($qry_insert);
}


$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");

?>
<option><?php print_r($_POST); ?></option>
<?php foreach($categorias_producto as $categoria_producto): ?>
<option value="<?php echo $categoria_producto->Id_Categoria_Producto; ?>"><?php echo $categoria_producto->Descripcion; ?></option>
<?php endforeach; ?>

