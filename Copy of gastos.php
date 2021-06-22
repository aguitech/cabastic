<?php include("includes/includes.php"); ?>
<?php include("common_files/sesion.php"); ?>
<?php 
$nombre_seccion = "Gastos";
$tbl_main = "ds_tbl_gasto";
$nombre_simple = "gasto";
$url_name = "gastos.php";
$url_crear_name = "crear_gasto.php";
?>
<?php 
if($_POST["Monto"] != ""){
    //print_r($_POST);
    
    //Id_Gasto 	 Id_Empleado 	Id_Tipo_Gasto 	Monto 	Fecha 	Comprobante
    $val_id_empleado = $_SESSION["idusuario"];
    $val_tipo_gasto = $_POST["Id_Tipo_Gasto"];
    $val_monto = $_POST["Monto"];
    $val_fecha = date("Y-m-d");
    $val_comprobante = $_POST["Comprobante"];
    
    
    $fecha_hoy = date("Y-m-d H:i:s");
    
    
    if($_POST["editar"] != ""){
        $id_editar = $_POST["editar"];
        //$qry_edit = "update ds_cat_tipo_sustancia set Descripcion = '{$val_descripcion}', Abreviatura = '{$val_abreviatura}', Comentario = '{$val_comentario}', Activo = $val_activo, Fecha_Actualiza = '{$fecha_hoy}' where Id_Tipo_Sustancia = $id_editar";
        //echo $qry_edit;
        //$qry_edit = "update ds_tbl_evento set Descripcion = '{$val_evento}', Fecha_Inicio = '{$val_fecha_inicio}', Fecha_Cierre = '{$val_fecha_cierre}', Calle = '{$val_calle}', Colonia = '{$val_colonia}', Fecha_Actualiza = '{$fecha_hoy}' where Id_Talla = $id_editar";
        //
        //$qry_edit = "update ds_tbl_evento set Descripcion = '{$val_evento}', Fecha_Inicio = '{$val_fecha_inicio}', Fecha_Cierre = '{$val_fecha_cierre}', Calle = '{$val_calle}', Colonia = '{$val_colonia}', Fecha_Actualiza = '{$fecha_hoy}' where Id_Talla = $id_editar";
        //
        if($_FILES["Comprobante"]['name'] != ""){
            
            
            $prefix_fecha = date("YmdHis") . "_";
            //$destino = '../../../images/blog';
            $destino = 'images/gastos';
            
            $name_imagen_url = $prefix_fecha . $_FILES['Comprobante']['name'];
            
            //copy($_FILES['blogfoto']['tmp_name'][$i], $destino . '/' . $prefix_fecha . $_FILES['blogfoto']['name'][$i]);
            copy($_FILES['Comprobante']['tmp_name'], $destino . '/' . $name_imagen_url);
            
            
            //$qry_update_imagen = "update ds_tbl_producto_imagen set Url_Imagen = '$name_imagen_url' where Id_Producto = $id_producto";
            
            //$obj->query($qry_update_imagen);
            
            
        }
        
        $qry_edit = "update ds_tbl_gasto set Id_Tipo_Gasto = {$val_tipo_gasto}, Monto = '{$val_monto}', Fecha = '{$val_fecha}', Comprobante = '{$name_imagen_url}' where Id_Gasto = $id_editar";
        //
        //echo $qry_edit;
        $obj->query($qry_edit);
    }else{
        
        
        if($_FILES["Comprobante"]['name'] != ""){
            
            
            $prefix_fecha = date("YmdHis") . "_";
            //$destino = '../../../images/blog';
            $destino = 'images/gastos';
            
            $name_imagen_url = $prefix_fecha . $_FILES['Comprobante']['name'];
            
            //copy($_FILES['blogfoto']['tmp_name'][$i], $destino . '/' . $prefix_fecha . $_FILES['blogfoto']['name'][$i]);
            copy($_FILES['Comprobante']['tmp_name'], $destino . '/' . $name_imagen_url);
            
            
            //$qry_update_imagen = "update ds_tbl_producto_imagen set Url_Imagen = '$name_imagen_url' where Id_Producto = $id_producto";
            
            //$obj->query($qry_update_imagen);
            
            
        }
        
        
    
        //$qry_insert = "insert into ds_cat_tipo_sustancia (Descripcion, Abreviatura, Comentario, Activo, Fecha_Alta, Fecha_Actualiza) values ('{$val_descripcion}', '{$val_abreviatura}', '{$val_comentario}', 1, '{$fecha_hoy}', '{$fecha_hoy}')";
        //$qry_insert = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Fecha_Cierre, Calle, Colonia) values ('{$val_descripcion}', '{$val_abreviatura}', 1, '{$fecha_hoy}', '{$fecha_hoy}')";
        //$qry_insert = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Fecha_Cierre, Calle, Colonia, Fecha_Alta, Activo) values ('{$val_evento}', '{$val_fecha_inicio}', '{$val_fecha_cierre}', '{$val_calle}', '{$val_colonia}', '{$fecha_hoy}', 1)";
        //$qry_insert = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Fecha_Cierre, Calle, Colonia, Fecha_Alta, Activo) values ('{$val_evento}', '{$val_fecha_inicio}', '{$val_fecha_cierre}', '{$val_calle}', '{$val_colonia}', '{$fecha_hoy}', 1)";
        $qry_insert = "insert into ds_tbl_gasto (Id_Empleado, Id_Tipo_Gasto, Monto, Fecha, Comprobante) values ({$val_id_empleado}, {$val_tipo_gasto}, '{$val_monto}', '{$val_fecha}', '{$name_imagen_url}')";
        //echo $qry_insert;
        $obj->query($qry_insert);
        
        $last_id_qry = $obj->get_row("select * from ds_tbl_gasto order by Id_Gasto desc");
        
        $last_id = $last_id_qry->Id_Gasto;
        $neext_id = $last_id + 1;
        
        
        
        
    }
    
    
    
    if($_FILES["Comprobante"]['name'] != ""){
        
        
        $prefix_fecha = date("YmdHis") . "_";
        //$destino = '../../../images/blog';
        $destino = 'images/gastos';
        
        $name_imagen_url = $prefix_fecha . $_FILES['imagen_producto']['name'];
        
        //copy($_FILES['blogfoto']['tmp_name'][$i], $destino . '/' . $prefix_fecha . $_FILES['blogfoto']['name'][$i]);
        copy($_FILES['imagen_producto']['tmp_name'], $destino . '/' . $name_imagen_url);
        
        
        
        $qry_verificar_imagen = "select * from ds_tbl_producto_imagen where Id_Producto = $id_producto";
        $verificar_imagen = $obj->get_row($qry_verificar_imagen);
        
        if($verificar_imagen->Id_Producto != ""){
            //$qry_update_imagen = "update ds_tbl_producto_imagen set Id_Producto_Imagen = $last_id_producto_imagen_val, Id_Producto = $id_producto, Url_Imagen = '$name_imagen_url' where ";
            $qry_update_imagen = "update ds_tbl_producto_imagen set Url_Imagen = '$name_imagen_url' where Id_Producto = $id_producto";
            
            $obj->query($qry_update_imagen);
            
        }else{
            
            $qry_last_id_producto_imagen = "select * from ds_tbl_producto_imagen order by Id_Producto_Imagen desc";
            $last_id_producto_imagen = $obj->get_row($qry_last_id_producto_imagen);
            
            $last_id_producto_imagen_val = $last_id_producto_imagen->Id_Producto_Imagen + 1;
            
            
            $qry_insert_imagen = "insert into ds_tbl_producto_imagen (Id_Producto_Imagen, Id_Producto, Url_Imagen) values ($last_id_producto_imagen_val, $id_producto, '$name_imagen_url')";
            
            //echo $qry_insert_imagen;
            
            $obj->query($qry_insert_imagen);
            
        }
        
        
    }
    
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
	<?php /**
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="global_assets/js/main/jquery.min.js"></script>
	<script src="global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="full/assets/js/app.js"></script>
	<script src="global_assets/js/demo_pages/datatables_basic.js"></script>
	<!-- /theme JS files -->

	*/ ?>
	<script src="global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="global_assets/js/plugins/pickers/anytime.min.js"></script>
	<script src="global_assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script src="global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script src="global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
	<script src="global_assets/js/plugins/notifications/jgrowl.min.js"></script>

	<script src="global_assets/js/demo_pages/picker_date.js"></script>
	<script type="text/javascript">
		$( document ).ready(function() {
    		console.log( "ready!" );
    		
		});

		function Eliminar(t_id,t_completo){
			//alert("Eliminar; "+t_id);

			var r = confirm("Estás seguro que deseas eliminar al usuario: "+t_completo);
			if (r == true) {
			  txt = "You pressed OK!";

			  	$.ajax({url: "usuarios_eliminar.php?id="+t_id, success: function(result){
    				//$("#div1").html(result);
    				//alert(result);
    				$("#element"+t_id).hide(500);
  				}});

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

			var nowDate = new Date();
			var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
			
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

					$('.daterange-single').daterangepicker({ 
			            singleDatePicker: true,
			            startDate: today
			        });
					
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





		function asignar_empleado(id){
			$.ajax({
				type: "POST",
                url:"evento_asignar_empleado.php",
                data: { id:id },
                success:function(data){
                	console.log(data);
                	$("#container").hide();
                	$("#container_create").show();
                	$("#container_create").html(data);
                	
                }
			});
		}
		function asignar_inventario(id){
			var url_2_go = "https://cabastic.info/evento_asignar_inventario.php?id_evento=" + id;

			window.location = url_2_go;
			/*
			$.ajax({
				type: "POST",
                url:"evento_asignar_inventario.php",
                data: { id:id },
                success:function(data){
                	console.log(data);
                	$("#container_create").html(data);
                }
			});
			*/
		}
		function iniciar_venta(id){


			var url_2_go = "https://cabastic.info/iniciar_venta.php?id_evento=" + id;

			window.location = url_2_go;
			/*
			$.ajax({
				type: "POST",
                url:"evento_iniciar_venta.php",
                data: { id:id },
                success:function(data){
                	console.log(data);
                	$("#container_create").html(data);
                }
			});
			*/
		}
		function cierre_evento(id){
			var url_2_go = "https://cabastic.info/evento_cierre.php?id_evento=" + id;

			window.location = url_2_go;
			
			/**
			$.ajax({
				type: "POST",
                url:"evento_cierre.php",
                data: { id:id },
                success:function(data){
                	console.log(data);
                	$("#container_create").html(data);
                }
			});
			*/
			/*
			$.ajax({
				type: "POST",
                url:"evento_cierre.php",
                data: { id_evento:id },
                success:function(data){
                	console.log(data);
                	$("#container_create").html(data);
                }
			});
			*/
		}
		function ver_evento(id){

			var url_2_go = "https://cabastic.info/evento_detalle.php?id_evento=" + id;

			window.location = url_2_go;
			/*
			$.ajax({
				type: "POST",
                url:"evento_detalle.php",
                data: { id:id },
                success:function(data){
                	console.log(data);
                	$("#container").hide();
                	$("#container_create").html(data);
                	
                }
			});
			*/
		}
		function asignar_empleado_evento(id_empleado, id_evento){
			//
			$.ajax({
				type: "POST",
                url:"asignar_empleado_evento.php",
                data: { id_empleado:id_empleado, id_evento:id_evento },
                success:function(data){
                	console.log(data);
                	//alert(data);
                	//$("#container").hide();
                	//$("#container_create").html(data);
                	
                }
			});
		}
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
						<h5 class="card-title"><?php echo $nombre_seccion; ?></h5>
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
								<th>Tipo de Gasto</th>
								<th>Monto</th>
								<th>Comprobante</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							
						<?php
						//}
						/**
                        Id_Venta	Id_Cliente	Fecha_Venta	MontoTotal	Id_Evento	DescuentoPorcentaje	DescuentoPrecio	TipoCambio	MontoTotalMXN	IdEmpleado	plazo	frecuencia	id_Motivo_Cancelacion	fecha_Cancelacion
						*/
						?>
						<?php 
						$qry_resultados = "select * from $tbl_main left join ds_cat_tipo_gasto on ds_cat_tipo_gasto.Id_Tipo_Gasto = $tbl_main.Id_Tipo_Gasto order by $tbl_main.fecha desc";
						
						$resultados = $obj->get_results($qry_resultados);
						
						
						?>
						<?php foreach($resultados as $resultado): ?>
						
						
							<?php 
							$id_resultado=$resultado->Id_Gasto;
							
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								<td><?php echo $resultado->Tipo_Gasto; ?></td>
								<td><?php echo $resultado->Monto; ?></td>
								
								<td><?php echo $resultado->Comprobante; ?></td>
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<?php /**?>
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Eliminar</a>
												*/ ?>
												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												
												
												
												<a onclick="asignar_empleado('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Asignar Empleado</a>
												<a onclick="asignar_inventario('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Asignar Inventario</a>
												<a onclick="iniciar_venta('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Iniciar Venta</a>
												<a onclick="if(confirm('¿Estas seguro de cerrar el evento?\n¡No es reversible est&aacute; acci&oacute;n!')){ cierre_evento('<?php echo $id_resultado; ?>') }" class="dropdown-item"><i class="icon-pencil4"></i> Cierre de evento</a>
												<a onclick="ver_evento('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Ver evento</a>
																		
											</div>
										</div>
									</div>
								</td>
							</tr>
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