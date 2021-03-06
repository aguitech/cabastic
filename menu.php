<style>
.menu_seleccionado{
	/*background:orange;*/
	/*background:#dcdcdc;*/
	/*
	background:#202B30;
	background:#2f383d;
	
    background:#404e54;
	
	* */
	/**
	background:orange;
	background:#F5F5F5;
	
	background:#2E3C43;
	
	* */
	background:#CDCDCD;
	
}
/**
.menu_seleccionado>a>span{
	color:white;
	
}
*/
.menu_seleccionado2{
	/*background:orange;*/
	/*background:#dcdcdc;*/
	/*
	background:#202B30;
	background:#2f383d;
	
    background:#404e54;
	
	* */
	background:orange;
	
}
.bg_aguitech{
	background:#324148;
	color:white;
}
.nav-item-open{
	
	/**
	background:#404e54;
	background:blue;
	*/
}
</style>
<?php 
$id_rol = $_SESSION["rol"];
$url_actual = $_SERVER["SCRIPT_URL"];
?>
						<!-- Main -->
						<!-- 
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">PRINCIPAL</div> <i class="icon-menu" title="Main"></i></li>
						-->
						<li class="nav-item <?php if($url_actual == "/home.php"): ?>menu_seleccionado<?php endif; ?>">
							<a href="home.php" class="nav-link">
								<i class="icon-home4"></i>
								<span>
									Home
								</span>
							</a>
						</li>
						<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/colores.php" || $url_actual == "/divisas.php" || $url_actual == "/marcas.php" || $url_actual == "/productos.php" || $url_actual == "/asignar_precio_venta.php" || $url_actual == "/asignar_costo_compra.php" || $url_actual == "/sustancias.php" || $url_actual == "/tallas.php" || $url_actual == "/tipos_producto.php"): ?>menu_seleccionado<?php endif; ?>" ><i class="icon-copy"></i> <span>Cat&aacute;logos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="colores.php" class="nav-link <?php if($url_actual == "/colores.php"): ?>active<?php endif; ?>">Colores</a></li>
								<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 4  || $id_rol == 5): ?>
								<li class="nav-item"><a href="divisas.php" class="nav-link  <?php if($url_actual == "/divisas.php"): ?>active<?php endif; ?>">Divisas</a></li>
								<?php endif; ?>
								<li class="nav-item"><a href="marcas.php" class="nav-link <?php if($url_actual == "/marcas.php"): ?>active<?php endif; ?>">Marcas</a></li>
								<li class="nav-item"><a onclick="$('#submenu_productos').show();" class="nav-link <?php if($url_actual == "/productos.php" || $url_actual == "/asignar_precio_venta.php" || $url_actual == "/asignar_costo_compra.php"): ?>active<?php endif; ?>">Productos</a></li>
								<div style="display:none;" id="submenu_productos">
									<li class="nav-item"><a href="productos.php" class="nav-link <?php if($url_actual == "/productos.php"): ?>active<?php endif; ?>"> &nbsp; &#9658; &nbsp; Listado</a></li>
									<li class="nav-item"><a href="asignar_precio_venta.php" class="nav-link <?php if($url_actual == "/asignar_precio_venta.php"): ?>active<?php endif; ?>"> &nbsp; &#9658; &nbsp; Asignar Precio Venta</a></li>
									<li class="nav-item"><a href="asignar_costo_compra.php" class="nav-link <?php if($url_actual == "/asignar_costo_compra.php"): ?>active<?php endif; ?>"> &nbsp; &#9658; &nbsp; Asignar Costo Compra</a></li>
								</div>
								<li class="nav-item"><a href="sustancias.php" class="nav-link <?php if($url_actual == "/sustancias.php"): ?>active<?php endif; ?>">Sustancia</a></li>
								<li class="nav-item"><a href="tallas.php" class="nav-link <?php if($url_actual == "/tallas.php"): ?>active<?php endif; ?>">Tallas</a></li>
								<li class="nav-item"><a href="tipos_producto.php" class="nav-link <?php if($url_actual == "/tipos_producto.php"): ?>active<?php endif; ?>">Tipo Producto</a></li>
							</ul>
						</li>
						<?php endif; ?>
						<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 5 || $id_rol == 6): ?>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/clientes.php"): ?>menu_seleccionado<?php endif; ?>"><i class="icon-users"></i> <span>Clientes</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<?php /**
								<li class="nav-item <?php if($url_actual == "/alta_cliente.php"): ?>menu_seleccionado<?php endif; ?>"><a href="" class="nav-link active">Alta de cliente</a></li>
								<li class="nav-item <?php if($url_actual == "/baja_cliente.php"): ?>menu_seleccionado<?php endif; ?>"><a href="" class="nav-link active">Baja de cliente</a></li>
								*/ ?>
								<li class="nav-item"><a href="clientes.php" class="nav-link <?php if($url_actual == "/clientes.php"): ?>active<?php endif; ?>">Lista de clientes</a></li>
								
							</ul>
						</li>
						<?php endif; ?>
						<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 5 || $id_rol == 6): ?>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/empleados.php"): ?>menu_seleccionado<?php endif; ?>"><i class="icon-user-tie"></i> <span>Empleados</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<?php /**
								<li class="nav-item"><a href="" class="nav-link active">Alta de empleado</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Baja de empleado</a></li>
								*/ ?>
								<li class="nav-item"><a href="empleados.php" class="nav-link <?php if($url_actual == "/empleados.php"): ?>active<?php endif; ?>">Lista de empleados</a></li>
							</ul>
						</li>
						<?php endif; ?>
						<?php if($$id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/eventos.php"): ?>menu_seleccionado<?php endif; ?>"><i class="icon-copy"></i> <span>Eventos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<?php /**
								<li class="nav-item"><a href="" class="nav-link active">Crear Evento</a></li>
								*/ ?>
								<li class="nav-item"><a href="eventos.php" class="nav-link <?php if($url_actual == "/eventos.php"): ?>active<?php endif; ?>">Mostrar eventos</a></li>
							</ul>
						</li>
						<?php endif; ?>
						<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-file-presentation"></i> <span>Inventario</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<!-- 
								<li class="nav-item"><a href="" class="nav-link active">Revisi&oacute;n detallada</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Revisi&oacute;n aleatoria</a></li>
								-->
								<li class="nav-item"><a href="productos.php" class="nav-link active">Productos</a></li>
							</ul>
						</li>
						<?php endif; ?>
						<?php if($id_rol == 1 || $id_rol == 4 || $id_rol == 5): ?>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-coin-dollar
							"></i> <span>Costos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<!-- 
								<li class="nav-item"><a href="" class="nav-link active">Revisi&oacute;n detallada</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Revisi&oacute;n aleatoria</a></li>
								-->
								<li class="nav-item"><a href="productos.php" class="nav-link active">Listado</a></li>
							</ul>
						</li>
						<?php endif; ?>
						
						<!-- 
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Movimientos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Entrada de producto</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Historial de entradas</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Salida de producto por merma</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Historial de salidas por merma</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Salida de producto a vendedor</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Historial salidas a vendedor</a></li>
							</ul>
						</li>
						-->
						<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 5 || $id_rol == 6): ?>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/prestamos.php"): ?>menu_seleccionado<?php endif; ?>"><i class="icon-truck"></i> <span>Pr&eacute;stamos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="prestamos.php" class="nav-link <?php if($url_actual == "/prestamos.php"): ?>active<?php endif; ?>">Mostrar Pr&eacute;stamos</a></li>
							</ul>
						</li>
						<?php endif; ?>
						<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 5 || $id_rol == 6): ?>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-stats-growth"></i> <span>Reportes</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<!-- 
								<li class="nav-item"><a href="reporte_inventario.php" class="nav-link active">Reporte de Inventario</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Reporte Global</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Productos mas vendidos</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Productos menos vendidos</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Resumen de Ventas</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Resumen de Ventas de pr&eacute;stamos Diarios</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Historial de ventas por evento</a></li>
								
								<li class="nav-item"><a href="" class="nav-link active">Historial de ventas clientes</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Reporte de cortes de caja</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Bit&aacute;cora de operaciones</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Asignaci&oacute;n de inventario evento</a></li>
								-->
								<li class="nav-item"><a href="reporte_metodo_pago.php" class="nav-link <?php if($url_actual == "/reporte_metodo_pago.php"): ?>active<?php endif; ?>">M&eacute;todos de pago</a></li>
								<li class="nav-item"><a href="reporte_tipo_productos.php" class="nav-link <?php if($url_actual == "/reporte_tipo_productos.php"): ?>active<?php endif; ?>">Tipo de productos</a></li>
								<li class="nav-item"><a href="reporte_tipo_productos_totales.php" class="nav-link <?php if($url_actual == "/reporte_tipo_productos_totales.php"): ?>active<?php endif; ?>">Tipo de productos $ USD</a></li>
								<li class="nav-item"><a href="reporte_maximos_minimos.php" class="nav-link <?php if($url_actual == "/reporte_maximos_minimos.php"): ?>active<?php endif; ?>">M&aacute;ximos y m&iacute;nimos</a></li>
								<li class="nav-item"><a href="reporte_ventas_marcas.php" class="nav-link <?php if($url_actual == "/reporte_ventas_marcas.php"): ?>active<?php endif; ?>">Reporte Ventas Marcas</a></li>
								<li class="nav-item"><a href="reporte_credito_cliente.php" class="nav-link <?php if($url_actual == "/reporte_credito_cliente.php"): ?>active<?php endif; ?>">Reporte Cr&eacute;dito de Cliente</a></li>
								<li class="nav-item"><a href="reporte_avanzado.php" class="nav-link <?php if($url_actual == "/reporte_avanzado.php"): ?>active<?php endif; ?>">Reporte Avanzado</a></li>
								<?php /**
								<li class="nav-item"><a href="reporte_credito.php" class="nav-link active">Reporte Cr&eacute;dito de Cliente</a></li>
								*/ ?>
							</ul>
						</li>
						<?php endif; ?>
						
						<?php /**
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Ubicaciones</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Ubicaci&oacute;n de producto</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Eliminar ubicaci&oacute;n</a></li>
								<li class="nav-item <?php if($url_actual == "/ubicaciones.php"): ?>menu_seleccionado<?php endif; ?>"><a href="ubicaciones.php" class="nav-link active">Mostrar ubicaciones</a></li>
								
							</ul>
						</li>
						*/ ?>
						<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/ventas.php" || $url_actual == "/entregas_pendientes.php" || $url_actual == "/envios_entregados.php" || $url_actual == "/ordenes_de_compra_historial.php" || $url_actual == "/iniciar_venta.php" || $url_actual == "/devolucion_ventas.php"): ?>menu_seleccionado<?php endif; ?>"><i class="icon-cart2"></i> <span>Ventas</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="ventas.php" class="nav-link <?php if($url_actual == "/ventas.php"): ?>active<?php endif; ?>">Mostrar ventas</a></li>
								<li class="nav-item"><a href="entregas_pendientes.php" class="nav-link <?php if($url_actual == "/entregas_pendientes.php"): ?>active<?php endif; ?>">Entregas pendientes</a></li>
								<li class="nav-item"><a href="envios_entregados.php" class="nav-link <?php if($url_actual == "/envios_entregados.php"): ?>active<?php endif; ?>">Env&iacute;os Entregados</a></li>
								<li class="nav-item"><a href="ordenes_de_compra_historial.php" class="nav-link <?php if($url_actual == "/ordenes_de_compra_historial.php"): ?>active<?php endif; ?>">Historial &oacute;rdenes de compra</a></li>
								<li class="nav-item"><a href="iniciar_venta.php" class="nav-link <?php if($url_actual == "/iniciar_venta.php"): ?>active<?php endif; ?>">Iniciar Venta</a></li>
								<li class="nav-item"><a href="devolucion_ventas.php" class="nav-link <?php if($url_actual == "/devolucion_ventas.php"): ?>active<?php endif; ?>">Devoluci&oacute;n Ventas</a></li>
							</ul>
						</li>
						<?php endif; ?>
						
						<!-- /main -->
						
						
						
						
