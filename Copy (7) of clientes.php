<?php include("includes/includes.php"); ?>
<?php include("common_files/sesion.php"); ?>
<?php 
$nombre_seccion = "Clientes";
$tbl_main = "ds_tbl_cliente";
$nombre_simple = "cliente";
$url_name = "clientes.php";
$url_crear_name = "crear_cliente.php";
?>
<?php 

//print_r($_POST);
if($_GET["del"] != ""){
    $id_eliminar = $_GET["del"];
    
    //$qry_delete = "delete from $tbl_main where Id_Cliente = $id_eliminar";
    $qry_delete = "update $tbl_main set Activo = 2 where Id_Cliente = $id_eliminar";
    //echo $qry_delete;
    $obj->query($qry_delete);
    
    $header_url_location = 'Location: ./' . $url_name;
    
    header($header_url_location, true, 303);
    exit;
}

$fecha_hoy = date("Y-m-d H:i:s");
$nombre = $_POST["Nombre"];
$apellido_paterno = $_POST["Apellido_Paterno"];
$apellido_materno = $_POST["Apellido_Materno"];
$curp = $_POST["CURP"];
$correo_electronico = $_POST["Correo_Electronico"];
$telefono = $_POST["Telefono"];
//$contrasena = md5($_POST["Contrasena"]);
$contrasena = md5("hola");
$celular = $_POST["Celular"];
$codigo_cliente = $_POST["Codigo_Cliente"];
$es_comisionista = $_POST["Es_Comisionista"];
$activo = $_POST["Activo"];

print_r($_POST);
//print_r($_POST);
//exit();
//] => [razon_social] => [rfc] => [calle_numero] => [codigo_postal] => [colonia] => [delegacion_municipio] => [estado] => [envio_calle] => [envio_codigo_postal] => [envio_colonia] => [envio_delegacion_municipio] => [envio_estado] => [action] => ) 

$razon_social = $_POST["razon_social"];
$rfc = $_POST["rfc"];
$calle_numero = $_POST["calle_numero"];
$codigo_postal = $_POST["codigo_postal"];
$colonia = $_POST["colonia"];
$delegacion_municipio = $_POST["delegacion_municipio"];
$estado = $_POST["estado"];

$envio_calle = $_POST["envio_calle"];
$envio_codigo_postal = $_POST["envio_codigo_postal"];
$envio_colonia = $_POST["envio_colonia"];
$envio_delegacion_municipio = $_POST["envio_delegacion_municipio"];
$envio_estado = $_POST["envio_estado"];



//Id_Cliente_Domicilio_Entrega	Calle	Colonia	Id_Codigo_Postal	Id_Cliente	Predefinido	Contacto

//Id_Cliente_Informacion_Fiscal								Id_Empleado_Alta	


