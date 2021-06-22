<?php include("includes/includes.php"); ?>
<?php /**
<div>
ABC
<?php print_r($_POST); ?>
</div>
Monto 	Terminacion_Tarjerta 	Referenci 	Id_Venta 	Id_Moneda

<h1>RESULTADO</h1>
*/ ?>
<?php //print_r($_POST); ?>
<?php 
$id_venta_val = $_POST["id_venta_val"];

$tipo_metodo_pago_val = $_POST["tipo_metodo_pago"];

//echo $id_venta_val;


$monedas = $obj->get_results("select * from ds_cat_moneda");


?>
<?php 
$qry_detalle_venta = "select * from ds_tbl_venta where Id_Venta = $id_venta_val";


//echo $qry_detalle_venta;
//$qry_pagos_realizados = "select * from ds_tbl_venta_metodo_pago where Id_Venta = $id_venta_val";
$qry_pagos_realizados = "select * from ds_tbl_venta_metodo_pago left join ds_cat_metodo_pago on ds_cat_metodo_pago.Id_Forma_Pago = ds_tbl_venta_metodo_pago.Id_Metodo_Pago where ds_tbl_venta_metodo_pago.Id_Venta = $id_venta_val";

//echo $qry_pagos_realizados;
$pagos_realizados = $obj->get_results($qry_pagos_realizados);
?>
<?php 
$monto_acumulado = 0;
?>
<?php /**
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
*/ ?>
<?php if($pagos_realizados == Array()): ?>
<h2 style="margin-left:40px;">Sin pagos realizados</h2>
<?php else: ?>
<table class="table datatable-basic">
<tr>
	<th>Monto</th>
	<th>M&eacute;todo de pago</th>
	<th>Moneda</th>
	<th>Terminaci&oacute;n tarjeta</th>
	<th>Referencia</th>
</tr>
<?php foreach($pagos_realizados as $resultado): ?>
<tr>
	<?php //print_r($resultado); ?>
	<?php 
	$id_resultado = $resultado->Id_Venta_Metodo;
	$monto_val = $resultado->Monto;
	
	$id_moneda = $resultado->Id_Moneda;
	
	$monto_acumulado += $resultado->Monto;
	?>
	<tr id="element<?php echo $id_resultado; ?>">
								
								<td>$<?php echo $resultado->Monto; ?>MXN</td>
								<td>
									<?php echo $resultado->Descripcion; ?>
	
    	
								</td>
								<td>
									<?php //print_r($resultado); ?>
									<?php //echo $pago_realizado->Id_Moneda;
							        if($resultado->Id_Moneda == 1){
                                	    echo "Pagado en moneda nacional";
                                	}
                                	if($resultado->Id_Moneda == 2){
                                	    echo "Pagado en d&oacute;lares";
                                	}
                                	
                                	?>
								</td>
								<td>
									<?php echo $resultado->Terminacion_Tarjerta; ?>
	
    	
								</td>
								<td>
									<?php echo $resultado->Referenci; ?>
								</td>
								
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="#" class="dropdown-item" onclick="eliminar_pago(<?php echo $id_resultado; ?>)>');"><i class="icon-bin"></i> Eliminar</a>
												<?php /**
												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												*/ ?>
											</div>
										</div>
									</div>
								</td>
							</tr>
	
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<?php 
$detalle_venta = $obj->get_row($qry_detalle_venta);

$tipo_cambio = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");
$tipo_cambio_dolar = $tipo_cambio->Valor;
?>

<div style="padding:25px;" id="resultado_pago">

    <div class="form-row">
    	<div class="form-group col-md-4">
    		<h2>Detalle de venta</h2>
    		<?php /*
    		Fecha de venta: <?php 
        			$date = new DateTime($detalle_venta->Fecha_Venta);
        			echo $date->format('d-m-Y');
        			//echo $detalle_venta->Fecha_Venta; 
        			?>
            <br />
            */ ?>
            Monto Total MXN: $<?php echo number_format($detalle_venta->MontoTotalMXN, 2); ?>
            <br />
            Monto Total USD: $<?php echo number_format($detalle_venta->MontoTotal, 2); ?>
    
        </div>
        <div class="form-group col-md-4">
    		<h2>Monto acumulado</h2>
    
            Monto Total MXN: $<?php $monto_acumlado_dolar = $monto_acumulado / $tipo_cambio_dolar; 
            echo number_format($monto_acumulado, 2);
            ?>
            <br />
            Monto Total USD: $<?php echo number_format(($monto_acumulado / $tipo_cambio_dolar), 2); ?>
            		
    	</div>
    	<div class="form-group col-md-4">
    		<h2>Monto restante</h2>
            Monto Restante MXN: $<?php $monto_restante_mxn = $detalle_venta->MontoTotalMXN - $monto_acumulado;
            echo number_format($monto_restante_mxn, 2);
            ?>
    		<br />
            Monto Restante USD: $<?php $monto_restante_usd = $detalle_venta->MontoTotal - $monto_acumlado_dolar;
            echo number_format($monto_restante_usd, 2);
            ?>
            
    		<input type="hidden" id="monto_restante_mxn" value="<?php echo $monto_restante_mxn; ?>" />
    		<input type="hidden" id="monto_restante_usd" value="<?php echo $monto_restante_usd; ?>" />
    		
    	</div>
    </div>



</div>

<?php //print_r($detalle_venta); ?>

