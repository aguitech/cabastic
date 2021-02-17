<style>
.menu_seleccionado{
	background:orange;
}
</style>
<?php 
$url_actual = $_SERVER["SCRIPT_URL"];
?>
						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">PRINCIPAL</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="home.php" class="nav-link">
								<i class="icon-home4"></i>
								<span>
									Home <?php echo $url_actual; ?>
								</span>
							</a>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/marcas.php"): ?>menu_seleccionado<?php endif; ?>" ><i class="icon-copy"></i> <span>Cat&aacute;logos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item <?php if($url_actual == "/colores.php"): ?>menu_seleccionado<?php endif; ?>"><a href="colores.php" class="nav-link active">Colores</a></li>
								<li class="nav-item <?php if($url_actual == "/divisas.php"): ?>menu_seleccionado<?php endif; ?>"><a href="divisas.php" class="nav-link active">Divisas</a></li>
								<li class="nav-item <?php if($url_actual == "/marcas.php"): ?>menu_seleccionado<?php endif; ?>"><a href="marcas.php" class="nav-link active">Marcas</a></li>
								<li class="nav-item <?php if($url_actual == "/productos.php" || $url_actual == "/asignar_precio_venta.php" || $url_actual == "/asignar_costo_compra.php"): ?>menu_seleccionado<?php endif; ?>"><a onclick="$('#submenu_productos').show();" class="nav-link active">Productos</a></li>
								<div style="display:none;" id="submenu_productos">
									<li class="nav-item <?php if($url_actual == "/productos.php"): ?>menu_seleccionado<?php endif; ?>"><a href="productos.php" class="nav-link active"> &nbsp; &#9658; &nbsp; Listado</a></li>
									<li class="nav-item <?php if($url_actual == "/asignar_precio_venta.php"): ?>menu_seleccionado<?php endif; ?>"><a href="asignar_precio_venta.php" class="nav-link active"> &nbsp; &#9658; &nbsp; Asignar Precio Venta</a></li>
									<li class="nav-item <?php if($url_actual == "/asignar_costo_compra.php"): ?>menu_seleccionado<?php endif; ?>"><a href="asignar_costo_compra.php" class="nav-link active"> &nbsp; &#9658; &nbsp; Asignar Costo Compra</a></li>
								</div>
								<li class="nav-item <?php if($url_actual == "/sustancias.php"): ?>menu_seleccionado<?php endif; ?>"><a href="sustancias.php" class="nav-link active">Sustancia</a></li>
								<li class="nav-item <?php if($url_actual == "/tallas.php"): ?>menu_seleccionado<?php endif; ?>"><a href="tallas.php" class="nav-link active">Tallas</a></li>
								<li class="nav-item <?php if($url_actual == "/tipos_producto.php"): ?>menu_seleccionado<?php endif; ?>"><a href="tipos_producto.php" class="nav-link active">Tipo Producto</a></li>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link <?php if($url_actual == "/clientes.php"): ?>menu_seleccionado<?php endif; ?>"><i class="icon-copy"></i> <span>Clientes</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item <?php if($url_actual == "/alta_cliente.php"): ?>menu_seleccionado<?php endif; ?>"><a href="" class="nav-link active">Alta de cliente</a></li>
								<li class="nav-item <?php if($url_actual == "/baja_cliente.php"): ?>menu_seleccionado<?php endif; ?>"><a href="" class="nav-link active">Baja de cliente</a></li>
								<li class="nav-item <?php if($url_actual == "/clientes.php"): ?>menu_seleccionado<?php endif; ?>"><a href="clientes.php" class="nav-link active">Lista de clientes</a></li>
								
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Empleados</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Alta de empleado</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Baja de empleado</a></li>
								<li class="nav-item <?php if($url_actual == "/empleados.php"): ?>menu_seleccionado<?php endif; ?>"><a href="empleados.php" class="nav-link active">Lista de empleados</a></li>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Eventos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Crear Evento</a></li>
								<li class="nav-item <?php if($url_actual == "/eventos.php"): ?>menu_seleccionado<?php endif; ?>"><a href="eventos.php" class="nav-link active">Mostrar eventos</a></li>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Inventario</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Revisi&oacute;n detallada</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Revisi&oacute;n aleatoria</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Revisi&oacute;n General</a></li>
							</ul>
						</li>
						
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
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Pr&eacute;stamos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item <?php if($url_actual == "/prestamos.php"): ?>menu_seleccionado<?php endif; ?>"><a href="prestamos.php" class="nav-link active">Mostrar Pr&eacute;stamos</a></li>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Reportes</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
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
								<li class="nav-item <?php if($url_actual == "/reporte_metodo_pago.php"): ?>menu_seleccionado<?php endif; ?>"><a href="reporte_metodo_pago.php" class="nav-link active">M&eacute;todos de pago</a></li>
								<li class="nav-item <?php if($url_actual == "/reporte_tipo_productos.php"): ?>menu_seleccionado<?php endif; ?>"><a href="reporte_tipo_productos.php" class="nav-link active">Tipo de productos</a></li>
								<li class="nav-item <?php if($url_actual == "/reporte_tipo_productos_totales.php"): ?>menu_seleccionado<?php endif; ?>"><a href="reporte_tipo_productos_totales.php" class="nav-link active">Tipo de productos $ USD</a></li>
								<li class="nav-item <?php if($url_actual == "/reporte_maximos_minimos.php"): ?>menu_seleccionado<?php endif; ?>"><a href="reporte_maximos_minimos.php" class="nav-link active">M&aacute;ximos y m&iacute;nimos</a></li>
								<li class="nav-item <?php if($url_actual == "/reporte_ventas_marcas.php"): ?>menu_seleccionado<?php endif; ?>"><a href="reporte_ventas_marcas.php" class="nav-link active">Reporte Ventas Marcas</a></li>
								<li class="nav-item <?php if($url_actual == "/reporte_credito_cliente.php"): ?>menu_seleccionado<?php endif; ?>"><a href="reporte_credito_cliente.php" class="nav-link active">Reporte Cr&eacute;dito de Cliente</a></li>
								<?php /**
								<li class="nav-item"><a href="reporte_credito.php" class="nav-link active">Reporte Cr&eacute;dito de Cliente</a></li>
								*/ ?>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Ubicaciones</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Ubicaci&oacute;n de producto</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Eliminar ubicaci&oacute;n</a></li>
								<li class="nav-item <?php if($url_actual == "/alta_cliente.php"): ?>menu_seleccionado<?php endif; ?>"><a href="ubicaciones.php" class="nav-link active">Mostrar ubicaciones</a></li>
								
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Ventas</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item <?php if($url_actual == "/ventas.php"): ?>menu_seleccionado<?php endif; ?>"><a href="ventas.php" class="nav-link active">Mostrar ventas</a></li>
								<li class="nav-item <?php if($url_actual == "/entregas_pendientes.php"): ?>menu_seleccionado<?php endif; ?>"><a href="entregas_pendientes.php" class="nav-link active">Entregas pendientes</a></li>
								<li class="nav-item <?php if($url_actual == "/envios_entregados.php"): ?>menu_seleccionado<?php endif; ?>"><a href="envios_entregados.php" class="nav-link active">Env&iacute;os Entregados</a></li>
								<li class="nav-item <?php if($url_actual == "/ordenes_de_compra_historial.php"): ?>menu_seleccionado<?php endif; ?>"><a href="ordenes_de_compra_historial.php" class="nav-link active">Historial &oacute;rdenes de compra</a></li>
								<li class="nav-item <?php if($url_actual == "/iniciar_venta.php"): ?>menu_seleccionado<?php endif; ?>"><a href="iniciar_venta.php" class="nav-link active">Iniciar Venta</a></li>
								<li class="nav-item <?php if($url_actual == "/devolucion_ventas.php"): ?>menu_seleccionado<?php endif; ?>"><a href="devolucion_ventas.php" class="nav-link active">Devoluci&oacute;n Ventas</a></li>
							</ul>
						</li>
						<!-- /main -->