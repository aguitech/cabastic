<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_tbl_empleado where Id_Empleado = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
$roles_empleado = $obj->get_results("select * from ds_cat_empleado_rol");
?>

<div style="width:100%;" class="content_form_crear">
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
<input type="hidden" name="editar" value="<?php echo $resultado->Id_Empleado; ?>" />

<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> empleado</h3>
<?php /**
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
<input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />

<textarea name="nota" id="nota"><?php echo $resultado->nota; ?></textarea>


Id_Cliente	Nombre	Apellido_Paterno		CURP	Correo_Electronico	Telefono	Celular	Codigo_Cliente	Contrasena	Fecha_Alta	Fecha_Actualiza	Es_Comisionista	Activo

	Id_Cliente			Apellido_Materno		
*/ ?>

			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div class="subtitle_form">Nombre</div>
         		<input type="text" placeholder="Nombre" name="Nombre" id="Nombre" value="<?php echo $resultado->Nombre; ?>" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div class="subtitle_form">Apellido Paterno</div>
         			<input type="text" placeholder="Apellido Paterno" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $resultado->Apellido_Paterno; ?>" class="form-control" />
                </div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Apellido Materno</div>
    				<input type="text" placeholder="Apellido Materno" name="Apellido_Materno" id="Apellido_Materno" value="<?php echo $resultado->Apellido_Materno; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">CURP</div>
    				<input type="text" placeholder="CURP" name="CURP" id="CURP" value="<?php echo $resultado->CURP; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Correo Electr&oacute;nico</div>
    				<input type="text" placeholder="Correo Electr&oacute;nico" name="Correo_Electronico" id="Correo_Electronico" value="<?php echo $resultado->Correo_Electronico; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">C&oacute;digo del empleado</div>
    				<input type="text" placeholder="Ingresa el c&oacute;digo del empleado" name="Codigo_Empleado" id="Codigo_Empleado" value="<?php echo $resultado->Codigo_Empleado; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Telefono</div>
    				<input type="number" placeholder="Telefono" name="Telefono" id="Telefono" value="<?php echo $resultado->Telefono; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Celular</div>
    				<input type="number" placeholder="Celular" name="Celular" id="Celular" value="<?php echo $resultado->Celular; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Domicilio Particular</div>
    				<input type="text" placeholder="Domicilio Particular" name="Domicilio_Particular" id="Domicilio_Particular" value="<?php echo $resultado->Calle; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Colonia</div>
    				<input type="text" placeholder="Colonia" name="Colonia" id="Colonia" value="<?php echo $resultado->Colonia; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">C&oacute;digo Postal</div>
    				<input type="number" placeholder="C&oacute;digo Postal" name="Codigo_Postal" id="Codigo_Postal" value="<?php echo $resultado->Codigo_Postal; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Nombre Usuario</div>
    				<input type="text" placeholder="Nombre Usuario" name="Usuario" id="Usuario" value="<?php echo $resultado->Usuario; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Contrase&ntilde;a a utilizar</div>
    				<input type="password" placeholder="Contrase&ntilde;a a utilizar" name="Contrasena" id="Contrasena" value=""  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Rol de empleado</div>
             		<select name="Id_Empleado_Rol" id="Id_Empleado_Rol" class="form-control">
             			<?php foreach($roles_empleado as $rol): ?>
             			<option value="<?php echo $rol->Id_Empleado_Rol; ?>" <?php if($rol->Id_Empleado_Rol == $resultado->Id_Empleado_Rol): ?>selected="selected"<?php endif; ?>><?php echo $rol->Descripcion; ?></option>
             			<?php endforeach; ?>
             		
             		</select>
             		
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
					
             		<div class="subtitle_form">Estatus</div>
             		<select name="Activo" id="Activo" class="form-control">
             			<option value="1">Activo</option>
             			<option value="0">Inactivo</option>
             			
             		
             		</select>
            	</div>
            	<div class="form-group col-md-6">
                
             		
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