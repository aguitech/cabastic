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
						<?php /**
						
									Home Array
(
    [CONTEXT_DOCUMENT_ROOT] =&gt; /home2/cabastic/public_html
    [CONTEXT_PREFIX] =&gt; 
    [DOCUMENT_ROOT] =&gt; /home2/cabastic/public_html
    [GATEWAY_INTERFACE] =&gt; CGI/1.1
    [H2PUSH] =&gt; on
    [H2_PUSH] =&gt; on
    [H2_PUSHED] =&gt; 
    [H2_PUSHED_ON] =&gt; 
    [H2_STREAM_ID] =&gt; 15
    [H2_STREAM_TAG] =&gt; 229-15
    [HTTP2] =&gt; on
    [HTTPS] =&gt; on
    [HTTP_ACCEPT_ENCODING] =&gt; gzip, deflate, br
    [HTTP_ACCEPT_LANGUAGE] =&gt; es-MX,es;q=0.8,en-US;q=0.5,en;q=0.3
    [HTTP_COOKIE] =&gt; PHPSESSID=56d862ffb48ef1c5e063ecc0f02aee76
    [HTTP_HOST] =&gt; cabastic.info
    [HTTP_TE] =&gt; trailers
    [HTTP_UPGRADE_INSECURE_REQUESTS] =&gt; 1
    [HTTP_USER_AGENT] =&gt; Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:85.0) Gecko/20100101 Firefox/85.0
    [HTTP_X_HTTPS] =&gt; 1
    [PATH] =&gt; /bin:/usr/bin
    [PHP_INI_SCAN_DIR] =&gt; /opt/cpanel/ea-php73/root/etc:/opt/cpanel/ea-php73/root/etc/php.d:.
    [QUERY_STRING] =&gt; 
    [REDIRECT_STATUS] =&gt; 200
    [REMOTE_ADDR] =&gt; 190.123.42.129
    [REMOTE_PORT] =&gt; 13807
    [REQUEST_METHOD] =&gt; GET
    [REQUEST_SCHEME] =&gt; https
    [REQUEST_URI] =&gt; /marcas.php
    [SCRIPT_FILENAME] =&gt; /home2/cabastic/public_html/marcas.php
    [SCRIPT_NAME] =&gt; /marcas.php
    [SCRIPT_URI] =&gt; https://cabastic.info/marcas.php
    [SCRIPT_URL] =&gt; /marcas.php
    [SERVER_ADDR] =&gt; 192.185.122.7
    [SERVER_ADMIN] =&gt; webmaster@cabastic.info
    [SERVER_NAME] =&gt; cabastic.info
    [SERVER_PORT] =&gt; 443
    [SERVER_PROTOCOL] =&gt; HTTP/2.0
    [SERVER_SIGNATURE] =&gt; 
    [SERVER_SOFTWARE] =&gt; Apache
    [SSL_TLS_SNI] =&gt; cabastic.info
    [UNIQUE_ID] =&gt; YCig1J9Ddw80UpYJLMY-UwAA5Q4
    [PHP_SELF] =&gt; /marcas.php
    [REQUEST_TIME_FLOAT] =&gt; 1613275348.6053
    [REQUEST_TIME] =&gt; 1613275348
    [argv] =&gt; Array
        (
        )

    [argc] =&gt; 0
)

								
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Usuarios</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Usuarios</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Agregar Usuario</a></li>
								
							</ul>
						</li>


						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Notificaciones</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="notificaciones.php" class="nav-link active">Notificaciones</a></li>
								<li class="nav-item"><a href="notificaciones_agregar.php" class="nav-link active">Agregar Notificación</a></li>
								
							</ul>
						</li>
						*/ ?>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Cat&aacute;logos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="colores.php" class="nav-link active">Colores</a></li>
								<li class="nav-item"><a href="divisas.php" class="nav-link active">Divisas</a></li>
								<li class="nav-item <?php if($url_actual == "/marcas.php"): ?>menu_seleccionado<?php endif; ?>"><a href="marcas.php" class="nav-link active">Marcas</a></li>
								<li class="nav-item"><a onclick="$('#submenu_productos').show();" class="nav-link active">Productos</a></li>
								<div style="display:none;" id="submenu_productos">
									<li class="nav-item"><a href="productos.php" class="nav-link active"> &nbsp; &#9658; &nbsp; Listado</a></li>
									<li class="nav-item"><a href="asignar_precio_venta.php" class="nav-link active"> &nbsp; &#9658; &nbsp; Asignar Precio Venta</a></li>
									<li class="nav-item"><a href="asignar_costo_compra.php" class="nav-link active"> &nbsp; &#9658; &nbsp; Asignar Costo Compra</a></li>
								</div>
								<li class="nav-item"><a href="sustancias.php" class="nav-link active">Sustancia</a></li>
								<li class="nav-item"><a href="tallas.php" class="nav-link active">Tallas</a></li>
								<li class="nav-item"><a href="tipos_producto.php" class="nav-link active">Tipo Producto</a></li>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Clientes</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Alta de cliente</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Baja de cliente</a></li>
								<li class="nav-item"><a href="clientes.php" class="nav-link active">Lista de clientes</a></li>
								
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Empleados</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Alta de empleado</a></li>
								<li class="nav-item"><a href="" class="nav-link active">Baja de empleado</a></li>
								<li class="nav-item"><a href="empleados.php" class="nav-link active">Lista de empleados</a></li>
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Eventos</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="" class="nav-link active">Crear Evento</a></li>
								<li class="nav-item"><a href="eventos.php" class="nav-link active">Mostrar eventos</a></li>
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
								<li class="nav-item"><a href="prestamos.php" class="nav-link active">Mostrar Pr&eacute;stamos</a></li>
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
								<li class="nav-item"><a href="reporte_metodo_pago.php" class="nav-link active">M&eacute;todos de pago</a></li>
								<li class="nav-item"><a href="reporte_tipo_productos.php" class="nav-link active">Tipo de productos</a></li>
								<li class="nav-item"><a href="reporte_tipo_productos_totales.php" class="nav-link active">Tipo de productos $ USD</a></li>
								<li class="nav-item"><a href="reporte_maximos_minimos.php" class="nav-link active">M&aacute;ximos y m&iacute;nimos</a></li>
								<li class="nav-item"><a href="reporte_ventas_marcas.php" class="nav-link active">Reporte Ventas Marcas</a></li>
								<li class="nav-item"><a href="reporte_credito_cliente.php" class="nav-link active">Reporte Cr&eacute;dito de Cliente</a></li>
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
								<li class="nav-item"><a href="ubicaciones.php" class="nav-link active">Mostrar ubicaciones</a></li>
								
							</ul>
						</li>
						
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Ventas</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="ventas.php" class="nav-link active">Mostrar ventas</a></li>
								<li class="nav-item"><a href="entregas_pendientes.php" class="nav-link active">Entregas pendientes</a></li>
								<li class="nav-item"><a href="envios_entregados.php" class="nav-link active">Env&iacute;os Entregados</a></li>
								<li class="nav-item"><a href="ordenes_de_compra_historial.php" class="nav-link active">Historial &oacute;rdenes de compra</a></li>
								<li class="nav-item"><a href="iniciar_venta.php" class="nav-link active">Iniciar Venta</a></li>
								<li class="nav-item"><a href="devolucion_ventas.php" class="nav-link active">Devoluci&oacute;n Ventas</a></li>
							</ul>
						</li>
						<!-- /main -->