if($_POST["Nombre"] != ""){
    if($_POST["editar"] != ""){
        $id_editar = $_POST["editar"];
        //$qry_update = "update $tbl_main set Id_Cliente = '{}', Nombre = '{$nombre}', Apellido_Paterno = '{$apellido_paterno}', Apellido_Materno = '{$apellido_materno}', CURP = '{$curp}', Correo_Electronico = '{$correo_electronico}', Telefono = '{$telefono}', Celular = '{$celular}', Codigo_Cliente = '{$codigo_cliente}', Contrasena = '{$contrasena}', Fecha_Alta = '{$fecha_hoy}', Fecha_Actualiza = '{$fecha_hoy}', Es_Comisionista = '{$es_comisionista}', Activo = '{$activo}' where Id_Cliente = $id_editar";
        //$qry_update = "update $tbl_main set Nombre = '{$nombre}', Apellido_Paterno = '{$apellido_paterno}', Apellido_Materno = '{$apellido_materno}', CURP = '{$curp}', Correo_Electronico = '{$correo_electronico}', Telefono = '{$telefono}', Celular = '{$celular}', Codigo_Cliente = '{$codigo_cliente}', Contrasena = '{$contrasena}', Fecha_Alta = '{$fecha_hoy}', Fecha_Actualiza = '{$fecha_hoy}', Es_Comisionista = '{$es_comisionista}', Activo = '{$activo}' where Id_Cliente = $id_editar";
        $qry_update = "update $tbl_main set Nombre = '{$nombre}', Apellido_Paterno = '{$apellido_paterno}', Apellido_Materno = '{$apellido_materno}', CURP = '{$curp}', Correo_Electronico = '{$correo_electronico}', Telefono = '{$telefono}', Celular = '{$celular}', Codigo_Cliente = '{$codigo_cliente}', Contrasena = '{$contrasena}', Fecha_Alta = '{$fecha_hoy}', Fecha_Actualiza = '{$fecha_hoy}', Es_Comisionista = {$es_comisionista}, Activo = {$activo} where Id_Cliente = $id_editar";
        //echo $qry_update;
        $obj->query($qry_update);
        
        if($_POST["id_datos_fiscales"] != ""){
            $id_datos_fiscales = $_POST["id_datos_fiscales"];
            
            $qry_update_datos_fiscales = "update ds_tbl_cliente_informacion_fiscal set RFC = '{$rfc}', Razon_Social = '{$razon_social}', Calle = '{$calle_numero}', Colonia = '{$colonia}', Id_Codigo_Postal = '{$codigo_postal}', Fecha_Alta = '{$fecha_hoy}', Id_Cliente = {$id_editar}, Id_Empleado_Alta = '{1}', Activa = '{1}'";
            $obj->query($qry_update_datos_fiscales);
            
        }else{
            $qry_insert_datos_fiscales = "insert into ds_tbl_cliente_informacion_fiscal (RFC, Razon_Social, Calle, Colonia, Id_Codigo_Postal, Fecha_Alta, Id_Cliente, Id_Empleado_Alta, Activa) values ('{$rfc}', '{$razon_social}', '{$calle_numero}', '{$colonia}', '{$codigo_postal}', '{$fecha_hoy}', $id_editar, 1, 1)";
            $obj->query($qry_insert_datos_fiscales);
        }
        
        if($_POST["id_envio"] != ""){
            $id_envio = $_POST["id_envio"];
            $qry_insert_datos_envio = "update ds_tbl_cliente_domicilio_entrega set Calle = '{$envio_calle}', Colonia = '{$envio_colonia}', Id_Codigo_Postal = '{$envio_codigo_postal}', Id_Cliente = $id_editar, Predefinido = 1 where Id_Cliente_Domicilio_Entrega = $id_envio";
            $obj->query($qry_insert_datos_envio);
        }else{
            $qry_insert_datos_envio = "insert into ds_tbl_cliente_domicilio_entrega (Calle, Colonia, Id_Codigo_Postal, Id_Cliente, Predefinido) values ('{$envio_calle}', '{$envio_colonia}', '{$envio_codigo_postal}', $id_editar, 1)";
            $obj->query($qry_insert_datos_envio);
        }
        
    }else{
        //Textos completos	Id_Cliente	Nombre	Apellido_Paterno	Apellido_Materno	CURP	Correo_Electronico	Telefono	Celular	Codigo_Cliente	Contrasena	Fecha_Alta	Fecha_Actualiza	Es_Comisionista	Activo
        $last_cliente = $obj->get_row("select * from ds_tbl_cliente order by Id_Cliente desc limit 1");
        $next_id_cliente = $last_cliente->Id_Cliente + 1;
        
        $qry_insert = "insert into $tbl_main (Id_Cliente, Nombre, Apellido_Paterno, Apellido_Materno, CURP, Correo_Electronico, Telefono, Celular, Codigo_Cliente, Contrasena, Fecha_Alta, Fecha_Actualiza, Es_Comisionista, Activo) values ($next_id_cliente, '{$nombre}', '{$apellido_paterno}', '{$apellido_materno}', '{$curp}', '{$correo_electronico}', '{$telefono}', '{$celular}', '{$codigo_cliente}', '{$contrasena}', '{$fecha_hoy}', '{$fecha_hoy}', {$es_comisionista}, {$activo})";
        //echo $qry_insert;
        $obj->query($qry_insert);
        
        $qry_insert_datos_fiscales = "insert into ds_tbl_cliente_informacion_fiscal (RFC, Razon_Social, Calle, Colonia, Id_Codigo_Postal, Fecha_Alta, Id_Cliente, Id_Empleado_Alta, Activa) values ('{$rfc}', '{$razon_social}', '{$calle_numero}', '{$colonia}', '{$codigo_postal}', '{$fecha_hoy}', $next_id_cliente, 1, 1)";
        $obj->query($qry_insert_datos_fiscales);
    
        
        $qry_insert_datos_envio = "insert into ds_tbl_cliente_domicilio_entrega (Calle, Colonia, Id_Codigo_Postal, Id_Cliente, Predefinido) values ('{$envio_calle}', '{$envio_colonia}', '{$envio_codigo_postal}', $next_id_cliente, 1)";
        $obj->query($qry_insert_datos_envio);
    }
    header('Location: ./clientes.php', true, 303);
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php

	include "core_title.php";

	 ?>
	<script type="text/javascript">
	function codigo_postal_fiscal(){
		var cp = $("#codigo_postal").val();

		$.ajax({
			type: "POST",
			url:"obtener_codigo_postal.php",
			//data: { limit:val_limit, offset:val_offset },
			data: { cp:cp },
			success:function(data){
				console.log(data);
				$("#res_colonia_fiscal").html(data);

				//$("#container_create").html(data);
				//$(".select_refresh").formSelect();
			}
		});
		
	}
	function codigo_postal_envio(){
		var cp = $("#envio_codigo_postal").val();

		$.ajax({
			type: "POST",
			url:"obtener_codigo_postal_envio.php",
			//data: { limit:val_limit, offset:val_offset },
			data: { cp:cp },
			success:function(data){
				console.log(data);
				$("#res_colonia_envio").html(data);
				//$("#container_create").html(data);
				//$(".select_refresh").formSelect();
			}
		});
		
	}
	function seleccionar_codigo_postal_fiscal(id_cp){
		$.ajax({
			type: "POST",
			url:"seleccionar_codigo_postal.php",
			//data: { limit:val_limit, offset:val_offset },
			//dataType: 'jsonp',
			data: { id:id_cp },
			success:function(data){
				console.log(data);
				var data_inf = JSON.parse(data);
				$("#delegacion_municipio").val(data_inf.delegacion);

				$("#estado").val(data_inf.estado);
				
				//alert(data_inf.delegacion);
				//alert(data_inf.estado);
				//$("#container_create").html(data);
				//$(".select_refresh").formSelect();
			}
		});
	}
	function seleccionar_codigo_postal_envio(id_cp){
		$.ajax({
			type: "POST",
			url:"seleccionar_codigo_postal_envio.php",
			//data: { limit:val_limit, offset:val_offset },
			//dataType: 'jsonp',
			data: { id:id_cp },
			success:function(data){
				console.log(data);
				var data_inf = JSON.parse(data);
				$("#envio_delegacion_municipio").val(data_inf.delegacion);
				$("#envio_estado").val(data_inf.estado);

				//alert("Hola");
				//alert(data_inf.delegacion);
				//alert(data_inf.estado);
			}
		});
	}
	function obtener_direccion_envio(id){
		$.ajax({
			type: "POST",
			url:"seleccionar_direccion_envio.php",
			//data: { limit:val_limit, offset:val_offset },
			//dataType: 'jsonp',
			data: { id:id },
			success:function(data){
				console.log(data);
				var data_inf = JSON.parse(data);
				//$("#envio_delegacion_municipio").val(data_inf.delegacion);
				//$("#envio_estado").val(data_inf.estado);

				$("#envio_calle").val(data_inf.Calle);
				$("#envio_colonia").val(data_inf.Colonia);
				$("#envio_codigo_postal").val(data_inf.Id_Codigo_Postal);
				$("#envio_delegacion_municipio").val(data_inf.Calle);
				$("#envio_estado").val(data_inf.Calle);
				//alert("Hola");
				//alert(data_inf.delegacion);
				//alert(data_inf.estado);
			}
		});
	}
		$( document ).ready(function() {
    		console.log( "ready!" );
    		
		});

		function Eliminar(t_id,t_completo){
			//alert("Eliminar; "+t_id);

			var r = confirm("Estás seguro que deseas eliminar el cliente: "+t_completo);
			if (r == true) {

				var url_delete = "./clientes.php?del=" + t_id;
				window.location = url_delete;
				
			  txt = "You pressed OK!";
/**
			  	$.ajax({url: "usuarios_eliminar.php?id="+t_id, success: function(result){
    				//$("#div1").html(result);
    				//alert(result);
    				$("#element"+t_id).hide(500);
  				}});
  				*/

			} else {
			  txt = "You pressed Cancel!";
			}

		}

	</script>

</head>

<body>

	<script>
		function cargar_crear_history(){
			$("#container_create").show("");
			$("#container_create").html("");
			$("#container").hide("");
			var val_page = "";
			var val_categoria = "";

			$.ajax({
				type: "POST",
				url:"<?php echo $url_crear_name; ?>",
				//data: { limit:val_limit, offset:val_offset },
				data: { page:val_page, categoria:val_categoria },
				success:function(data){
					console.log(data);
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#container_create").html(data);
					$(".select_refresh").formSelect();
				}
			});

		   //window.history.pushState("object or string", "Title", "/create");
		   //window.history.pushState("object or string", "Title", "/panel/proyectos.php?create=new");
		   //window.history.pushState("object or string", "Title", "/panel/proyectos.php?func=new");
		   
		   
		}
		function cargar_crear(){
			//$("#container").html("");
			$("#container_create").show("");
			$("#container_create").html("");
			$("#container").hide("");
		   
			var val_page = "";
			var val_categoria = "";

			$.ajax({
				type: "POST",
				url:"<?php echo $url_crear_name; ?>",
				//data: { limit:val_limit, offset:val_offset },
				data: { page:val_page, categoria:val_categoria },
				success:function(data){
					console.log(data);
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					//$("#container").html(data);
					$("#container_create").html(data);
					
				}
			});

			window.history.pushState("object or string", "Title", "/<?php echo $url_name; ?>?func=new");
		   
		}
		function cargar_editar(id){
            $("#container_create").show("");
            $("#container_create").html("");
			$("#container").hide("");
		   
            //$("#container").html("");
            var val_page = "";
			var val_categoria = "";
		   
			$.ajax({
				type: "POST",
                url:"<?php echo $url_crear_name; ?>",
                //data: { limit:val_limit, offset:val_offset },
                data: { id:id },
                success:function(data){
                	console.log(data);
                	//$("#resultado_votos_detalle").html(data);
                	//$("#publicaciones_adicionales").html(data);
                	//$("#publicaciones_adicionales").append(data);
                	//$("#container").html(data);
                	$("#container_create").html(data);
                }
			});
		}
		function cerrar_cargar(){
            //window.history.pushState("object or string", "Title", "/panel/proyectos.php");
            window.history.pushState("proyectos", "Title", "/<?php echo $url_name; ?>");
            $('#container').show();
            $('#container_create').hide();
		}
        (function(history){
            var pushState = history.pushState;
            console.log("test");
			console.log(pushState);
			history.pushState = function(state) {
                console.log("state");
                console.log(state);
                if (typeof history.onpushstate == "function") {
                    history.onpushstate({state: state});
                    console.log("history");
                    console.log(history);
                }
                // whatever else you want to do
				// maybe call onhashchange e.handler
				return pushState.apply(history, arguments);
			}
        })(window.history);
		window.onpopstate = function (event) {

			console.log(window.location);
			console.log("www");
			console.log(window.location.href);
			console.log("www pathname");
			console.log(window.location.pathname);

			console.log("www search");
			console.log(window.location.search);

			
			
			if(window.location.search == "?func=new"){
				console.log("CREAR");
				/*
				$("#container_create").show("");
				$("#container").hide("");
				*/

				//cargar_crear();
				cargar_crear_history();
			}else{
				$("#container_create").hide("");
				$("#container").show("");
			}
			if(window.location.pathname == "/<?php echo $url_name; ?>"){
				console.log("PROY");
				//$("#container_create").hide("");
				//$("#container").show("");
				
			}
			if(window.location.pathname == "/<?php echo $url_name; ?>?func=new"){
				console.log("CREAR");
				/*
				$("#container_create").show("");
				$("#container").hide("");
				*/

				cargar_crear();
			}

			
			console.log("entro");
			if (event.state) {
				//history changed because of pushState/replaceState
                console.log("si");
				//ir al siguiente movimiento
			} else {
				//history changed because of a page load
                console.log("no");
                //$("#container_create").hide("");
				//ir hacia atras
			}
		}

		window.addEventListener('replaceState', function(e) {
			console.warn('THEY DID IT AGAIN!');
		});
		
		window.addEventListener('popstate', function(e) {
			console.log("EeE");
            var character = e.state;
            console.log(character);
            
            if (character == null) {
                removeCurrentClass();
                textWrapper.innerHTML = " ";
                content.innerHTML = " ";
                document.title = defaultTitle;
            } else {
                updateText(character);
                requestContent(character + ".html");
                addCurrentClass(character);
				document.title = "Ghostbuster | " + character;
            }
		});
		</script>

	<!-- Main navbar -->
	<?php include "core_mainnav.php"; ?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<?php include "core_sidebar-mobile-toggler.php"; ?>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">


				<!-- User menu -->
				<?php include "core_user-menu.php"; ?>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<?php
						include_once("menu.php");
						 ?>


					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">






			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $nombre_seccion; ?></span> - Listado</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center" style="display: none;">
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
						</div>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="home.php" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="<?php echo $url_name; ?>" class="breadcrumb-item"><?php echo $nombre_seccion; ?></a>
							<span class="breadcrumb-item active">Listado</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none" style="display: none;">
						<div class="breadcrumb justify-content-center">
							<a href="#" class="breadcrumb-elements-item" style="display: none;">
								<i class="icon-comment-discussion mr-2"></i>
								Support
							</a>

							<div class="breadcrumb-elements-item dropdown p-0" style="display: none;">
								<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear mr-2"></i>
									Settings
								</a>

								<div class="dropdown-menu dropdown-menu-right">
									<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
									<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
									<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page header -->



			<!-- Content area -->
			<div class="content">

				<!-- Create container -->
				<div class="card" id="container_create">
				
				</div>
				
				<!-- Basic datatable -->
				<div class="card" id="container">
				
					
					
					<div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div style="text-align:right;">
                            	<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="cargar_crear()"><i class="material-icons right">add</i> Agregar <?php echo $nombre_simple; ?></button>
                            	
                            	<?php /**
                                <a class="btn btn-primary" onclick="cargar_crear()" role="button">Agregar <?php echo $nombre_simple; ?></a>
                                
                                <a class="btn btn-primary" href="/Venta/VentaEvento?IdEvento=1&amp;Descripcion=OFICINA&amp;FechaInicio=01%2F01%2F0001%2000%3A00%3A00&amp;CP=0&amp;FechaAlta=01%2F01%2F0001%2000%3A00%3A00&amp;Activo=False&amp;FechaCierre=01%2F01%2F0001%2000%3A00%3A00&amp;IdEmpleadoAlta=0&amp;InventarioRevisado=False&amp;FechaRevisionInventario=01%2F01%2F0001%2000%3A00%3A00&amp;InventarioRevisadoDiaPost=False&amp;FechaRevisionInventarioDiaPost=01%2F01%2F0001%2000%3A00%3A00&amp;IdCierre=0&amp;CantidadProductosInventario=0&amp;FechaEntrega=01%2F01%2F0001%2000%3A00%3A00" role="button">Venta directa</a>
                            	
                            	<a class="btn btn-primary" href="/Producto/ResgitrarProductoCompleto" role="button">Agregar producto</a>
                                <a class="btn btn-primary" href="/Venta/VentaEvento?IdEvento=1&amp;Descripcion=OFICINA&amp;FechaInicio=01%2F01%2F0001%2000%3A00%3A00&amp;CP=0&amp;FechaAlta=01%2F01%2F0001%2000%3A00%3A00&amp;Activo=False&amp;FechaCierre=01%2F01%2F0001%2000%3A00%3A00&amp;IdEmpleadoAlta=0&amp;InventarioRevisado=False&amp;FechaRevisionInventario=01%2F01%2F0001%2000%3A00%3A00&amp;InventarioRevisadoDiaPost=False&amp;FechaRevisionInventarioDiaPost=01%2F01%2F0001%2000%3A00%3A00&amp;IdCierre=0&amp;CantidadProductosInventario=0&amp;FechaEntrega=01%2F01%2F0001%2000%3A00%3A00" role="button">Venta directa</a>
                                */ ?>
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                    </div>
                    <br /><br /><br />
                    
					
					<div class="card-header header-elements-inline">
						<h5 class="card-title"><?php //echo $nombre_seccion; ?></h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>
					<table class="table datatable-basic">
						<thead>
							<tr>
								
								<th style="text-align:left;">Nombre</th>
								<th style="text-align:left;">Apellido</th>
								<th style="text-align:left;">Cr&eacute;dito Pendiente</th>
								<th style="text-align:left;">Clasificaci&oacute;n</th>
								
								
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							


							<?php
							//}
							?>

							<?php 
							//$qry_resultados = "select * from $tbl_main order by Nombre asc";
							$qry_resultados = "select * from $tbl_main where Activo != 2 order by Nombre asc";
							
							$resultados = $obj->get_results($qry_resultados);
						
						//$qry_resultados = "select * from $tbl_main order by Fecha_Venta desc";
						
						//$resultados = $obj->get_results($qry_resultados);
						
						
						?>
						<?php foreach($resultados as $resultado): ?>
						
						
						
							<?php //for($i=0; $i<=10; $i++): ?>
							
							<?php 
							$id_resultado=$resultado->Id_Cliente;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Apellido_Paterno;
							$id_nivel="Hola";
							$extension="Hola";
							$area="Hola";
							$completo="Hola";
							$niveles="Hola";
							
							$qry_result = "select sum(ds_tbl_venta.MontoTotal) as total from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id_resultado and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
							//echo $qry_result;
							//exit;
							$result = $obj->get_row($qry_result);
							
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								<td><?php echo $nombre; ?></td>
								<td><?php echo $hexadecimal; ?></td>
								<td style="text-align:center;"><?php if($result->total): ?>$<?php echo $result->total; ?><?php endif; ?></td>
								<td>
									<?php
									if ($resultado->Activo == 0){
									    echo "Negativo";
									} else if ($resultado->Activo == 1){
									    echo "AA";
									} else if ($resultado->Activo == 2){
									    echo "Eliminado";
									} else if ($resultado->Activo == 3){
									    echo "AAA";
									}
									?>
								</td>

								<?php /**
								<td><?php echo ($result->Activo == 1)?  "Activo" : "Inactivo"; ?></td>
                                <td><?php if($result->Activo == 1){ echo "Activo"; }else{ echo "Inactivo"; } ?></td>

								<td><?php echo $hexadecimal; ?></td>
								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $color->Codigo_Hexadecimal; ?>"></div> <?php echo $color->Codigo_Hexadecimal; ?></td>
								*/ ?>
								
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<?php if($result->total == ""): ?>
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $nombre; ?>');"><i class="icon-bin"></i> Eliminar</a>
												<?php endif; ?>
												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												<?php /**
												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												*/ ?>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php //endfor; ?>
							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
				<!-- /basic datatable -->



			</div>
			<!-- /content area -->






			<!-- Footer -->
			<?php include "core_footer.php"; ?>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
