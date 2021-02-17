<?php include("includes/includes.php");
include_once("login.php");
include("common_files/sesion.php");
?>
<?php
include_once("db.php");
?>
<?php 
$nombre_seccion = "Asignar inventario a evento";
$tbl_main = "ds_tbl_producto";
$nombre_simple = "producto";
$url_name = "evento_asignar_inventario.php";
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

$id_evento = $_GET["id_evento"];

//print_r($_POST);

$qry_evento_detalle = "select * from ds_tbl_evento where Id_Evento = {$id_evento}";
$evento_detalle = $obj->get_row($qry_evento_detalle);



//if($_POST["id_producto"] != "" && $_POST["costo_compra"] != "" && $_POST[""] != "" && $_POST[""] != "" && $_POST[""] != "" && $_POST[""] != ""){
if($_POST["id_producto"] != "" && $_POST["id_producto_detalle"] != "" && $_POST["costo_compra"] != "" ){
    $id_producto = $_POST["id_producto"];
    $id_producto_detalle = $_POST["id_producto_detalle"];
    $costo_compra = $_POST["costo_compra"];
    $impuesto_adicional = $_POST["impuesto_adicional"];
    $costo_dolares = $_POST["costo_dolares"];
    $iva = $_POST["iva"];
    $fecha_actualizacion = date("Y-m-d H:i:s");
    
    $qry_costo_producto_actual = "select * from ds_tbl_costo_compra_producto where ds_tbl_costo_compra_producto.Id_Producto_Detalle = $id_producto_detalle";
    $precio_producto_actual = $obj->get_row($qry_costo_producto_actual);
    
    print_r($precio_producto_actual);
    echo $precio_producto_actual->Costo_Compra;
    if($precio_producto_actual->Costo_Compra != ""){
        //UPDATE
        
        $id_costo_compra_producto = $precio_producto_actual->Id_Costo_Producto;
        $costo_compra_anterior = $precio_producto_actual->Costo_Compra;
        //$qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //$qry_insert_costo_producto_actual = "insert into  (Id_Producto_Detalle, , , , , , , , ) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //echo "HEY";
        //$qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $costo_dolares, Valor_Tipo_Cambio_Anterior = $costo_dolares)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);
        $qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $costo_dolares, Valor_Tipo_Cambio_Anterior = $costo_dolares where Id_Producto_Detalle = $id_producto_detalle and Id_Costo_Producto = $id_costo_compra_producto";
        //echo $qry_update_costo_producto;
        $obj->query($qry_update_costo_producto);
        
    }else{
        //echo "HOLA";
        //INSERT
        //
        //Id_Costo_Producto 	 	Costo_Mxn 	Costo_Dolar 	 	 	 	 	 	 	Euro 	Libra 	 	
        
        $qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);
        //echo $qry_insert_costo_producto_actual;
        $obj->query($qry_insert_costo_producto_actual);
    }
    
    
    
    
    
    
}
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
	<style>
	#container_popup_fondo{
		position:fixed;
		top:0;
		left:0;
		right:0;
		bottom:0;
		background:black;
		opacity:.7;
		z-index:100;
		display:none;
		
	}
    #container_popup{
    	position:fixed;
		background:white;
    	width:400px;
    	height:400px;
    	z-index:101;
    	left:50%;
    	top:50%;
    	margin-left:-200px;
    	margin-top:-200px;
    	display:none;
	}
	</style>
</head>

