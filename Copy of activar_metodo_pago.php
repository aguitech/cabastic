<div>
	ABC
	<?php print_r($_POST); ?>
</div>
<?php if($_POST["tipo_metodo_pago"] == 1): ?>
<div>Tarjeta</div>
<div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<div>Monto</div>
			<input type="text" placeholder="Monto" name="Monto" id="Monto" value="" class="form-control" />
        
        </div>
        <div class="form-group col-md-6">
			<div>Apellido Paterno</div>
			<input type="text" placeholder="Apellido Paterno" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $resultado->Apellido_Paterno; ?>" class="form-control" />
		</div>
	</div>
</div>
<?php endif; ?>
<?php if($_POST["tipo_metodo_pago"] == 2): ?>
<div>Efectivo</div>
<div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<div>Monto</div>
			<input type="text" placeholder="Monto" name="Monto" id="Monto" value="" class="form-control" />
        
        </div>
        <div class="form-group col-md-6">
			<div>Apellido Paterno</div>
			<input type="text" placeholder="Apellido Paterno" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $resultado->Apellido_Paterno; ?>" class="form-control" />
		</div>
	</div>
</div>
<?php endif; ?>
<?php if($_POST["tipo_metodo_pago"] == 3): ?>
<div>Cortes&iacute;a</div>
<div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<div>Monto</div>
			<input type="text" placeholder="Monto" name="Monto" id="Monto" value="" class="form-control" />
        
        </div>
        <div class="form-group col-md-6">
			<div>Apellido Paterno</div>
			<input type="text" placeholder="Apellido Paterno" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $resultado->Apellido_Paterno; ?>" class="form-control" />
		</div>
	</div>
</div>
<?php endif; ?>
<?php if($_POST["tipo_metodo_pago"] == 4): ?>
<div>Cr&eacute;dito</div>
<div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<div>Monto</div>
			<input type="text" placeholder="Monto" name="Monto" id="Monto" value="" class="form-control" />
        
        </div>
        <div class="form-group col-md-6">
			<div>Apellido Paterno</div>
			<input type="text" placeholder="Apellido Paterno" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $resultado->Apellido_Paterno; ?>" class="form-control" />
		</div>
	</div>
</div>
<?php endif; ?>