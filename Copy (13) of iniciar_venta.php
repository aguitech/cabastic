<?php include("includes/includes.php");
include_once("login.php");
include("common_files/sesion.php");
?>
<?php
include_once("db.php");
?>
<?php 
$nombre_seccion = "Iniciar venta";
$tbl_main = "ds_tbl_producto";
$nombre_simple = "producto";
$url_name = "productos.php";
$url_crear_name = "crear_producto.php";



unset ($_SESSION["cantidad_productos"]);
unset ($_SESSION["producto"]);
unset ($_SESSION["precio"]);
unset ($_SESSION["cantidad"]);

/*
$_SESSION["cantidad_productos"] = "";
$_SESSION["producto"] = "";
$_SESSION["precio"] = "";
$_SESSION["cantidad"] = "";
*/
$_SESSION["cantidad_productos"] = "";
$_SESSION["producto"];
$_SESSION["precio"];
$_SESSION["cantidad"];
?>
<?php
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


		/**

		function agregar_producto(id, secundario){
			   var val_page = "";
			   var val_categoria = "";
			   
			   $.ajax({
					type: "POST",
					url:"/views_online/punto_venta_agregar_producto.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id },
					success:function(data){
						console.log(data);
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
					}
				});
			   
		   }
		   function restar_producto(id, secundario){
			   //$("#container_inventario").html("");
			   var val_page = "";
			   var val_categoria = "";
			   
			   $.ajax({
					type: "POST",
					url:"/views_online/punto_venta_restar_producto.php",
					data: { id:id },
					success:function(data){
						console.log(data);
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
					}
				});
			   
		   }
		   function quitar_producto(id, secundario){
			   //$("#container_inventario").html("");
			   var val_page = "";
			   var val_categoria = "";
			   
			   $.ajax({
					type: "POST",
					url:"/views_online/punto_venta_quitar_producto.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id },
					success:function(data){
						console.log(data);
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
					}
				});
			   
		   }
		   
		   function guardar_venta(){
			   var id = 0;
			   var id_ship = $("#ship_direction").val();
			   $.ajax({
					type: "POST",
					url:"/views_online/guardar_venta.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id, id_ship:id_ship },
					success:function(data){
						console.log(data);
						$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');
						
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
					}
				});
		   }
		   */
		//function agregar_producto(id, secundario){
		function agregar_producto(id){
			   var val_page = "";
			   var val_categoria = "";
			   
			   $.ajax({
					type: "POST",
					url:"/iniciar_venta_agregar_producto.php?ind=0005",
					//url:"/views_online/punto_venta_agregar_producto.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id },
					success:function(data){
						console.log(data);
						//$("#form_venta").html(data);
						$("#resultado_venta").html(data);
						
						//$(".select_refresh").formSelect();
					}
				});
		   }
		   function restar_producto(id){
			   //$("#container_inventario").html("");
			   var val_page = "";
			   var val_categoria = "";
			   
			   $.ajax({
					type: "POST",
					//url:"/views_online/punto_venta_restar_producto.php",
					url:"/iniciar_venta_restar_producto.php",
					data: { id:id },
					success:function(data){
						console.log(data);
						$("#resultado_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
			   
		   }
		   function quitar_producto(id, secundario){
			   //$("#container_inventario").html("");
			   var val_page = "";
			   var val_categoria = "";
			   
			   $.ajax({
					type: "POST",
					//url:"/views_online/punto_venta_quitar_producto.php",
					url:"/iniciar_venta_quitar_producto.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id },
					success:function(data){
						console.log(data);
						$("#resultado_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
			   
		   }
		   
		   function guardar_venta(){
			   var id = 0;
			   var id_ship = $("#ship_direction").val();
			   $.ajax({
					type: "POST",
					url:"/views_online/guardar_venta.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id, id_ship:id_ship },
					success:function(data){
						console.log(data);
						$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');
						
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
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
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

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
							<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="usuarios.php" class="breadcrumb-item"><?php echo $nombre_seccion; ?></a>
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
                            	<a class="btn btn-primary" onclick="cargar_crear()" role="button">Agregar <?php echo $nombre_simple; ?></a>
                                <?php /**
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

					<div class="card-body">
						La lista de <code><?php echo $nombre_seccion; ?></code> muestra todos los participantes que pueden acceder a la <code>intranet</code>.
					</div>
					<div>
					
						<div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>XCliente a vender:</div>
        						<?php 
        						$qry_cliente = "select * from ds_tbl_cliente";
        						$clientes = $obj->get_results($qry_cliente);
        						?>
        						<select>
        							<?php foreach ($clientes as $cliente): ?>
        							<option value="<?php echo $cliente->Id_Cliente; ?>"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></option>
        							<?php endforeach; ?>
        						</select>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Evento:</div>
                                <?php 
        						$qry_evento = "select * from ds_tbl_evento";
        						$eventos = $obj->get_results($qry_evento);
        						?>
                                <select>
        							<?php foreach ($eventos as $evento): ?>
        							<option value="<?php echo $evento->Id_Evento; ?>"><?php echo $evento->Descripcion; ?></option>
        							<?php endforeach; ?>
        						</select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por marca:</div>
                                <?php 
        						$qry_marca = "select * from ds_cat_marca";
        						$marcas = $obj->get_results($qry_marca);
        						?>
                                <select>
        							<?php foreach ($marcas as $marca): ?>
        							<option value="<?php echo $marca->Id_Marca; ?>"><?php echo $marca->Descripcion; ?></option>
        							<?php endforeach; ?>
        						</select>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Filtro por producto:</div>
                                <select>
        							<option value=""></option>
        						</select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por talla:</div>
                                <select>
        							<option value=""></option>
        						</select>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Filtro por color:</div>
                                <select>
        							<option value=""></option>
        						</select>
                            </div>
                        </div>
                        						
					</div>


					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>ID</th>
								<th>Producto</th>
								<th>Marca</th>
								
								<th>Color</th>
								<th>Talla</th>
								<th>C&oacute;digo barras</th>
								
								<th>Precio MXN</th>
								<th>USD</th>
								<th>Inventario</th>
								<th>Agregar</th>
								
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							

                        <?php 
                        /**
                         $qt = "SELECT * FROM intranet_usuario ORDER BY id_usuario DESC LIMIT 300";
                         
                          $resultt = $mysqli->query($qt);
                          while ($rowt = $resultt->fetch_row()){

                            $id_usuario=$rowt[0];
                            $nombre=$rowt[1];
                            $pass=$rowt[2];
                            $id_nivel=$rowt[3];
                            $extension=$rowt[4];
                            $area=$rowt[5];
							$completo=$rowt[6];
							$niveles=$rowt[7];


							///////////////////////////////////////NIVELES
							if($niveles=="" && $niveles!="0" && $id_nivel!=""){
								$niveles=$id_nivel;

								$sq="UPDATE `intranet_usuario` SET `niveles` = '$niveles' WHERE `intranet_usuario`.`id_usuario` = $id_usuario;";
								//echo $sq;
								//$resul = $mysqli->query($sq);
							}
							if($niveles!=""){
								//echo "NIVELES: ".$niveles." - ";
								$niveles = explode(",", $niveles);
								$losniveles="";
								for ($i=0;$i<count($niveles);$i++)    
								{
									$losniveles .= $niveles[$i].",";
								} 
								$losniveles = substr($losniveles,0,-1);
								$sq="SELECT * FROM `intranet_nivel` WHERE id_nivel =100 ";
								$nivelesarray = explode(",", $losniveles);
								for ($i=0;$i<count($nivelesarray);$i++)    
								{
									$sq .= " OR id_nivel=".$nivelesarray[$i];
								} 
								//echo $sq;
								$resul = $mysqli->query($sq);
								$niveles_nombres="";
								while ($row = $resul->fetch_row()){

									$id_nivel=$row[0];
									$nombre_nivel=$row[1];
									//echo " ".$nombre_nivel." <br>";
									$niveles_nombres .= "- ".$nombre_nivel."<br> ";
								}
								//$niveles_nombres = substr($niveles_nombres,0,-2);
								$area = $niveles_nombres;
							}
							/////////////////////////////////////////////NIVELES



                            */

                        ?>  
                        
                        
                        	<?php /**?>
							<tr id="element<?php echo $id_usuario; ?>">
								<td><?php echo $id_usuario; ?></td>
								<td><a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>"><?php echo $nombre; ?></td>
								<td><?php echo $pass; ?></td>
								
								<td><?php echo $extension; ?></td>
								<td><?php echo $area; ?></td>
								<td><?php echo $completo; ?></td>

								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_usuario; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Remove</a>
												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												
											</div>
										</div>
									</div>
								</td>
							</tr>

							*/ ?>

							<?php
							//}
							?>

							<?php 
							//$qry_resultados = "select * from $tbl_main order by Descripcion asc";
							//$qry_resultados = "select * from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.Id_Marca = ds_tbl_producto_detalle.Id_Marca order by $tbl_main.Descripcion asc";
							//left join ds_cat_marca on ds_cat_marca.Id_Marca = ds_tbl_producto_detalle.Id_Marca
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.Id_Marca = ds_tbl_producto_detalle.Id_Marca order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select * from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto order by $tbl_main.Descripcion asc";
							/**
							select *, ds_cat_marca.Descripcion as marca from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca order by ds_tbl_producto.Descripcion ascArray ( [0] => stdClass Object ( [Id_Producto] => 256 [Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] => VESTRUM [Imagen_Producto] => [Id_Marca] => 1 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:07:02 [Id_Categoria_Producto] => 79 [Id_Producto_Detalle] => 256 [Codigo_Barras] => 8001500280093 [Id_Talla] => 7 [Id_Color] => 39 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:07:02 [marca] => VESTRUM ) [1] => stdClass Object ( [Id_Producto] => 512 [Nombre] => AA LADIES MOTION LITE JACKET [Descripcion] => HORSE WARE [Imagen_Producto] => [Id_Marca] => 11 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:13:11 [Id_Categoria_Producto] => 77 [Id_Producto_Detalle] => 512 [Codigo_Barras] => 0 [Id_Talla] => 6 [Id_Color] => 12 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:13:11 [marca] => HORSE WARE ) [2] => stdClass Object ( [Id_Producto] => 257 [Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] => VESTRUM [Imagen_Producto] => [Id_Marca] => 1 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:07:02 [Id_Categoria_Producto] => 79 [Id_Producto_Detalle] => 257 [Codigo_Barras] => 0 [Id_Talla] => 9 [Id_Color] => 60 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:07:02 [marca] => VESTRUM ) [3] => stdClass Object ( [Id_Producto] => 513 [Nombre] => AA LADIES MOTION LITE JACKET [Descripcion] => HORSE WARE [Imagen_Producto] => [Id_Marca] => 11 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:13:11 [Id_Categoria_Producto] => 77 [Id_Producto_Detalle] => 513 [Codigo_Barras] => 0 [Id_Talla] => 34 [Id_Color] => 12 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:13:11 [marca] => HORSE WARE ) [4] => stdClass Object ( [Id_Producto] => 769 [Nombre] => A.M.P. JACKET [Descripcion] => HORSE PILOT [Imagen_Producto] => [Id_Marca] => 14 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:14:10 [Id_Categoria_Producto] => 77 [Id_Producto_Detalle] => 769 [Codigo_Barras] => 3701101209183 [Id_Talla] => 15 [Id_Color] => 12 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:14:10 [marca] => HORSE PILOT ) [5] => stdClass Object ( [Id_Producto] => 2 [Nombre] => 91V W191 GRENOBLE GRIP [Descripcion] => VESTRUM [Imagen_Producto] => [Id_Marca] => 1 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:07:02 [Id_Categoria_Producto] => 81 [Id_Producto_Detalle] => 2 [Codigo_Barras] => 8001500018603 [Id_Talla] => 27 [Id_Color] => 32 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:07:02 [marca] => VESTRUM ) [6] => stdClass Object ( [Id_Producto] => 258 [Nombre] => 01 VW3024 M
							ds_tbl_precio_venta_producto
							*/
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
							//Id_Color
							//left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color 
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color order by $tbl_main.Descripcion asc";
							//ds_cat_color
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color order by $tbl_main.Descripcion asc";
							//left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle 
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto != 0 order by $tbl_main.Descripcion asc";
							$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' order by $tbl_main.Descripcion asc";
							
							
							
							//echo $qry_resultados;
						
							$resultados = $obj->get_results($qry_resultados);
						
							//print_r($resultados);
						//$qry_resultados = "select * from $tbl_main order by Fecha_Venta desc";
						
						//$resultados = $obj->get_results($qry_resultados);
						
						
						?>
						<?php foreach($resultados as $resultado): ?>
						
						
						
							<?php //for($i=0; $i<=10; $i++): ?>
							
							<?php 
							//[0] => stdClass Object ( [Id_Producto] => 256 
							//[Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] 
							//=> [Id_Marca] => 1 [Id_Tipo_Producto] => 14
							//[Id_Tipo_Sustancia] => 1 [Activo] => 1 
							//[Fecha_Alta] => 2020-07-21 22:10:43 
							//[Id_Categoria_Producto] => 79 
							
							$id_resultado=$resultado->Id_Producto;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Descripcion;
							$id_nivel="Hola";
							$extension="Hola";
							$area="Hola";
							$completo="Hola";
							$niveles="Hola";
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								<td><?php echo $id_resultado; ?></td>
								<td><a href="usuarios_editar.php?id=<?php echo $id_resultado; ?>"><?php echo $nombre; ?></td>
								<td><?php echo $resultado->marca; ?></td>
								
								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div><br /><?php echo $resultado->color; ?><br /><?php echo $resultado->Codigo_Hexadecimal; ?></td>
								<td><?php echo $resultado->talla; ?></td>
								<td><?php echo $resultado->Codigo_Barras; ?></td>
								<td><?php echo $resultado->Costo_Venta; ?></td>
								
								<td><?php echo $resultado->Dolar; ?></td>
								<td><?php echo $resultado->Cantidad_Inventario; ?><?php //print_r($resultado); ?></td>
								<td><a onclick="agregar_producto('<?php echo $id_resultado; ?>')">Agregar</a></td>

								<?php /**
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
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Remove</a>
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
					
					
					<div id="resultado_venta">
						&nbsp;
					</div>
					<div>
					
						 XXXDescuento 0 a 100  
Descuento en precio
Tipo de cambio
Desglose de precios

Sub Total MXN:

$0.00

Descuento:

$0.00

IVA:

$0.00

Total MXN:

$0.00

Total USD:

$0.00
¿Exentar I.V.A.?
						
					</div>
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

