<?php
include("includes/includes.php");
$qry_metodos_pago = "select * from ds_cat_metodo_pago where Id_Forma_Pago != 4";
$metodos_pago = $obj->get_results($qry_metodos_pago);


//print_r($_POST);
$divisas = $obj->get_results("select * from ds_cat_tipo_cambio");

$id_venta = $_POST["venta"];

?>
<hr style="margin:60px 0 20px 0;" />
<form method="post" action="" id="form_pago" enctype="multipart/form-data" >
    <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $id_venta; ?>" />
    <div class="form-row">
    	<div class="form-group col-md-6">
         	<div>Monto</div>
    		<input type="text" placeholder="Monto" name="monto_pago" id="monto_pago" value="" class="form-control" />
    
        </div>
        <div class="form-group col-md-6">
         	<div>Divisa</div>
         	
    		<?php /*?>
    		<input type="text" placeholder="Monto" name="moneda_pago" id="moneda_pago" value="" class="form-control" />
    		*/ ?>
    		<select class="form-control" name="moneda_pago" id="moneda_pago">
         		<option value="">Selecciona una divisa</option>
         		<?php foreach($divisas as $divisa): ?>
         		<option value="<?php echo $divisa->Id_Tipo_Cambio; ?>"><?php echo $divisa->Descripcion; ?></option>
         		<?php endforeach; ?>
         	</select>
        </div>
        
        
    </div>
    <div class="form-row">
    	<div class="form-group col-md-6">
         	<div>M&eacute;todo de Pago</div>
         	<select class="form-control" name="metodo_pago" id="metodo_pago">
         		<option value="">Selecciona un m&eacute;todo de pago</option>
         		<?php foreach($metodos_pago as $metodo_pago): ?>
         		<option value="<?php echo $metodo_pago->Id_Forma_Pago; ?>"><?php echo $metodo_pago->Descripcion; ?></option>
         		<?php endforeach; ?>
         	</select>
        </div>
        <div class="form-group col-md-6">
         	<div>Comprobante de pago</div>
    		<input type="file" placeholder="Comprobante de pago" name="comprobante_pago" id="comprobante_pago" value="" class="form-control" />
    
        </div>
    </div>
    <div class="form-row">
    	<div class="form-group col-md-6">
        	<div>
            	<button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-left rounded-round" onclick="guardar_pago()"><b><i class="icon-reading"></i></b> Realizar pago</button>
            </div>
     	</div>
    </div>
</form>
