<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    //ds_cat_tipo_sustancia
    //$qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $qry_id = "select * from ds_cat_tipo_sustancia where Id_Tipo_Sustancia = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
?>

<div style="width:100%; padding:0 10%;" class="content_form_crear">
<form id="" method="post" action="?">
<div onclick="cerrar_cargar()">
cerrar
</div>
<input type="hidden" name="editar" value="<?php echo $resultado->Id_Tipo_Sustancia; ?>" />
<div>
<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> sustancia</h3>
<?php /**
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />

<textarea name="nota" id="nota"><?php echo $resultado->nota; ?></textarea>


Id_Cliente	Nombre	Apellido_Paterno		CURP	Correo_Electronico	Telefono	Celular	Codigo_Cliente	Contrasena	Fecha_Alta	Fecha_Actualiza	Es_Comisionista	Activo

	Id_Cliente			Apellido_Materno		
*/ ?>

			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Sustancia</div>
         		<input type="text" placeholder="Sustancia" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div>Status</div>
         			<input type="text" placeholder="Status" name="Activo" id="Activo" value="<?php echo $resultado->Activo; ?>" class="form-control" />
                </div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Abreviatura</div>
    				<input type="text" placeholder="Abreviatura" name="Abreviatura" id="Abreviatura" value="<?php echo $resultado->Abreviatura; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Comentario</div>
    				<input type="text" placeholder="Comentario" name="Comentario" id="Comentario" value="<?php echo $resultado->Comentario; ?>"  class="form-control" />
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