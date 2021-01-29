 <?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}

$marcas = $obj->get_results("select * from ds_cat_marca order by Descripcion asc");

//ds_cat_talla
$tallas = $obj->get_results("select * from ds_cat_talla order by Descripcion asc");

$colores = $obj->get_results("select * from ds_cat_color order by Descripcion asc");


$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");

$sustancias = $obj->get_results("select * from ds_cat_tipo_sustancia order by Descripcion asc");

$generos = $obj->get_results("select * from ds_cat_genero order by Descripcion asc");

//ds_cat_tipo_mercado
$tipos_mercado = $obj->get_results("select * from ds_cat_tipo_mercado order by Descripcion asc");

$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");

?>

<div style="width:100%; padding:0 10%;" class="content_form_crear">
<form id="" method="post" action="?">
<div onclick="cerrar_cargar()">
cerrar
</div>
<input type="hidden" name="editar" value="<?php echo $resultado->Id_Color; ?>" />
<div>
<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> producto</h3>
<?php /**
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />

<textarea name="nota" id="nota"><?php echo $resultado->nota; ?></textarea>
*/ ?>

			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>C&oacute;digo de barras del producto</div>
         		<input type="text" placeholder="C&oacute;digo de barras" name="codigo_barras" id="codigo_barras" value="" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div>Nombre del producto</div>
         			<input type="text" placeholder="Nombre del producto" name="nombre_producto" id="nombre_producto" value="" class="form-control" />
                </div>
            </div>
            <div>
         		<div>Descripción del producto</div>
				<input type="text" placeholder="Descripcion" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
            </div>
			<div class="form-row">
                <div class="form-group col-md-6">
                	<div>Sustancia del producto</div>
                	<select name="sustancia_producto" id="sustancia_producto" class="form-control">
               			<?php foreach($sustancias as $sustancia): ?>
               			<option value="<?php echo $sustancia->Id_Tipo_Sustancia; ?>" ><?php echo $sustancia->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="Sustancia" name="" id="sustancia_producto" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div>Marca del producto</div>
               		<select name="marca" id="marca" class="form-control">
               			<?php foreach($marcas as $marca): ?>
               			<option value="<?php echo $marca->Id_Marca; ?>" ><?php echo $marca->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
               		<br />
					<input type="text" placeholder="Marca" name="marca" id="marca" value=""  class="form-control" />
					*/ ?>
                </div>
            </div>
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Tipo de producto</div>
                	<select name="tipo_producto" id="tipo_producto" class="form-control">
               			<?php foreach($tipos_producto as $tipo_producto): ?>
               			<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
                	<?php /**
					<input type="text" placeholder="Tipo de producto" name="tipo_producto" id="tipo_producto" value="" class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div>Categoría producto</div>
               		<select name="categoria" id="categoria" class="form-control">
               			<?php foreach($categorias_producto as $categoria_producto): ?>
               			<option value="<?php echo $categoria_producto->Id_Categoria_Producto; ?>"><?php echo $categoria_producto->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
					<?php /**
					<input type="text" placeholder="Categor&iacute;a" name="categoria" id="categoria" value="" class="form-control" />
					*/ ?>
					
					
					
                </div>
                
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Talla</div>
               		<select name="talla" id="talla" class="form-control">
               			<?php foreach($tallas as $talla): ?>
               			<option value="<?php echo $talla->Id_Talla; ?>"><?php echo $talla->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="Talla" name="talla" id="talla" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div>Género</div>
               		
               		
               		
               		<select name="genero" id="genero" class="form-control">
               			<?php foreach($generos as $genero): ?>
               			<option value="<?php echo $genero->Id_Genero; ?>"><?php echo $genero->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="G&eacute;nero" name="genero" id="genero" value=""  class="form-control" />
					*/ ?>
                </div>
            </div>
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Tipo de mercado</div>
                	<select name="tipo_mercado" id="tipo_mercado" class="form-control">
               			<?php foreach($tipos_mercado as $tipo_mercado): ?>
               			<option value="<?php echo $tipo_mercado->Id_Tipo_Mercado; ?>" ><?php echo $tipo_mercado->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
                	<?php /**
					<input type="text" placeholder="Tipo de mercado" name="tipo_mercado" id="tipo_mercado" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div>Color</div>
               		<select name="color" id="color" class="form-control">
               			<?php foreach($colores as $color): ?>
               			<option value="<?php echo $color->Id_Color; ?>"><?php echo $talla->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
					<?php /**
					<input type="text" placeholder="Color" name="color" id="color" value=""  class="form-control" />
					*/ ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Cantidad mínima en almacen</div>
					<input type="text" placeholder="Cantidad m&iacute;nima en almacen" name="cantidad_minima" id="cantidad_minima" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Cantidad máxima en almacen</div>
					<input type="text" placeholder="Cantidad m&aacute;xima" name="cantidad_maxima" id="cantidad_maxima" value=""  class="form-control" />

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Precio de venta mxn</div>
					<input type="text" placeholder="Precio de venta MXN" name="precio_venta" id="precio_venta" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Imagen</div>
					<input type="file" name="Imagen_Producto" id="Imagen_Producto" value="<?php echo $resultado->Imagen_Producto; ?>" />

                </div>
            </div>
            <div>
            	<input type="submit" />
            </div>

<?php /**










*/ ?>





<br />

</div>
<div>
<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>CREAR<?php endif; ?> <i class="material-icons right">send</i></button>
</div>
</form>
</div> 