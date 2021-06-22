 <?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
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
                 	<div>Código de barras del producto</div>
         		<input type="text" placeholder="" name="" id="" value="" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div>Nombre del producto</div>
         			<input type="text" placeholder="" name="" id="" value="" class="form-control" />
                </div>
            </div>
            <div>
         		<div>Descripción del producto</div>
				<input type="text" placeholder="Descripcion" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
            </div>
			<div class="form-row">
                <div class="form-group col-md-6">
                	<div>Sustancia del producto</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Marca del producto</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />

                </div>
            </div>







XTipo de producto
<input type="text" placeholder="" name="" id="" value="" />


Categoría producto
<input type="text" placeholder="" name="" id="" value="" />


Talla
<input type="text" placeholder="" name="" id="" value="" />

Género
<input type="text" placeholder="" name="" id="" value="" />



Tipo de mercado
<input type="text" placeholder="" name="" id="" value="" />



Color
<input type="text" placeholder="" name="" id="" value="" />


Cantidad mínima en almacen
<input type="text" placeholder="" name="" id="" value="" />




Cantidad máxima en almacen
<input type="text" placeholder="" name="" id="" value="" />



Precio de venta mnx
<input type="text" placeholder="" name="" id="" value="" />
<?php /**










*/ ?>





<br />
Imagen
<input type="file" name="Imagen_Producto" id="Codigo_Hexadecimal" value="<?php echo $resultado->Imagen_Producto; ?>" />

</div>
<div>
<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>CREAR<?php endif; ?> <i class="material-icons right">send</i></button>
</div>
</form>
</div> 