<style>
.titulo_seccion_interior{
	font-size:26px;
}
.subtitulo_seccion_interior{
	font-size:22px;
}
</style>
<div style="padding:25px; margin-top:1px solid gray;">

	<input type="hidden" name="metodo_pago_seleccionado" id="metodo_pago_seleccionado" value="<?php echo $_POST["tipo_metodo_pago"]; ?>" />
    
    <?php if($_POST["tipo_metodo_pago"] == 1): ?>
    <div class="subtitulo_seccion_interior">Tarjeta</div>
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="number" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Terminaci&oacute;n Tarjerta</div>
    			<input type="number" placeholder="Terminaci&oacute;n Tarjerta" name="terminacion_tarjeta" id="terminacion_tarjeta" value="" class="form-control" />
    		</div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Referencia</div>
    			<input type="number" placeholder="Referencia" name="referencia" id="referencia" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <?php if($monto_acumulado < $detalle_venta->MontoTotalMXN): ?>
    
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
	<?php endif; ?>
    <?php endif; ?>
    <?php if($_POST["tipo_metodo_pago"] == 2): ?>
    <div class="subtitulo_seccion_interior">Efectivo</div>
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    
    
    <div>
    	<h4>Billetes</h4>
    	
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			1000
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_1000" id="billete_1000" value="0" class="form-control" onkeyup="calcular_billetes_mil(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_1000" id="resultado_billete_1000" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			500
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_500" id="billete_500" value="0" class="form-control" onkeyup="calcular_billetes_quinientos(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_500" id="resultado_billete_500" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			200
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_200" id="billete_200" value="0" class="form-control" onkeyup="calcular_billetes_doscientos(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_200" id="resultado_billete_200" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			100
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_100" id="billete_100" value="0" class="form-control" onkeyup="calcular_billetes_cien(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_100" id="resultado_billete_100" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			50
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_50" id="billete_50" value="0" class="form-control" onkeyup="calcular_billetes_cincuenta(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_50" id="resultado_billete_50" value="0" class="form-control" />
            	
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			20
            </div>
            <div class="form-group col-md-3">
    			<input type="text" placeholder="Billete" name="billete_20" id="billete_20" value="0" class="form-control" onkeyup="calcular_billetes_veinte(this.value)" />
            	
    		</div>
    		<div class="form-group col-md-3" id="">
    			<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billete_20" id="resultado_billete_20" value="0" class="form-control" />
            	
            </div>
    	</div>
    	
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			TOTAL
            </div>
            <div class="form-group col-md-3">
    			&nbsp;
    		</div>
    		<div class="form-group col-md-3">
    			<div id="">
    				<input type="text" readonly="readonly" placeholder="Billete" name="resultado_billetes" id="resultado_billetes" value="0" class="form-control" />
            	
    			</div>
            </div>
    	</div>
    	
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			RESTANTE
            </div>
            <div class="form-group col-md-3">
    			&nbsp;
    		</div>
    		<div class="form-group col-md-3">
    			<div id="">
    				<input type="text" readonly="readonly" placeholder="Restante" name="resultado_restante" id="resultado_restante" value="0" class="form-control" />
            	
    			</div>
            </div>
    	</div>
    	<div class="form-row">
    		<div class="form-group col-md-3">
    			CAMBIO
            </div>
            <div class="form-group col-md-3">
    			&nbsp;
    		</div>
    		<div class="form-group col-md-3">
    			<div id="">
    				<input type="text" readonly="readonly" placeholder="Cambio" name="resultado_cambio" id="resultado_cambio" value="0" class="form-control" />
            	
    			</div>
            </div>
    	</div>
    	
    	
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="number" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <?php if($monto_acumulado < $detalle_venta->MontoTotalMXN): ?>
    
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
	<?php endif; ?>
    <?php endif; ?>
    <?php if($_POST["tipo_metodo_pago"] == 3): ?>
    <div class="subtitulo_seccion_interior">Cortes&iacute;a</div>
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    <div>
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="number" placeholder="Monto" name="monto" id="monto" value="" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <?php if($monto_acumulado < $detalle_venta->MontoTotalMXN): ?>
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
    <?php endif; ?>
    <?php if($_POST["tipo_metodo_pago"] == 4): ?>
    <div class="subtitulo_seccion_interior">Cr&eacute;dito</div>
    <div>Atenci&oacute;n el resto de la compra ser&aacute; otorgado a cr&eacute;dito</div>
    
    <input type="hidden" placeholder="Id Venta" name="id_venta" id="id_venta" value="<?php echo $id_venta_val; ?>" class="form-control" />
    <div style="padding:20px;">
    	<div class="form-row">
    		<div class="form-group col-md-6">
    			<div>Monto</div>
    			<input type="number" placeholder="Monto" name="monto" id="monto" value="<?php echo $monto_restante_mxn; ?>" class="form-control" />
            
            </div>
            <div class="form-group col-md-6">
    			<div>Moneda</div>
    			<select  name="id_moneda" id="id_moneda" class="form-control">
    				<?php foreach($monedas as $moneda){ ?>
    				<option value="<?php echo $moneda->Id_Moneda; ?>"><?php echo $moneda->Descripcion; ?></option>
    				<?php } ?>
    			</select>
            </div>
    	</div>
    </div>
    <?php if($monto_acumulado < $detalle_venta->MontoTotalMXN): ?>
    
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
	<?php endif; ?>
    <?php endif; ?>
</div>
<div style="margin-top:50px; margin-bottom:50px;">
	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="window.location='venta_detalle.php?id=<?php echo $id_venta_val; ?>';" name="action">IR A DETALLE DE VENTA <i class="material-icons right">send</i></button>
</div>
<div id="ancla_metodo_pago"></div>