<div style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:10; background:#324148;" id="capa_carga">
	<div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
		<img src="images/logo_cabastic.png" style="width:25%;" />
	</div>
</div>
<script>
	$(document).ready(function (){
		$("#capa_carga").fadeOut("slow");
	});
</script>				
						
<?php /**?>
<?php if($url_actual == "/colores.php"): ?>
<div style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:10; background:#324148;" id="capa_carga">
	<div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
		<img src="images/logo_cabastic.png" style="width:25%;" />
	</div>
</div>
<script>
	$(document).ready(function (){
		$("#capa_carga").fadeOut("slow");
	});
</script>
<?php endif; ?>
<?php if($url_actual == "/marcas.php"): ?>
<div style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:10; background:#324148;" id="capa_carga">
	<div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
		<img src="images/logo_cabastic.png" style="width:25%;" />
	</div>
</div>
<script>
	$(document).ready(function (){
		$("#capa_carga").slideUp("slow");
	});
</script>


<?php endif; ?>
*/ ?>
<style>
input[type=text]{
	border-radius:20px;
}
input[type=password]{
	border-radius:20px;
}
input[type=number]{
	border-radius:20px;
}
select{
	border-radius:10px !important;
}
select.form-control{
	border-radius:10px !important;
}

#container, #container_create{
    padding:20px;	
}
#container_create{
	display:none;
}
</style>