<?php include("includes/includes.php"); ?>


<?php 
//$qry_genero = "select * from ds_cat_genero order by Descripcion asc";
$id_marca = $_POST["id_marca"];
$qry_genero = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_cat_genero on ds_cat_genero.Id_Genero = ds_tbl_producto_detalle.Id_Genero where ds_tbl_producto.Id_Marca = $id_marca group by ds_tbl_producto_detalle.Id_Genero order by ds_tbl_producto_detalle.Id_Genero asc";
$generos = $obj->get_results($qry_genero);
?>
<select name="id_genero" id="id_genero" class="form-control" onchange="filtrar_marca_genero(this.value);">
	<option value="">Selecciona un g&eacute;nero</option>
	<?php foreach ($generos as $genero): ?>
	<option value="<?php echo $genero->Id_Genero; ?>"><?php echo $genero->Descripcion; ?></option>
	<?php endforeach; ?>
</select>