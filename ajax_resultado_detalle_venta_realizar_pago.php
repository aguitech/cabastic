<?php
include("includes/includes.php");
$qry_metodos_pago = "select * from ds_cat_metodo_pago";
$metodos_pago = $obj->get_results($qry_metodos_pago);


//print_r($_POST);

$id_venta = $_POST["venta"];

?>
<hr style="margin:60px 0 20px 0;" />
<form method="post" action="" id="form_pago" enctype="multipart/form-data" >
    <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $id_venta; ?>" />
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
         	<div>Monto</div>
    		<input type="text" placeholder="Monto" name="monto_pago" id="monto_pago" value="" class="form-control" />
    
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
         	<div>Comprobante de pago</div>
    		<input type="file" placeholder="Comprobante de pago" name="comprobante_pago" id="comprobante_pago" value="" class="form-control" />
    
        </div>
    </div>
    <div class="form-row">
    	<div class="form-group col-md-6">
        	<div>
            	<input type="button" onclick="guardar_pago()" value="Registrar pago" />
            </div>
     	</div>
    </div>
</form>
