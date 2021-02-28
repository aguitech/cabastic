<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_cat_marca where Id_Marca = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
?>

<div style="width:100%; padding:0 10%;" class="content_form_crear">
	<form id="form_crear" method="post" action="?" enctyipe="multipart/form-data">
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
		<input type="hidden" name="editar" value="<?php echo $resultado->Id_Marca; ?>" />
		<div>
			<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> marca</h3>
			
			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Marca</div>
             		<input type="text" placeholder="Marca" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>" />
			
                </div>
                <div class="form-group col-md-6">
                 	<div>Imagen Producto</div>
         			<input type="file" name="Logo" id="Logo" value="<?php echo $resultado->Logo; ?>" />
			
                </div>
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
	</form>
</div>