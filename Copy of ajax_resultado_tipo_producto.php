<?php 
include("includes/includes.php");

//print_r($_POST);
$id = $_POST["id"];
?>
<div>Tipo de producto</div>
<?php 
$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");
?>
<select onclick="filtrar_categoria();" name="tipo_producto" id="tipo_producto" class="form-control">
	<option value="" >Selecciona una categor&iacute;a</option>
	<?php foreach($tipos_producto as $tipo_producto): ?>
	<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
	<?php endforeach; ?>
</select>