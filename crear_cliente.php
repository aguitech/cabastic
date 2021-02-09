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
<?php /**
<div onclick="cerrar_cargar()">
cerrar
</div>
*/ ?>
<input type="hidden" name="editar" value="<?php echo $resultado->Id_Color; ?>" />
<div>
<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> cliente</h3>
<?php /**
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />

<textarea name="nota" id="nota"><?php echo $resultado->nota; ?></textarea>


Id_Cliente	Nombre	Apellido_Paterno		CURP	Correo_Electronico	Telefono	Celular	Codigo_Cliente	Contrasena	Fecha_Alta	Fecha_Actualiza	Es_Comisionista	Activo

	Id_Cliente			Apellido_Materno		
*/ ?>

			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Nombre</div>
         		<input type="text" placeholder="Nombre" name="Nombre" id="Nombre" value="<?php echo $resultado->Nombre; ?>" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div>Apellido Paterno</div>
         			<input type="text" placeholder="Apellido Paterno" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $resultado->Apellido_Paterno; ?>" class="form-control" />
                </div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Apellido Materno</div>
    				<input type="text" placeholder="Apellido Materno" name="Apellido_Materno" id="Apellido_Materno" value="<?php echo $resultado->Apellido_Materno; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>CURP</div>
    				<input type="text" placeholder="CURP" name="CURP" id="CURP" value="<?php echo $resultado->CURP; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Correo Electr&oacute;nico</div>
    				<input type="text" placeholder="Correo Electr&oacute;nico" name="Correo_Electronico" id="Correo_Electronico" value="<?php echo $resultado->Correo_Electronico; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>CURP</div>
    				<input type="text" placeholder="CURP" name="CURP" id="CURP" value="<?php echo $resultado->CURP; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Telefono</div>
    				<input type="text" placeholder="Telefono" name="Telefono" id="Telefono" value="<?php echo $resultado->Telefono; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Celular</div>
    				<input type="text" placeholder="Celular" name="Celular" id="Celular" value="<?php echo $resultado->Celular; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Codigo_Cliente</div>
    				<input type="text" placeholder="Codigo_Cliente" name="Codigo_Cliente" id="Apellido_Materno" value="<?php echo $resultado->Codigo_Cliente; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Contrasena</div>
    				<input type="text" placeholder="Contrasena" name="Contrasena" id="Contrasena" value="<?php echo $resultado->Contrasena; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Es_Comisionista</div>
    				<input type="text" placeholder="Es_Comisionista" name="Es_Comisionista" id="Es_Comisionista" value="<?php echo $resultado->Es_Comisionista; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Status</div>
    				<input type="text" placeholder="Activo" name="Activo" id="Activo" value="<?php echo $resultado->Activo; ?>"  class="form-control" />
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





</div>
<div>
<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>CREAR<?php endif; ?> <i class="material-icons right">send</i></button>
</div>






*/ ?>





<br />

</form>
</div> 