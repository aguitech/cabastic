<?php include("includes/includes.php");?>
<?php include("common_files/sesion.php"); ?>
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

$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");
$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");
$almacenes = $obj->get_results("select * from ds_cat_tipo_almacen order by Descripcion asc");
//$productos = $obj->get_results("select * from ds_tbl_producto order by Nombre asc");
$productos = $obj->get_results("select * from ds_tbl_producto group by Nombre order by Nombre asc");

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
	 <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>

        <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
	function filtrar_tipo_producto(id_tipo_producto){
		$.ajax({
			type: "POST",
            url:"ajax_productos_filtrar_tipo_producto.php?rand=256",
            //data: { limit:val_limit, offset:val_offset },
            data: { id:id_tipo_producto },
            success:function(data){
            	console.log(data);
            	//$("#resultado_votos_detalle").html(data);
            	//$("#publicaciones_adicionales").html(data);
            	//$("#publicaciones_adicionales").append(data);
            	//$("#container").html(data);
            	$("#filtrar_tipo_producto").html(data);
            }
		});
	}
	function filtrar_tipo_productos(id_tipo_producto){
		$.ajax({
			type: "POST",
            url:"ajax_productos_filtrar_tipo_productos.php?rand=256",
            //data: { limit:val_limit, offset:val_offset },
            data: { id:id_tipo_producto },
            success:function(data){
            	console.log(data);
            	//$("#resultado_votos_detalle").html(data);
            	//$("#publicaciones_adicionales").html(data);
            	//$("#publicaciones_adicionales").append(data);
            	//$("#container").html(data);
            	$("#filtrar_tipo_productos").html(data);
            }
		});
	}
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

	
	
	<div id="fondo_especial" style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:101; background:black; opacity:.7; display:none;" onclick="$('#fondo_especial').hide('slow'); $('#banner_especial').hide('slow');">
		
	</div>
	<div id="banner_especial"  style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:102; display:none;">
		<div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
			<div style="width:80%; height:80%; background:white; overflow-y:scroll;">
				<div id="resultado_metodo_pago"></div>
				<div id="resultado_activar_metodo_pago">
					
				</div>
			</div>
		</div>
	</div>
	<!-- 
	<div id="banner_especial"  style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:102;">
		<div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
			<div style="width:80%; height:80%; background:white;">
				<div id="resultado_metodo_pago"></div>
			</div>
		</div>
	</div>
	-->
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
					url:"/iniciar_venta_agregar_producto.php",
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
		   function actualizar_precio_admin(valor, cantidad, id_producto){
				var valor_cantidad = valor * cantidad;
				//alert(valor_cantidad);

				$("#resultado_precio_administrador").html(valor_cantidad);

				$.ajax({
					type: "POST",
					//url:"/views_online/guardar_venta.php",
					url:"/actualizar_precio_administrador.php",
					//data: { limit:val_limit, offset:val_offset },
					//data: { id:id, id_ship:id_ship },
					data: { valor:valor, cantidad:cantidad, id_producto:id_producto },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						var id_input = "#resultado_precio_administrador" + id_producto;

						$(id_input).html(data);


						
					}
				});
		   }
		   function guardar_venta(){
			   var id = 0;
			   var id_ship = $("#ship_direction").val();

			   var id_cliente = $("#id_cliente").val();
			   var id_evento = $("#id_evento").val();
				  
			   
			   $.ajax({
					type: "POST",
					//url:"/views_online/guardar_venta.php",
					url:"/guardar_venta.php?rand=10",
					//data: { limit:val_limit, offset:val_offset },
					//data: { id:id, id_ship:id_ship },
					data: { id:id, id_ship:id_ship, id_cliente:id_cliente, id_evento:id_evento },
					success:function(data){
						console.log(data);
						$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');


						$("#resultado_metodo_pago").html(data);


						//var $link = $(this);
					    //var anchor  = $link.attr('href');
					    $('html, body').stop().animate({
					        //scrollTop: $(anchor).offset().top
					        //ancla_metodo_pago
					    	scrollTop: $("#ancla_metodo_pago").offset().top
					        //
					    }, 1000);
						/**

						ancla_metodo_pago

						
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
						*/

						//iniciar_venta.php

						
					}
				});
		   }



		   function filtrar_resultados_tabla(){


			   var id_marca = $("#id_marca").val();
			   var id_producto = $("#id_producto").val();
			   var id_talla = $("#id_talla").val();
			   var id_color = $("#id_color").val();
			   var id_genero = $("#id_genero").val();
			   var id_almacen =  $("#id_almacen").val();
			   var id_tipo_producto =  $("#id_tipo_producto").val();
			   var id_categoria =  $("#id_categoria").val();
			   
			   
			   $.ajax({
					type: "POST",
					url:"ajax_iniciar_venta_filtrar_tabla.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id_marca:id_marca, id_producto:id_producto, id_talla:id_talla, id_color:id_color, id_genero:id_genero, id_almacen:id_almacen, id_tipo_producto:id_tipo_producto, id_categoria:id_categoria },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						$("#resultado_filtrados").html(data);

						

						/**
						setTimeout(function (){

						}, 5000)
						*/
						DatatableBasic.init();

						$('#select_all').change(function() {
			    			var checkboxes = $(this).closest('form').find(':checkbox');
			    			checkboxes.prop('checked', $(this).is(':checked'));
			    		});
			    		
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
				/*
			   var id_marca = $("#id_marca").val();
			   var id_producto = $("#id_producto").val();
			   var id_talla = $("#id_talla").val();
			   var id_color = $("#id_color").val();
			   

			   $.ajax({
					type: "POST",
					url:"ajax_iniciar_venta_filtrar_tabla.php",
					//data: { limit:val_limit, offset:val_offset },
					data: { id_marca:id_marca, id_producto:id_producto, id_talla:id_talla, id_color:id_color },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						$("#resultado_filtrados").html(data);

						DatatableBasic.init();
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
				*/
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







		   function activar_metodo_pago(tipo_metodo_pago, id_venta_val){
				//alert(tipo_metodo_pago);
			   //var id_venta_val = $("#id_venta").val();
				//alert(id_venta_val);
			   $.ajax({
					type: "POST",
					//url:"/views_online/guardar_venta.php",
					url:"/activar_metodo_pago.php",
					//data: { limit:val_limit, offset:val_offset },
					//data: { id:id, id_ship:id_ship },
					data: { tipo_metodo_pago:tipo_metodo_pago, id_venta_val:id_venta_val },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						//alert(data);

						//$("#resultado_metodo_pago").html(data);
						//$("#resultado_activar_metodo_pago").html(data);
						//$("#resultado_activar_metodo_pago").append(data);
						//alert(data);
						$("#resultado_activar_metodo_pago").html(data);

						/**
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
						*/

						//iniciar_venta.php

						
					}
				});
		   }



		function guardar_pago_tarjeta(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			$.ajax({
				type: "POST",
				url:"/guardar_pago_tarjeta.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					//$("#resultado_activar_metodo_pago").append(data);
					$("#resultado_pago").html(data);
				}
			});
		}
		function guardar_pago_efectivo(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			$.ajax({
				type: "POST",
				url:"/guardar_pago_efectivo.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					$("#resultado_pago").html(data);
				}
			});
		}
		function guardar_pago_cortesia(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			$.ajax({
				type: "POST",
				url:"/guardar_pago_cortesia.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					$("#resultado_pago").html(data);
				}
			});
		}
		function guardar_pago_credito(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			
			$.ajax({
				type: "POST",
				url:"/guardar_pago_credito.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					$("#resultado_pago").html(data);
				}
			});
		}






		
	    function calcular_billetes_mil(cantidad){
	    	$('#resultado_billete_1000').val(cantidad * 1000);

		    actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_quinientos(cantidad){
	    	$('#resultado_billete_500').val(cantidad * 500);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_doscientos(cantidad){
		    $('#resultado_billete_200').val(cantidad * 200);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_cien(cantidad){
	    	$('#resultado_billete_100').val(cantidad * 100);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_cincuenta(cantidad){
	    	$('#resultado_billete_50').val(cantidad * 50);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_veinte(cantidad){
	    	$('#resultado_billete_20').val(cantidad * 20);

	    	actualizar_total_billetes();
	        
	    }
	    function actualizar_total_billetes(){
	    	var val_mil = parseInt($('#resultado_billete_1000').val());
	    	var val_quinientos = parseInt($('#resultado_billete_500').val());
	    	var val_doscientos = parseInt($('#resultado_billete_200').val());

	    	var val_cien = parseInt($('#resultado_billete_100').val());
	    	var val_cincuenta = parseInt($('#resultado_billete_50').val());
	    	var val_veinte = parseInt($('#resultado_billete_20').val());

	    	var val_total = val_mil + val_quinientos + val_doscientos + val_cien + val_cincuenta + val_veinte;

	    	//alert(val_total);

	    	$('#resultado_billetes').val(val_total);

	    	var monto_restante_mxn = parseFloat($('#monto_restante_mxn').val());
	    	var monto_restante_mxn = parseFloat($('#monto_restante_mxn').val());



	    	var cambio = monto_restante_mxn - val_total;

	    	if(cambio > 0){
	    		$('#resultado_cambio').val(0);

	    		
	    		$('#resultado_restante').val(cambio);


	    		$('#monto').val(val_total);
	    		

	    		
	    	}else{
	    		$('#resultado_cambio').val(cambio);

	    		$('#resultado_restante').val(0);


	    		$('#monto').val(monto_restante_mxn);

	    		
	    	}


	    	//$('#monto').val(val_total);
	    	
	    	
	    	
	    	
	    	
	    	
	    }
	    //resultado_cambio


	    function excentar_iva(){
	    	var excentar_iva = $("#excentar_iva").val();

	    
 			$(".resultado_excentar_iva").show();
 			$(".resultado_iva_normal").hide();

	    	alert("Excentar");
	    	alert(excentar_iva);
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
					<div>
					<style>
		             .select2-selection--single{
		             	height:34px !important;
		             }
		             .select2{
		             	height:34px !important;
		             }
		             .select2-search__field{
		             	padding-left:80px !important;
		             }
		           </style>
						<div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Cliente a vender:</div>
        						<?php 
        						$qry_cliente = "select * from ds_tbl_cliente where Activo = 1 order by Nombre, Apellido_Paterno asc";
        						$clientes = $obj->get_results($qry_cliente);
        						?>
        						
        						<select name="id_cliente" id="id_cliente" class="form-control">
        							<?php foreach ($clientes as $cliente): ?>
        							<option value="<?php echo $cliente->Id_Cliente; ?>"><?php echo $cliente->Nombre . " " . $cliente->Apellido_Paterno . " " . $cliente->Apellido_Materno; ?></option>
        							<?php endforeach; ?>
        						</select>
        						
        						<?php if($_GET["hector"] == true): ?>
        						<?php /**
        						<br /><br /><br />
        						<!-- Dropdown -->       
                                <select id='selUser' style='width: 200px;'>
                                    <option value='0'>-- Select User --</option>          
                                    <option value='1'>Yogesh singh</option>  
                                    <option value='2'>Sonarika Bhadoria</option>   
                                    <option value='3'>Anil Singh</option>        
                                    <option value='4'>Vishal Sahu</option>        
                                    <option value='5'>Mayank Patidar</option>        
                                    <option value='6'>Vijay Mourya</option>        
                                    <option value='7'>Rakesh sahu</option> 
                                </select>   
                        
                                <input type='button' value='Seleted option' id='but_read'>
                        
                                <br/>
                                <div id='result'></div>
                        */ ?>
                                <!-- Script -->
                                <script>
                                $(document).ready(function(){
                                    
                                    // Initialize select2
                                    //$("#selUser").select2();
                                	$("#id_cliente").select2();
                                    
                        /**
                                    // Read selected option
                                    $('#but_read').click(function(){
                                        var username = $('#selUser option:selected').text();
                                        var userid = $('#selUser').val();
                                   
                                        $('#result').html("id : " + userid + ", name : " + username);
                                    });
                                    */
                                });
                                </script>
        						<?php endif; ?>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Evento:</div>
                                <?php 
        						$qry_evento = "select * from ds_tbl_evento";
        						$eventos = $obj->get_results($qry_evento);
        						?>
                                <select name="id_evento" id="id_evento" class="form-control" <?php if($_GET["id_evento"]){ ?>readonly="readonly" disabled="disabled" <?php } ?>>
        							<?php /**
        							<option value="">Selecciona evento</option>
        							*/ ?>
        							<?php foreach ($eventos as $evento): ?>
        							<option value="<?php echo $evento->Id_Evento; ?>" <?php if($_GET["id_evento"] == $evento->Id_Evento){ ?>selected="selected"<?php } ?>><?php echo $evento->Descripcion; ?></option>
        							<?php endforeach; ?>
        						</select>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            	<div style="" class="contenedor_agregar_titulo">
                            		Tipo de producto
                            	</div>
                            	<select name="id_tipo_producto" id="id_tipo_producto" class="form-control" onchange="filtrar_tipo_productos(this.value); filtrar_resultados_tabla();">
                           			<option value="" >Selecciona</option>
                           			<?php foreach($tipos_producto as $tipo_producto): ?>
                           			<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>"><?php echo $tipo_producto->Descripcion; ?></option>
                           			<?php endforeach; ?>
                           		</select>
                            	<?php /**
            					<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" <?php if($resultado->Id_Tipo_Producto == $tipo_producto->Id_Tipo_Producto){ ?>selected="selected"<?php } ?>><?php echo $tipo_producto->Descripcion; ?></option>
                           			
            					<input type="text" placeholder="Tipo de producto" name="tipo_producto" id="tipo_producto" value="" class="form-control" />
            					*/ ?>
                            </div>
                            <div class="form-group col-md-6">
                           		<div style="" class="contenedor_agregar_titulo">
                            		Categoría producto
                            	
                            	</div>
                           		<div id="filtrar_tipo_productos">
                           			<select name="id_categoria" id="id_categoria" class="form-control">
                           				<option value="" >Selecciona</option>
                               			
                           				<?php /*
                               			<?php foreach($categorias_producto as $categoria_producto): ?>
                               			<option value="<?php echo $categoria_producto->Id_Categoria_Producto; ?>" <?php if($resultado->Id_Categoria_Producto == $categoria_producto->Id_Categoria_Producto){ ?>selected="selected"<?php } ?>><?php echo $categoria_producto->Descripcion; ?></option>
                               			<?php endforeach; ?>
                               			*/ ?>
                               		</select>
                           		</div>
                           		
            					<?php /**
            					<input type="text" placeholder="Categor&iacute;a" name="categoria" id="categoria" value="" class="form-control" />
            					*/ ?>
            					
            					
            					
                            </div>
                            
                        </div>
						<div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por marca:</div>
                                <?php 
        						$qry_marca = "select * from ds_cat_marca order by Descripcion asc";
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
                             	<div>Filtro por g&eacute;nero:</div>
                             	<div id="resultado_filtrado_marca_genero">
                                
                                    <?php 
            						$qry_genero = "select * from ds_cat_genero order by Descripcion asc";
            						$generos = $obj->get_results($qry_genero);
            						?>
            						<?php /**?>
                                    <select name="id_genero" id="id_genero" class="form-control" onchange="filtrar_marca_genero(this.value);">
                                    */ ?>
                                    <select name="id_genero" id="id_genero" class="form-control" onchange="filtrar_resultados_tabla();">
                                    	<option value="">Selecciona un g&eacute;nero</option>
            							<?php foreach ($generos as $genero): ?>
            							<option value="<?php echo $genero->Id_Genero; ?>"><?php echo $genero->Descripcion; ?></option>
            							<?php endforeach; ?>
            						</select>
            					</div>
                            </div>
						</div>
						<div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por producto:</div>
                             	<div id="resultado_filtrado_marca">
                                    <select name="id_producto" id="id_producto" class="form-control" onchange="filtrar_resultados_tabla()">
            							<option value="">Seleccionar</option>
            							<?php foreach($productos as $producto): ?>
            							<option value="<?php echo $producto->Nombre; ?>"><?php echo $producto->Nombre; ?></option>
            							<?php endforeach; ?>
            							
            						</select>
        						</div>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Filtro por almacen:</div>
                             	<div id="resultado_filtrado_marca">
                                    <select name="id_almacen" id="id_almacen" class="form-control" onchange="filtrar_resultados_tabla()">
            							<option value="">Seleccionar</option>
            							<?php foreach($almacenes as $almacen): ?>
            							<option value="<?php echo $almacen->Id_Tipo_Almacen; ?>"><?php echo $almacen->Descripcion; ?></option>
            							<?php endforeach; ?>
            						</select>
        						</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por talla:</div>
                             	<div id="resultado_filtrado_producto">
                             		<?php 
            						$qry_tallas = "select * from ds_cat_talla order by Descripcion asc";
            						$tallas = $obj->get_results($qry_tallas);
            						?>
                                    <select name="id_talla" id="id_talla" class="form-control" onchange="filtrar_resultados_tabla()">
            							<option value="">Seleccionar</option>
            							<?php foreach($tallas as $talla): ?>
            							<option value="<?php echo $talla->Id_Talla; ?>"><?php echo $talla->Descripcion; ?></option>
            							<?php endforeach; ?>
            							
            						</select>
        						</div>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Filtro por color:</div>
                                <div id="resultado_filtrado_talla">
                                    <select name="id_color" id="id_color" class="form-control" onchange="filtrar_resultados_tabla()">
            							<option value="">Seleccionar</option>
            							<?php 
                						$qry_colores = "select * from ds_cat_color order by Descripcion asc";
                						$colores = $obj->get_results($qry_colores);
                						?>
                                    	<option value="">Seleccionar</option>
            							<?php foreach($colores as $color): ?>
            							<option value="<?php echo $color->Id_Color; ?>"><?php echo $color->Descripcion; ?></option>
            							<?php endforeach; ?>
            						</select>
        						</div>
                            </div>
                        </div>
                        <?php /**
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por marca:</div>
                                <?php 
        						$qry_marca = "select * from ds_cat_marca order by Descripcion asc";
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
            							<option value="">Seleccionar</option>
            						</select>
        						</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	<div>Filtro por talla:</div>
                             	<div id="resultado_filtrado_producto">
                                    <select name="" id="" class="form-control">
            							<option value="">Seleccionar</option>
            						</select>
        						</div>
                            </div>
                            <div class="form-group col-md-6">
                             	<div>Filtro por color:</div>
                                <div id="resultado_filtrado_talla">
                                    <select name="" id="" class="form-control">
            							<option value="">Seleccionar</option>
            						</select>
        						</div>
                            </div>
                        </div>
                        	*/ ?>					
					</div>

					<div id="resultado_filtrados" style="width:100%; overflow-x:scroll;">

    					<table class="table datatable-basic">
    						<thead>
    							<tr>
    								<th>C&oacute;digo barras</th>
    								
    								<th>Producto</th>
    								<th>Marca</th>
    								<th>Color</th>
    								<th>&nbsp;</th>
    								<th>Talla</th>
    								<th>Inventario</th>
    								
    								<th>Precio MXN</th>
    								<th>USD</th>
    								<th>Agregar</th>
    								
    							</tr>
    						</thead>
    						<tbody>
    
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
    								<td><?php echo $resultado->Codigo_Barras; ?></td>
    								
    								<td><?php echo $nombre; ?></td>
    								<td><?php echo $resultado->marca; ?></td>
    								
    								<td><?php echo $resultado->color; ?></td>
                        			<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div></td>
                    				<td><?php echo $resultado->talla; ?></td>
    								<td><?php echo $resultado->Cantidad_Inventario; ?><?php //print_r($resultado); ?></td>
    								
    								<td><?php echo $resultado->Costo_Venta; ?></td>
    								
    								<td><?php echo $resultado->Dolar; ?></td>
    								<td><a onclick="agregar_producto('<?php echo $id_resultado; ?>')"><i class="icon-checkmark2"></i></a></td>
    
    								<?php /**
    								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div><br /><?php echo $resultado->color; ?><br /><?php echo $resultado->Codigo_Hexadecimal; ?></td>
    								
    								<td><?php echo $hexadecimal; ?></td>
    								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $color->Codigo_Hexadecimal; ?>"></div> <?php echo $color->Codigo_Hexadecimal; ?></td>
    								
    								<td class="text-center">
    									<div class="list-icons">
    										<div class="dropdown">
    											<a href="#" class="list-icons-item" data-toggle="dropdown">
    												<i class="icon-menu9"></i>
    											</a>
    
    											<div class="dropdown-menu dropdown-menu-right">
    												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Eliminar</a>
    												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
    												
    											</div>
    										</div>
    									</div>
    								</td>
    								*/ ?>
    								
    								
    							</tr>
    							<?php //endfor; ?>
    							<?php endforeach; ?>
    
    						</tbody>
    					</table>
    				</div>
					
					<div id="resultado_venta">
						&nbsp;
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