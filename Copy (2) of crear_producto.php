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
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Tipo de producto</div>
					<input type="text" placeholder="" name="" id="" value="" class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Categoría producto</div>
					<input type="text" placeholder="" name="" id="" value="" class="form-control" />
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Talla</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Género</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />

                </div>
            </div>
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Tipo de mercado</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Color</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Cantidad mínima en almacen</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Cantidad máxima en almacen</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Precio de venta mxn</div>
					<input type="text" placeholder="" name="" id="" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Imagen</div>
					<input type="file" name="Imagen_Producto" id="Imagen_Producto" value="<?php echo $resultado->Imagen_Producto; ?>" />

                </div>
            </div>















<input type="text" placeholder="" name="" id="" value="" />




<input type="text" placeholder="" name="" id="" value="" />



<input type="text" placeholder="" name="" id="" value="" />





<input type="text" placeholder="" name="" id="" value="" />




<input type="text" placeholder="" name="" id="" value="" />
<?php /**










*/ ?>





<br />

</div>
<div>
<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>CREAR<?php endif; ?> <i class="material-icons right">send</i></button>
</div>
</form>
</div> 
