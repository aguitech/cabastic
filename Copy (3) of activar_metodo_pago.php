<?php /**
<div>
	ABC
	<?php print_r($_POST); ?>
</div>
	Monto 	Terminacion_Tarjerta 	Referenci 	Id_Venta 	Id_Moneda 
	
*/ ?>
<div style="padding:25px; margin-top:1`x solid gray;">
    <?php if($_POST["tipo_metodo_pago"] == 1): ?>
    <div>Tarjeta</div>
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="Monto" id="Monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="Terminacion_Tarjerta" id="Terminacion_Tarjerta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referenci" name="Referenci" id="Referenci" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="Id_Venta" id="Id_Venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="Id_Moneda" id="Id_Moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
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
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="Terminacion_Tarjerta" id="Terminacion_Tarjerta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referenci" name="Referenci" id="Referenci" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="Id_Venta" id="Id_Venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="Id_Moneda" id="Id_Moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
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
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="Terminacion_Tarjerta" id="Terminacion_Tarjerta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referenci" name="Referenci" id="Referenci" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="Id_Venta" id="Id_Venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="Id_Moneda" id="Id_Moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
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
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="Terminacion_Tarjerta" id="Terminacion_Tarjerta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referenci" name="Referenci" id="Referenci" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="Id_Venta" id="Id_Venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="Id_Moneda" id="Id_Moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
    		</div>
    	</div>
    </div>
    <?php endif; ?>
</div>