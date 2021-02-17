<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    //ds_cat_tipo_sustancia
    //$qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $qry_id = "select * from ds_cat_tipo_producto where Id_Tipo_Producto = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
?>

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
<input type="hidden" name="editar" value="<?php echo $resultado->Id_Tipo_Sustancia; ?>" />
<div>
	<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> tipo de producto</h3>

			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Tipo de producto</div>
         		<input type="text" placeholder="Tipo de producto" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<input type="hidden" placeholder="Status" name="Activo" id="Activo" value="1" class="form-control" />
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