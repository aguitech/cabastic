<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
?>
<link href="js/color-picker-master/color-picker.min.css" rel="stylesheet">

<script src="js/color-picker-master/color-picker.min.js"></script>
	<style>

    .color-picker.no-alpha .color-picker\:a {
      display: none;
    }

    </style>
	<script>

    function disableAlphaChannel(picker) {
        picker.self.classList.add('no-alpha');
        picker.on('change', function(r, g, b) {
            this.source.value = this.color(r, g, b, 1);
        });
    }

    const picker = new CP(document.querySelector('input'));

    disableAlphaChannel(picker);

    </script>
<div style="width:100%;" class="content_form_crear">
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
                 	<div class="subtitle_form">Tono</div>
             		<?php /**
             		<input type="text" placeholder="Color" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>" />
				*/ ?>
					<div class="form-group form-group-feedback form-group-feedback-left">
        				<input type="text" class="form-control" placeholder="Tono" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>">
        				<div class="form-control-feedback">
        					<i class="icon-droplets"></i>
        				</div>
        			</div>
                </div>
                <div class="form-group col-md-6">
                 	<div class="subtitle_form">C&oacute;digo Hexadecimal</div>
         			<?php /**
         			<input type="text" placeholder="Codigo_Hexadecimal" name="Codigo_Hexadecimal" id="Codigo_Hexadecimal" value="<?php echo $resultado->Codigo_Hexadecimal; ?>" />
			
					*/ ?>
					<div class="form-group form-group-feedback form-group-feedback-left">
        				<input type="text" class="form-control" placeholder="C&oacute;digo Hexadecimal" placeholder="Codigo_Hexadecimal" name="Codigo_Hexadecimal" id="Codigo_Hexadecimal" value="<?php echo $resultado->Codigo_Hexadecimal; ?>">
        				<div class="form-control-feedback">
        					<i class="icon-droplets"></i>
        				</div>
        			</div>
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