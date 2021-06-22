<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    //ds_cat_tipo_sustancia
    //$qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $qry_id = "select * from ds_cat_tipo_gasto where Id_Tipo_Gasto = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
?>
<?php //echo $qry_id; ?>

<div style="width:100%;" class="content_form_crear">
<form id="form_crear" method="post" action="?">
	<div class="card-header header-elements-inline">
    	<h5 class="card-title">&nbsp;</h5>
    	<div class="header-elements">
    		<div class="list-icons">
        		
        		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
        	</div>
    	</div>
    </div>
<input type="hidden" name="editar" value="<?php echo $resultado->Id_Tipo_Gasto; ?>" />
<div>
<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> tipo de gasto</h3>
<?php /**
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />

<textarea name="nota" id="nota"><?php echo $resultado->nota; ?></textarea>


Id_Cliente	Nombre	Apellido_Paterno		CURP	Correo_Electronico	Telefono	Celular	Codigo_Cliente	Contrasena	Fecha_Alta	Fecha_Actualiza	Es_Comisionista	Activo

	Id_Cliente			Apellido_Materno		
*/ ?>

			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Tipo de gasto</div>
         		<input type="text" placeholder="Tipo de gasto" name="Tipo_Gasto" id="Tipo_Gasto" value="<?php echo $resultado->Tipo_Gasto; ?>" class="form-control" />
        
                </div>
            </div>
            <div>
    			<div class="form-row">
                    <div class="form-group col-md-6">
                         &nbsp;
                    </div>
                    <div class="form-group col-md-6">
                     	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="validar_crear()" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                    </div>
                </div>
    			
    		</div>

<?php /**










*/ ?>





<br />

</div>
</form>
</div> 