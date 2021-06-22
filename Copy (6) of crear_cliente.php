<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_tbl_cliente where Id_Cliente = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
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
<input type="hidden" name="editar" value="<?php echo $resultado->Id_Cliente; ?>" />
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
                
             		<div>C&oacute;digo Cliente</div>
    				<input type="text" placeholder="Codigo_Cliente" name="Codigo_Cliente" id="Apellido_Materno" value="<?php echo $resultado->Codigo_Cliente; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Tel&eacute;fono</div>
    				<input type="text" placeholder="Telefono" name="Telefono" id="Telefono" value="<?php echo $resultado->Telefono; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Celular</div>
    				<input type="text" placeholder="Celular" name="Celular" id="Celular" value="<?php echo $resultado->Celular; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Limite de Cr&eacute;dito</div>
    				<input type="text" placeholder="Limite de Cr&eacute;dito" name="Limite_Credito" id="Limite_Credito" value="<?php echo $resultado->Limite_Credito; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Plazo de Cr&eacute;dito</div>
    				<input type="text" placeholder="Plazo de Cr&eacute;dito" name="Plazo_Credito" id="Plazo_Credito" value="<?php echo $resultado->Plazo_Credito; ?>"  class="form-control" />
            	</div>
            </div>
            
            <?php /**
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Contrasena</div>
    				<input type="password" placeholder="Contrasena" name="Contrasena" id="Contrasena" value="<?php echo $resultado->Contrasena; ?>"  class="form-control" />
            	</div>
            </div>
*/ ?>            
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Es Comisionista</div>
    				<select name="Es_Comisionista" id="Es_Comisionista" class="form-control">
    					<option value="1" <?php if($resultado->Es_Comisionista == 1): ?>selected="selected"<?php endif; ?>>Si</option>
    					<option value="0" <?php if($resultado->Es_Comisionista == 0): ?>selected="selected"<?php endif; ?>>No</option>
    				</select>
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Clasificaci&oacute;n</div>
             		<?php //print_r($resultado); ?>
    				<select  name="Activo" id="Activo" class="form-control">
    					<option value="1" <?php if($resultado->Activo == 1): ?>selected="selected"<?php endif; ?>>AA</option>
    					<option value="1" <?php if($resultado->Activo == 3): ?>selected="selected"<?php endif; ?>>AAA</option>
    					<option value="0" <?php if($resultado->Activo == 0): ?>selected="selected"<?php endif; ?>>Negativo</option>
    				</select>
            	</div>
            </div>
            <?php 
            $id_cliente = $resultado->Id_Cliente;
            $qry_datos_fiscales = "select * from ds_tbl_cliente_informacion_fiscal where Id_Cliente = $id_cliente";
            $datos_fiscales = $obj->get_row($qry_datos_fiscales);
            print_r($datos_fiscales);
            ?>
            <?php if($datos_fiscales->Id_Cliente_Informacion_Fiscal != ""): ?>
            
            <?php else: ?>
            
            <?php endif; ?>
            <input type="hidden" id="id_datos_fiscales" name="id_datos_fiscales" value="<?php echo $datos_fiscales->Id_Cliente_Informacion_Fiscal; ?>" />
            
            <div class="form-row">
            	<div class="form-group col-md-12">
                
             		Datos Fiscales
             		
             		<?php print_r($datos_fiscales); ?>
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Raz&oacute;n Social</div>
    				<input type="text" placeholder="Raz&oacute;n Social" name="razon_social" id="razon_social" value="<?php echo $datos_fiscales->Razon_Social; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>RFC</div>
    				<input type="text" placeholder="RFC" name="rfc" id="rfc" value="<?php echo $datos_fiscales->RFC; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Calle y N&uacute;mero</div>
    				<input type="text" placeholder="Calle y n&uacute;mero" name="calle_numero" id="calle_numero" value="<?php echo $datos_fiscales->Calle; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>C&oacute;digo Postal</div>
    				<input type="text" placeholder="C&oacute;digo Postal" name="codigo_postal" id="codigo_postal" value="<?php echo $datos_fiscales->Codigo_Postal; ?>"  class="form-control" onkeyup="codigo_postal_fiscal()" />
    				<div onclick="codigo_postal_fiscal()">Buscar</div>
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Colonia</div>
             		<div id="res_colonia_fiscal">
             			
             				
             			<?php 
             			$val_colonia = "";
             			$qry_sepomex = "select * from sepomex where ";
             			$sepomex = $obj->get_results($qry_sepomex);
             			?>
             			
             			<select name="colonia" id="colonia" >
             				<?php foreach($sepomex as $direccion): ?>
             				<option value="<?php echo $datos_fiscales->Colonia; ?>" <?php if($datos_fiscales->Colonia == $direccion->id_sepomex): ?>selected="selected"<?php endif; ?>><?php echo $datos_fiscales->Colonia; ?></option>
             				<?php endforeach; ?>
             			</select>
             			
             			
             			<?php /**
    					<input type="text" placeholder="Colonia" name="colonia" id="colonia" value="<?php echo $datos_fiscales->Colonia; ?>"  class="form-control" />
    					*/ ?>
    				</div>
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Delegaci&oacute;n o Municipio</div>
    				<input type="text" placeholder="Delegaci&oacute;n o Municipio" name="delegacion_municipio" id="delegacion_municipio" value="<?php echo $resultado->Delegacion_Municipio; ?>"  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Estado</div>
    				<input type="text" placeholder="Estado" name="estado" id="estado" value="<?php echo $datos_fiscales->Estado; ?>"  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		Direcci&oacute;n de env&iacute;o
            	</div>
            	<div class="form-group col-md-6">
                
            	</div>
            </div>
            <?php 
            $qry_datos_envio = "select * from ds_tbl_cliente_domicilio_entrega where Id_Cliente = $id_cliente";
            $datos_envios = $obj->get_results($qry_datos_envio);
            
            ?>
            <div class="form-row">
            	<div class="form-group col-md-12">
            		<table>
                	<?php foreach($datos_envios as $datos_envio): ?>
             		<tr>
             			<td>
             				<a onclick="obtener_direccion_envio(<?php echo $datos_envio->Id_Cliente_Domicilio_Entrega; ?>);">Editar</a>
             			</td>
             			<td>
             				<?php //print_r($datos_envio); ?><?php echo $datos_envio->Calle . " " . $datos_envio->Colonia; ?>
             			</td>
             		</tr>
             		<?php endforeach; ?>
             		</table>
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                	<input type="hidden" name="id_envio" id="id_envio" />
             		<div>Calle y N&uacute;mero</div>
    				<input type="text" placeholder="Calle y n&uacute;mero" name="envio_calle" id="envio_calle" value=""  class="form-control" />
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>C&oacute;digo Postal</div>
    				<input type="text" placeholder="C&oacute;digo Postal" name="envio_codigo_postal" id="envio_codigo_postal" value=""  class="form-control" onkeyup="codigo_postal_envio()" />
    				<div onclick="codigo_postal_fiscal()">Buscar</div>
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Colonia</div>
             		<div id="res_colonia_envio">
             	
    					<input type="text" placeholder="Colonia" name="envio_colonia" id="envio_colonia" value=""  class="form-control" />
    				</div>
            	</div>
            	<div class="form-group col-md-6">
                
             		<div>Delegaci&oacute;n o Municipio</div>
    				<input type="text" placeholder="Delegaci&oacute;n o Municipio" name="envio_delegacion_municipio" id="envio_delegacion_municipio" value=""  class="form-control" />
            	</div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-6">
                
             		<div>Estado</div>
    				<input type="text" placeholder="Estado" name="envio_estado" id="envio_estado" value=""  class="form-control" />
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