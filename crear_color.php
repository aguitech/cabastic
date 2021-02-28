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
	<form id="form_crear" method="post" action="?">
		<div class="card-header header-elements-inline">
        	<h5 class="card-title">&nbsp;</h5>
        	<div class="header-elements">
        		<div class="list-icons">
            		<!-- 
            		<a class="list-icons-item" data-action="collapse"></a>
            		<a class="list-icons-item" data-action="reload"></a>
            		-->
            		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
            	</div>
        	</div>
        </div>
		<input type="hidden" name="editar" value="<?php echo $resultado->Id_Color; ?>" />
		<div>
			<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> color</h3>
			<?php /**
			<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
			<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
			
			<textarea name="nota" id="nota"><?php echo $resultado->nota; ?></textarea>
			*/ ?>
			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Color</div>
             		<input type="text" placeholder="Color" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>" />
			
                </div>
                <div class="form-group col-md-6">
                 	<div>C&oacute;digo Hexadecimal</div>
         			<input type="text" placeholder="Codigo_Hexadecimal" name="Codigo_Hexadecimal" id="Codigo_Hexadecimal" value="<?php echo $resultado->Codigo_Hexadecimal; ?>" />
			
                </div>
            </div>
			<br />
			
		</div>
		<div>
			<div class="form-row">
                <div class="form-group col-md-6">
                     &nbsp;
                </div>
                <div class="form-group col-md-6">
                 	<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="validar_crear();"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                </div>
            </div>
			
		</div>
	</form>
</div>