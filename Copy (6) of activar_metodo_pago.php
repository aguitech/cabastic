<?php /**
<div>
ABC
<?php print_r($_POST); ?>
</div>
Monto 	Terminacion_Tarjerta 	Referenci 	Id_Venta 	Id_Moneda

*/ ?>
<style>
.titulo_seccion_interior{
	font-size:26px;
}
.subtitulo_seccion_interior{
	font-size:22px;
}
</style>
<div style="padding:25px; margin-top:1px solid gray;">
	<input type="hidden" name="metodo_pago[]" id="metodo_pago[]" value="<?php echo $_POST["tipo_metodo_pago"]; ?>" />
    <?php if($_POST["tipo_metodo_pago"] == 1): ?>
    <div class="subtitulo_seccion_interior">Tarjeta</div>
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="id_venta" id="id_venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="id_moneda" id="id_moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
    		</div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_tarjeta();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
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
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="id_venta" id="id_venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="id_moneda" id="id_moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
    		</div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_efectivo();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
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
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="id_venta" id="id_venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="id_moneda" id="id_moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
    		</div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_cortesia();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
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
    			<input type="text" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminacion Tarjerta</div>
    			<input type="text" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referenci</div>
    			<input type="text" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Id_Venta</div>
    			<input type="text" placeholder="Id Venta" name="id_venta" id="id_venta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Id Moneda</div>
    			<input type="text" placeholder="Id Moneda" name="id_moneda" id="id_moneda" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			&nbsp;
    		</div>
    	</div>
    </div>
    <div>
		<div class="form-row">
            <div class="form-group col-md-6">
                 &nbsp;
            </div>
            <div class="form-group col-md-6">
             	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="guardar_pago_credito();" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
            </div>
        </div>
		
	</div>
    <?php endif; ?>
</div>
<div id="ancla_metodo_pago"></div>