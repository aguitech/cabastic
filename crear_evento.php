<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    //ds_cat_tipo_sustancia
    //$qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $qry_id = "select * from ds_tbl_evento where Id_Evento = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
?>
<?php //echo $qry_id; ?>

<div style="width:100%; padding:0 10%;" class="content_form_crear">
<form id="" method="post" action="?">
	<div class="card-header header-elements-inline">
    	<h5 class="card-title">&nbsp;</h5>
    	<div class="header-elements">
    		<div class="list-icons">
        		
        		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
        	</div>
    	</div>
    </div>

    <input type="hidden" name="editar" value="<?php echo $resultado->Id_Evento; ?>" />
    <div>
    <h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> evento</h3>

			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Nombre Evento</div>
         		<input type="text" placeholder="Nombre Evento" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div>Fecha de Inicio del evento</div>
                 	<input type="date" min="<?php echo date("Y-m-d"); ?>" placeholder="Fecha de Inicio del evento" name="Fecha_Inicio" id="Fecha_Inicio" value="<?php echo $resultado->Fecha_Inicio; ?>" class="form-control" />
                </div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                 	<div>Fecha de Cierre del evento</div>
                 	<input type="date" min="<?php echo date("Y-m-d"); ?>" placeholder="Fecha de Cierre del evento" name="Fecha_Cierre" id="Fecha_Cierre" value="<?php echo $resultado->Fecha_Cierre; ?>" class="form-control" />
                </div>
            	<div class="form-group col-md-6">
                
             		<div>Calle</div>
    				<input type="text" placeholder="Calle" name="Calle" id="Calle" value="<?php echo $resultado->Calle; ?>"  class="form-control" />
            	</div>
            	
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Colonia</div>
    				<input type="text" placeholder="Colonia" name="Colonia" id="Colonia" value="<?php echo $resultado->Colonia; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                	
             		<div>C&oacute;digo Postal</div>
             		<input type="text" placeholder="C&oacute;digo Postal" name="Id_Codigo_Postal" id="Id_Codigo_Postal" value="<?php echo $resultado->Id_Codigo_Postal; ?>"  class="form-control" />
            	</div>
            	
            </div>
            
            <div>
    			<div class="form-row">
                    <div class="form-group col-md-6">
                         &nbsp;
                    </div>
                    <div class="form-group col-md-6">
                     	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                    </div>
                </div>
    			
    		</div>

<?php /**










*/ ?>





<br />

</div>

</form>
</div> 