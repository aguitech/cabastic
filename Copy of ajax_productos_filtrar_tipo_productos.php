<?php 
include("includes/includes.php");
$id = $_POST["id"];
//$qry_categorias_producto = "select * from ds_cat_categoria_producto order by Descripcion asc";
$qry_categorias_producto = "select * from ds_cat_categoria_producto where Id_Tipo_Producto = $id order by Descripcion asc";
//echo $qry_categorias_producto;
$categorias_producto = $obj->get_results($qry_categorias_producto);

?>
<select name="id_categoria" id="id_categoria" class="form-control" onchange="filtrar_resultados_tabla()">
	<?php foreach($categorias_producto as $categoria_producto): ?>
	<option value="<?php echo $categoria_producto->Id_Categoria_Producto; ?>"><?php echo $categoria_producto->Descripcion; ?></option>
	<?php endforeach; ?>
</select>