<body>
	<div id="container_popup_fondo" onclick="$('#container_popup_fondo').hide(); $('#container_popup').hide();">
		
	</div>
	<div id="container_popup">
		<div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
			<div>
				<div id="popup_resultado">
					
				</div>
			</div>
		</div>
	</div>
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



		   function filtrar_resultados_tabla(){

			   var id_marca = $("#id_marca").val();
			   var id_producto = $("#id_producto").val();
			   var id_talla = $("#id_talla").val();
			   var id_color = $("#id_color").val();
			   

			   $.ajax({
					type: "POST",
					//url:"ajax_iniciar_venta_filtrar_tabla.php",
					url:"ajax_inventario_tabla.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id_marca:id_marca, id_producto:id_producto, id_talla:id_talla, id_color:id_color },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						$("#resultado_filtrados").html(data);
						
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
			   //filtrar_marca
		   }


		   
		   function filtrar_marca(id){
			   $.ajax({
					type: "POST",
					url:"ajax_iniciar_venta_filtrar_marca.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						$("#resultado_filtrado_marca").html(data);

						filtrar_resultados_tabla();
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
			   //filtrar_marca
		   }
		   function filtrar_producto(id){
			   $.ajax({
					type: "POST",
					url:"ajax_iniciar_venta_filtrar_producto.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						$("#resultado_filtrado_producto").html(data);


						filtrar_resultados_tabla();
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
			   //filtrar_marca
		   }
		   function filtrar_talla(id){
			   var id_producto = $("#id_producto").val();
			   $.ajax({
					type: "POST",
					url:"ajax_iniciar_venta_filtrar_talla.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id:id, id_producto:id_producto },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						$("#resultado_filtrado_talla").html(data);

						filtrar_resultados_tabla();
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
			   //filtrar_marca
		   }
		   function filtrar_color(id){
			   var id_producto = $("#id_producto").val();
			   var id_talla = $("#id_talla").val();
			   var id_color = $("#id_color").val();
			   $.ajax({
					type: "POST",
					url:"ajax_iniciar_venta_filtrar_color.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id_color:id_color, id_producto:id_producto, id_talla:id_talla },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						//$("#resultado_filtrado_talla").html(data);

						
						filtrar_resultados_tabla();
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
			   //filtrar_marca
		   }


		   function detalle_precio(id){
				$("#container_popup_fondo").show();
				$("#container_popup").show();

				   $.ajax({
						type: "POST",
						url:"popup_asignar_precio_venta.php",
						data: { id:id },
						success:function(data){
							console.log(data);
							$("#popup_resultado").html(data);

						}
					});
		   }
		   function detalle_costo(id){
				$("#container_popup_fondo").show();
				$("#container_popup").show();

				   $.ajax({
						type: "POST",
						url:"popup_asignar_costo_compra.php",
						data: { id:id },
						success:function(data){
							console.log(data);
							$("#popup_resultado").html(data);

						}
					});
		   }
		   function actualizar_costo(costo, id){
			   var id_input = "#resultado_input" + id;

			   var id_input_alternativo = "#input_alternativo" + id;
			   

			   var contenedor_dolar = "#contenedor_dolar" + id;
			   
			   
			   $.ajax({
					type: "POST",
					url:"actualizar_costo_compra.php",
					data: { costo:costo, id:id },
					success:function(data){
						console.log(data);
						$(id_input_alternativo).hide();
						
						$(id_input).show();
						$(id_input).html(data);


						
						
						mostrar_valor_dolar(id);
						//$(contenedor_dolar).html(data);

						
						//$("#popup_resultado").html(data);
						
					}
				});
		   }
		   function mostrar_valor_dolar(id){
			   
			   var contenedor_dolar = "#contenedor_dolar" + id;
			   
			   
			   $.ajax({
					type: "POST",
					url:"mostrar_valor_dolar.php",
					data: { id:id },
					success:function(data){
						$(contenedor_dolar).html(data);

						//$(contenedor_dolar).html(data);

						
						//$("#popup_resultado").html(data);
						
					}
				});
		   }

		   function actualizar_inventario_evento(id_producto_detalle, cantidad_inventario){
			   //alert(id_producto_detalle);
			   //alert(cantidad_inventario);

			   var contenedor_cantidad_inventario = "#contenedor_cantidad_inventario" + id_producto_detalle;
			   
			   
			   var id_evento = $("#id_evento").val();

				//alert("ID EVENTO");
			   //alert(id_evento);
			   
			   $.ajax({
					type: "POST",
					url:"actualizar_inventario_evento.php",
					data: { id_producto_detalle:id_producto_detalle, cantidad_inventario:cantidad_inventario, id_evento:id_evento },
					success:function(data){
						//$(contenedor_dolar).html(data);

						//$(contenedor_dolar).html(data);

						$(contenedor_cantidad_inventario).html(data);
						//$("#popup_resultado").html(data);
						
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
							<a href="home.php" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="<?php echo $url_name; ?>" class="breadcrumb-item"><?php echo $nombre_seccion; ?> "<?php echo $evento_detalle->Descripcion; ?>"</a>
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
				
					
					<?php /**
					<div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div style="text-align:right;">
                            	<a class="btn btn-primary" onclick="cargar_crear()" role="button">Agregar <?php echo $nombre_simple; ?></a>
                                
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                    </div>
                    <br /><br /><br />
                    */ ?>
					
					<div class="card-header header-elements-inline">
						<h5 class="card-title"><?php echo $nombre_seccion; ?> "<?php echo $evento_detalle->Descripcion; ?>"</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>
					<div>
					
						<?php /**
						<div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Cliente a vender:</div>
        						<?php 
        						$qry_cliente = "select * from ds_tbl_cliente";
        						$clientes = $obj->get_results($qry_cliente);
        						?>
        						<select name="" id="" class="form-control">
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
                                <select name="" id="" class="form-control">
        							<?php foreach ($eventos as $evento): ?>
        							<option value="<?php echo $evento->Id_Evento; ?>"><?php echo $evento->Descripcion; ?></option>
        							<?php endforeach; ?>
        						</select>
                            </div>
                        </div>
                        */ ?>
                        <input type="hidden" id="id_evento" value="<?php echo $_GET["id_evento"]; ?>" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por marca:</div>
                                <?php 
        						$qry_marca = "select * from ds_cat_marca";
        						$marcas = $obj->get_results($qry_marca);
        						?>
                                <select name="id_marca" id="id_marca" class="form-control" onchange="filtrar_marca(this.value);">
                                	<option value="">Selecciona una marca</option>
        							<?php foreach ($marcas as $marca): ?>
        							<option value="<?php echo $marca->Id_Marca; ?>"><?php echo $marca->Descripcion; ?></option>
        							<?php endforeach; ?>
        						</select>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Filtro por producto:</div>
                             	<div id="resultado_filtrado_marca">
                                    <select name="" id="" class="form-control">
            							<option value=""></option>
            						</select>
        						</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por talla:</div>
                             	<div id="resultado_filtrado_producto">
                                    <select name="" id="" class="form-control">
            							<option value=""></option>
            						</select>
        						</div>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Filtro por color:</div>
                                <div id="resultado_filtrado_talla">
                                    <select name="" id="" class="form-control">
            							<option value=""></option>
            						</select>
        						</div>
                            </div>
                        </div>
                        						
					</div>

					<div id="resultado_filtrados">

    					<table class="table datatable-basic">
    						<thead>
    							<tr>
    								<th>ID</th>
    								<th>C&oacute;digo barras</th>
    								
    								<th>Producto</th>
    								<?php /**
    								<th>Descripci&oacute;n</th>
    								*/ ?>
    								<th>Marca</th>
    								
    								<th>Color</th>
    								<th>Talla</th>
    								<th>Existencias</th>
    								
    								<th>Tipo Almac&eacute;n</th>
    								<th>Cantidad</th>
    								
    								<th class="text-center">Actions</th>
    							</tr>
    						</thead>
    						<tbody>
    							
    
                            <?php 
                            /**
                             
                                */
    
                            ?>  
                            
                            
                            	<?php /**?>
    							
    							*/ ?>
    
    							<?php
    							//}
    							?>
    
    							<?php 
    							//$qry_resultados = "select * from $tbl_main order by Descripcion asc";
    							//ds_tbl_producto.Id_Producto_Detalle != ''
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' or ds_tbl_producto_detalle.Id_Producto_Detalle != 0 or ds_tbl_producto_detalle.Id_Producto_Detalle != '' order by $tbl_main.Descripcion asc";
    							//ds_tbl_inventario_almacen.Id_Tipo_Almacen = //
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, ds_cat_tipo_almacen.Descripcion as tipo_almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_tbl_inventario_almacen.Id_Tipo_Almacen = ds_cat_tipo_almacen.Id_Tipo_Almacen where $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' or ds_tbl_producto_detalle.Id_Producto_Detalle != 0 or ds_tbl_producto_detalle.Id_Producto_Detalle != '' order by $tbl_main.Descripcion asc";
    							$qry_resultados = "select *, ds_tbl_producto_detalle.Id_Producto_Detalle as Id_Producto_Detalle, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, ds_cat_tipo_almacen.Descripcion as tipo_almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_tbl_inventario_almacen.Id_Tipo_Almacen = ds_cat_tipo_almacen.Id_Tipo_Almacen where $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' or ds_tbl_producto_detalle.Id_Producto_Detalle != 0 or ds_tbl_producto_detalle.Id_Producto_Detalle != '' order by $tbl_main.Descripcion asc";
    							
    							//ds_tbl_producto_detalle.Id_Producto_Detalle
    							
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
    							
    							<?php if($resultado->Id_Producto_Detalle != ""){ ?>
    							<tr id="element<?php echo $id_resultado; ?>">
    								<td><?php echo $id_resultado; ?></td>
    								<td><?php echo $resultado->Codigo_Barras; //print_r($resultado); ?></td>
    								<td><a href="usuarios_editar.php?id=<?php echo $id_resultado; ?>"><?php echo $nombre; ?></td>
    								<?php /**
    								<td><?php echo $resultado->Descripcion; ?></td>
    								*/ ?>
    								<td><?php echo $resultado->marca; ?></td>
    								
    								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div><br /><?php echo $resultado->color; ?><br /><?php echo $resultado->Codigo_Hexadecimal; ?></td>
    								<td><?php echo $resultado->talla; ?> <?php //print_r($resultado); ?></td>
    								<?php /**
    								<td><?php echo $resultado->Costo_Venta; ?></td>
    								<td><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = $resultado->Costo_Compra; }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div></td>
    								
    								<td><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = $resultado->Costo_Compra; }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div></td>
    								
    								*/ ?>
    								<td><div id="contenedor_cantidad_inventario<?php echo $id_resultado; ?>"><?php echo $resultado->Cantidad_Inventario; ?><?php //echo $qry_resultados; //print_r($resultado); ?></div></td>
    								<td><?php echo $resultado->tipo_almacen; ?><?php //echo $qry_resultados; //print_r($resultado); ?></td>
    								
    								<td><input type="text" name="" id="" onchange="actualizar_inventario_evento(<?php echo $resultado->Id_Producto_Detalle; ?>, this.value);" /></td>
    								
    								
    								<?php /**
    								<td><div id="contenedor_dolar<?php echo $id_resultado; ?>"><?php echo $resultado->Dolar; ?></div></td>
    								<td><a onclick="detalle_costo('<?php echo $id_resultado; ?>')">Detalle Precio</a></td>
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
    												
    												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Asignar Empleado</a>
    												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Asignar Inventario</a>
    												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Iniciar Venta</a>
    												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Cierre de evento</a>
    												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Ver evento</a>
    																			
    												
    												<?php /**
    												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
    												*/ ?>
    											</div>
    										</div>
    									</div>
    								</td>
    							</tr>
    							<?php } ?>
    							<?php //endfor; ?>
    							<?php endforeach; ?>
    
    						</tbody>
    					</table>
    				</div>
					
					
					<div id="resultado_venta">
						&nbsp;
					</div>
					<div>
					
						
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

  