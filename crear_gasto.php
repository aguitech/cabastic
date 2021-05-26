<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    //ds_cat_tipo_sustancia
    //$qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $qry_id = "select * from ds_tbl_gasto where Id_Gasto = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
$fecha_val = date("m/d/Y");
?>
<?php //echo $qry_id; ?>

<div style="width:100%; padding:0 10%;" class="content_form_crear">
<form id="" method="post" action="?" enctype="multipart/form-data">
	<div class="card-header header-elements-inline">
    	<h5 class="card-title">&nbsp;</h5>
    	<div class="header-elements">
    		<div class="list-icons">
        		
        		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
        	</div>
    	</div>
    </div>

    <input type="hidden" name="editar" value="<?php echo $resultado->Id_Gasto; ?>" />
    <div>
    <h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> gasto</h3>

    
			<div class="form-row">
                <div class="form-group col-md-6">
                	
                 	<div class="subtitle_form">Tipo de gasto</div>
                 	<?php 
                 	$tipos_gastos = $obj->get_results("select * from ds_cat_tipo_gasto");
                 	?>
         			<select name="Id_Tipo_Gasto" id="Id_Tipo_Gasto" class="form-control">
         				<?php foreach($tipos_gastos as $tipos_gasto): ?>
         				<option value="<?php echo $tipos_gasto->Id_Tipo_Gasto; ?>"><?php echo $tipos_gasto->Tipo_Gasto; ?></option>
         				<?php endforeach; ?>
         			</select>
         			
                </div>
                <div class="form-group col-md-6">
                 	<div class="subtitle_form">Monto</div>
                 	<input type="text" placeholder="Monto" name="Monto" id="Monto" value="<?php echo $resultado->Monto; ?>" class="form-control" />

                 	
                </div>
            </div>
            <div class="form-row">
            	
            	<div class="form-group col-md-6">
                
             		<div class="subtitle_form">Comprobante</div>
    				<input type="file" placeholder="Comprobante" name="Comprobante" id="Comprobante" value="<?php echo $resultado->Comprobante; ?>"  class="form-control" />
            	</div>
            	<?php if($_SESSION["rol"] == 1): ?>
            	<?php if($_POST["id"] != ""): ?>
            	<div class="form-group col-md-6">
                	
                 	<div class="subtitle_form">Estatus de pago</div>
                 	<select name="Estatus_Pago" id="Estatus_Pago" class="form-control">
         				<option value="0" <?php if($resultado->Estatus_Pago == 0): ?>selected="selected"<?php endif; ?>>Por pagar</option>
						<option value="1" <?php if($resultado->Estatus_Pago == 1): ?>selected="selected"<?php endif; ?>>Pagado</option>

         			</select>
         			
                </div>
                <?php endif; ?>
                <?php endif; ?>
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
 