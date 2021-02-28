<?php include("includes/includes.php"); ?>
<?php 
include("common_files/sesion.php");
$id_rol = $_SESSION["rol"];
?>
<?php 
$nombre_seccion = "Productos";
$tbl_main = "ds_tbl_producto";
$nombre_simple = "producto";
$url_name = "productos.php";
$url_crear_name = "crear_producto.php";
?>
<?php 
$val_nombre = $_POST["nombre_producto"];

$val_codigo_barras = $_POST["codigo_barras"];
$val_descripcion = $_POST["Descripcion"];
$val_sustancia_producto = $_POST["sustancia_producto"];
$val_marca = $_POST["marca"];
$val_tipo_producto = $_POST["tipo_producto"];
$val_categoria = $_POST["categoria"];
$val_talla = $_POST["talla"];
$val_genero = $_POST["genero"];
$val_tipo_mercado = $_POST["tipo_mercado"];
$val_color = $_POST["color"];
$val_cantidad_minima = $_POST["cantidad_minima"];
$val_cantidad_maxima = $_POST["cantidad_maxima"];
$val_precio_venta = $_POST["precio_venta"];
//$val_Imagen_Producto = $_POST["Imagen_Producto"];
$val_imagen_producto = $_POST["imagen_producto"];

$val_fecha_alta = date("Y-m-d H:i:s");
$cantidad_inventario = $_POST["cantidad_inventario"];

$divisas = $obj->get_results("select * from ds_cat_tipo_cambio");
$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");
$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");
$almacenes = $obj->get_results("select * from ds_cat_tipo_almacen order by Descripcion asc");
//$productos = $obj->get_results("select * from ds_tbl_producto order by Nombre asc");
$productos = $obj->get_results("select * from ds_tbl_producto group by Nombre order by Nombre asc");

if($_POST["nombre_producto"] != ""){
    
    /**
    $prefix_fecha = date("YmdHis") . $i . "_";
    //$destino = '../../../images/blog';
    $destino = 'images/blog';
    
    copy($_FILES['blogfoto']['tmp_name'][$i], $destino . '/' . $prefix_fecha . $_FILES['blogfoto']['name'][$i]);
    
    //$_POST["proyectologo"] = $_FILES['proyectologo']['name'][$i];
    $_POST["blogfoto"] = $prefix_fecha . $_FILES['blogfoto']['name'][$i];
    $_POST["imagen"] = $prefix_fecha . $_FILES['blogfoto']['name'][$i];
    */
    
    
    $qry_insert = "insert into ds_tbl_producto (Nombre, Descripcion, Fecha_Alta, Id_Marca, Id_Tipo_Producto, Id_Tipo_Sustancia, Id_Categoria_Producto, Activo) values ('{$val_nombre}', '{$val_descripcion}', '{$val_fecha_alta}', {$val_marca}, {$val_tipo_producto}, {$val_sustancia_producto}, {$val_categoria}, 1)";
    //echo $qry_insert;
    
    $obj->query($qry_insert);
    
    $qry_resultado = "select * from ds_tbl_producto where Nombre = '{$val_nombre}' and Descripcion = '{$val_descripcion}' and Fecha_Alta = '{$val_fecha_alta}' and Id_Categoria_Producto = {$val_categoria} limit 1";
    $resultado = $obj->get_row($qry_resultado);
    
    //echo $qry_resultado;
    
    $id_producto = $resultado->Id_Producto;
    
    //$qry_insert_detalle = "insert into (Codigo_Barras, Id_Talla, Id_Color, Id_Producto, Id_Tipo_Mercado, Id_Genero) values ('{$val_codigo_barras}', {$val_talla}, {$val_color}, {$id_producto}, {$val_tipo_mercado}, {$val_genero})";
    $qry_insert_detalle = "insert into ds_tbl_producto_detalle (Codigo_Barras, Id_Talla, Id_Color, Id_Producto, Id_Tipo_Mercado, Id_Genero, Activo) values ('{$val_codigo_barras}', {$val_talla}, {$val_color}, {$id_producto}, {$val_tipo_mercado}, {$val_genero}, 1)";
    
    $obj->query($qry_insert_detalle);
    
    //echo "FILES";
    //print_r($_FILES);
    
    if($_FILES["imagen_producto"]['name'] != ""){
        
        
        $prefix_fecha = date("YmdHis") . "_";
        //$destino = '../../../images/blog';
        $destino = 'images/productos';
        
        $name_imagen_url = $prefix_fecha . $_FILES['imagen_producto']['name'];
        
        //copy($_FILES['blogfoto']['tmp_name'][$i], $destino . '/' . $prefix_fecha . $_FILES['blogfoto']['name'][$i]);
        copy($_FILES['imagen_producto']['tmp_name'], $destino . '/' . $name_imagen_url);
        
        
        $qry_last_id_producto_imagen = "select * from ds_tbl_producto_imagen order by Id_Producto_Imagen desc";
        $last_id_producto_imagen = $obj->get_row($qry_last_id_producto_imagen);
        
        $last_id_producto_imagen_val = $last_id_producto_imagen->Id_Producto_Imagen + 1;
        
        
        //$qry_insert_imagen = "insert into ds_tbl_producto_imagen (Id_Producto, Url_Imagen) values ($id_producto, '$name_imagen_url')";
        //$qry_insert_imagen = "insert into ds_tbl_producto_imagen (Id_Producto, Url_Imagen) values ($id_producto, '$name_imagen_url')";
        $qry_insert_imagen = "insert into ds_tbl_producto_imagen (Id_Producto_Imagen, Id_Producto, Url_Imagen) values ($last_id_producto_imagen_val, $id_producto, '$name_imagen_url')";
        
        //echo $qry_insert_imagen;
        
        $obj->query($qry_insert_imagen);
        
        
    }
    
    $prefix_fecha = date("YmdHis") . $i . "_";
    //$destino = '../../../images/blog';
    $destino = 'images/blog';
    
    copy($_FILES['blogfoto']['tmp_name'][$i], $destino . '/' . $prefix_fecha . $_FILES['blogfoto']['name'][$i]);
    
    $_POST["blogfoto"] = $prefix_fecha . $_FILES['blogfoto']['name'][$i];
    $_POST["imagen"] = $prefix_fecha . $_FILES['blogfoto']['name'][$i];
    
    $qry_resultado_detalle = "select * from ds_tbl_producto_detalle where Codigo_Barras = '{$val_codigo_barras}' and Id_Producto = {$id_producto} and Id_Genero = {$val_genero} and Id_Tipo_Mercado = {$val_tipo_mercado} limit 1";
    $resultado_detalle = $obj->get_row($qry_resultado_detalle);
    
    $id_producto_detalle = $resultado_detalle->Id_Producto_Detalle;
    
    $qry_insert_detalle_precio_venta = "insert into ds_tbl_precio_venta_producto (Id_Producto_Detalle, Costo_Venta) values ({$id_producto_detalle}, '{$val_precio_venta}')";
    $obj->query($qry_insert_detalle_precio_venta);
    
    //$qry_insert_detalle_cantidad_producto = "insert into ds_tbl_cantidad_minima_producto (Id_Producto_Detalle, Cantidad_Minima, Cantidad_Maxima) values ({$id_producto_detalle}, {$val_cantidad_minima}, {$val_cantidad_maxima})";
    $qry_insert_detalle_cantidad_producto = "insert into ds_tbl_cantidad_minima_producto (Id_Producto_Detalle, Cantidad_Minima, Cantidad_Maxima, Activo, Fecha_alta, Fecha_Actualiza) values ({$id_producto_detalle}, {$val_cantidad_minima}, {$val_cantidad_maxima}, 1, '{$val_fecha_alta}', '{$val_fecha_alta}')";
    $obj->query($qry_insert_detalle_cantidad_producto);
    
    
    $qry_resultado_detalle_cantidad_producto = "select * from ds_tbl_cantidad_minima_producto where Id_Producto_Detalle = {$id_producto_detalle} and Fecha_alta = '{$val_fecha_alta}' limit 1";
    $resultado_detalle_cantidad_producto = $obj->get_row($qry_resultado_detalle_cantidad_producto);
    
    $id_cantidad_producto = $resultado_detalle_cantidad_producto->Id_Cantidad_Producto;
    
    $qry_insert_detalle_inventario_almacen = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Cantidad_Inventario, Id_Cantidad_Producto, Fecha_Actualizacion) values ({$id_producto_detalle}, {$cantidad_inventario}, {$id_cantidad_producto}, '{$val_fecha_alta}')";
    $obj->query($qry_insert_detalle_cantidad_producto);
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
    		$('#select_all').change(function() {
    			var checkboxes = $(this).closest('form').find(':checkbox');
    			checkboxes.prop('checked', $(this).is(':checked'));
    		});
		});

		

		function Eliminar(t_id,t_completo){
			//alert("Eliminar; "+t_id);

			var r = confirm("Estás seguro que deseas eliminar el producto: "+t_completo);
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
				data: { page:val_page, categoria:val_categoria },
				success:function(data){
					console.log(data);
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


		function limpiar_filtros(){
			var id_marca = $("#id_marca").val("");
			   var id_producto = $("#id_producto").val("");
			   var id_talla = $("#id_talla").val("");
			   var id_color = $("#id_color").val("");
			   var id_genero = $("#id_genero").val("");
			   var id_almacen =  $("#id_almacen").val("");
			   var id_tipo_producto =  $("#id_tipo_producto").val("");
			   var id_categoria =  $("#id_categoria").val("");
			   
			filtrar_resultados_tabla();
		}
		function filtrar_resultados_productos_tabla(){
			
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
					url:"ajax_productos_filtrar_tabla.php",
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
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();
					}
				});
				
			   //filtrar_marca
		   }


		function actualizar_producto(){
			var id_producto = $("#id_producto").val();
			
			actualizar_marca(id_producto);
		}
		function actualizar_marca(id_producto){
			$.ajax({
				type: "POST",
				url:"ajax_obtener_marca_por_producto.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { id_producto:id_producto },
				success:function(data){

					//$("#id_marca")
					$("#id_marca").html(data);
				}
			});
		}
		
		
		function obtener_generos_marcas(){
			var id_marca = $("#id_marca").val();
			$.ajax({
				type: "POST",
				url:"ajax_obtener_generos_marca.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { id_marca:id_marca },
				success:function(data){
					console.log(data);
					//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

					$("#resultado_filtrado_marca_genero").html(data);

					//$("#form_venta").html(data);
					//$(".select_refresh").formSelect();

					
				}
			});
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

						obtener_generos_marcas();
						
						filtrar_resultados_tabla();
						//$("#form_venta").html(data);
						//$(".select_refresh").formSelect();

						
					}
				});
			   //filtrar_marca
		   }

		   
		   
		   function filtrar_marca_genero(id_genero){
			   //var id_genero = $("#id_genero").va();
			   var id = $("#id_marca").val();
			   //alert(id);
			   //alert(id_genero);
			   if(id_genero == ""){

			   }else{

			
    			   $.ajax({
    					type: "POST",
    					url:"ajax_iniciar_venta_filtrar_marca_genero.php",
    					//data: { limit:val_limit, offset:val_offset },
    					data: { id:id, id_genero:id_genero },
    					success:function(data){
    						console.log(data);
    						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');
    
    						$("#resultado_filtrado_marca").html(data);
    
    						filtrar_resultados_tabla();
    						//$("#form_venta").html(data);
    						//$(".select_refresh").formSelect();
    					}
    				});

			   }
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

		/**FORM CREAR*/
		function filtrar_tipo_producto(id_tipo_producto){
			$.ajax({
				type: "POST",
                url:"ajax_productos_filtrar_tipo_producto.php",
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
		/* PARA LOS FILTRADOS */
		function filtrar_tipo_productos(id_tipo_producto){
			$.ajax({
				type: "POST",
                url:"ajax_productos_filtrar_tipo_productos.php",
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
		function guardar_sustancia(){
			var descripcion_val = $("#descripcion_sustancia").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_sustancia.php",
                data: { descripcion:descripcion_val },
                success:function(data){
                	console.log(data);
                	$("#sustancia_producto").html(data);
                	$("#descripcion_sustancia").val("");
                	$("#contenedor_agregar_sustancia").slideUp("slow");
                }
			});
		}
		function guardar_marca(){
			var descripcion_val = $("#descripcion_marca").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_marca.php",
                data: { descripcion:descripcion_val },
                success:function(data){
                	console.log(data);
                	$("#marca").html(data);
                	$("#descripcion_marca").val("");
                	$("#contenedor_agregar_marca").slideUp("slow");
                }
			});
		}
		function guardar_tipo_producto(){
			var descripcion_val = $("#descripcion_tipo_producto").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_tipo_producto.php",
                data: { descripcion:descripcion_val },
                success:function(data){
                	console.log(data);
                	$("#tipo_producto").html(data);

                	$("#descripcion_tipo_producto").val("");

                	$("#contenedor_agregar_tipo_producto").slideUp("slow");
                }
			});
		}
		function guardar_categoria_producto(){
			var descripcion_val = $("#descripcion_categoria_producto").val();
			var tipo_producto_select_val = $("#tipo_producto_select").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_categoria.php",
                data: { descripcion:descripcion_val, tipo_producto:tipo_producto_select_val },
                success:function(data){
                	console.log(data);
                	$("#categoria").html(data);

                	$("#descripcion_categoria_producto").val("");

                	$("#contenedor_agregar_categoria_producto").slideUp("slow");
                }
			});
		}
		function guardar_talla(){
			var descripcion_val = $("#descripcion_talla").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_talla.php",
                data: { descripcion:descripcion_val },
                success:function(data){
                	console.log(data);
                	$("#talla").html(data);
                	$("#descripcion_talla").val("");
                	$("#contenedor_agregar_talla").slideUp("slow");
                }
			});
		}
		function guardar_genero(){
			var descripcion_val = $("#descripcion_genero").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_genero.php",
                data: { descripcion:descripcion_val },
                success:function(data){
                	console.log(data);
                	$("#genero").html(data);

                	$("#descripcion_genero").val("");

                	$("#contenedor_agregar_genero").slideUp("slow");
                }
			});
		}
		function guardar_tipo_mercado(){
			var descripcion_val = $("#descripcion_tipo_mercado").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_tipo_mercado.php",
                data: { descripcion:descripcion_val },
                success:function(data){
                	console.log(data);
                	$("#tipo_mercado").html(data);

                	$("#descripcion_tipo_mercado").val("");

                	$("#contenedor_agregar_tipo_mercado").slideUp("slow");
                }
			});
		}
		function guardar_color(){
			var descripcion_val = $("#descripcion_color").val();
			$.ajax({
				type: "POST",
                url:"ajax_guardar_color.php",
                data: { descripcion:descripcion_val },
                success:function(data){
                	console.log(data);
                	$("#color").html(data);

                	$("#descripcion_color").val("");

                	$("#contenedor_agregar_color").slideUp("slow");
                }
			});
		}

		
		function actualizar_costo(costo, id){
			var contenedor_input = "#contenedor_resultado_input" + id;
			   var id_input = "#resultado_input" + id;


			   var select_divisa_val = "#select_divisa_costo" + id;
			   
			   var select_divisa = $(select_divisa_val).val();
			   
			   
			   var id_input_alternativo = "#input_alternativo" + id;
			   

			   //var contenedor_dolar = "#contenedor_dolar" + id;
			   
			   
			   $.ajax({
					type: "POST",
					url:"actualizar_costo_compra.php?rand=255",
					data: { costo:costo, id:id, divisa:select_divisa },
					success:function(data){
						console.log(data);
						$(id_input_alternativo).hide();
						
						$(id_input).show();
						$(contenedor_input).html(data);
						//mostrar_valor_dolar(id);

						//$(contenedor_dolar).html(data);

						
						//$("#popup_resultado").html(data);
						
					}
				});
		   }

		function actualizar_precio(precio, id){
			var contenedor_input = "#contenedor_resultado_input_precio" + id;
			   var id_input = "#resultado_input_precio" + id;
			   var select_divisa_val = "#select_divisa_precio" + id;
			   var select_divisa = $(select_divisa_val).val();
			   var id_input_alternativo = "#input_alternativo_precio" + id;
			   //var contenedor_dolar = "#contenedor_dolar" + id;
			   $.ajax({
					type: "POST",
					url:"actualizar_precio_venta.php?rand=255",
					data: { precio:precio, id:id, divisa:select_divisa },
					success:function(data){
						console.log(data);
						$(id_input_alternativo).hide();
						$(id_input).show();
						//$(id_input).html(data);
						$(contenedor_input).html(data);
						//mostrar_valor_dolar(id);
						//$(contenedor_dolar).html(data);
						//$("#popup_resultado").html(data);
					}
				});
		   }


		function actualizar_existencia(existencia, id){
			   var id_input = "#resultado_input_existencia" + id;
			   var id_input_alternativo = "#input_alternativo_existencia" + id;
			   //var contenedor_dolar = "#contenedor_dolar" + id;
			   $.ajax({
					type: "POST",
					url:"actualizar_existencia.php",
					data: { existencia:existencia, id:id },
					success:function(data){
						console.log(data);
						$(id_input_alternativo).hide();
						$(id_input).show();
						$(id_input).html(data);
						//mostrar_valor_dolar(id);
						//$(contenedor_dolar).html(data);
						//$("#popup_resultado").html(data);
					}
				});
		   }

		function actualizar_cantidad_minima(existencia, id){
			   var id_input = "#resultado_input_cantidad_minima" + id;
			   var id_input_alternativo = "#input_alternativo_cantidad_minima" + id;
			   //var contenedor_dolar = "#contenedor_dolar" + id;
			   $.ajax({
					type: "POST",
					url:"actualizar_cantidad_minima.php",
					data: { existencia:existencia, id:id },
					success:function(data){
						console.log(data);
						$(id_input_alternativo).hide();
						$(id_input).show();
						$(id_input).html(data);
						//mostrar_valor_dolar(id);
						//$(contenedor_dolar).html(data);
						//$("#popup_resultado").html(data);
					}
				});
		   }
		function actualizar_cantidad_maxima(existencia, id){
			   var id_input = "#resultado_input_cantidad_maxima" + id;
			   var id_input_alternativo = "#input_alternativo_cantidad_maxima" + id;
			   //var contenedor_dolar = "#contenedor_dolar" + id;
			   $.ajax({
					type: "POST",
					url:"actualizar_cantidad_maxima.php",
					data: { existencia:existencia, id:id },
					success:function(data){
						console.log(data);
						$(id_input_alternativo).hide();
						$(id_input).show();
						$(id_input).html(data);
						//mostrar_valor_dolar(id);
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



	   function detalle_precio_masivo(id){
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
	   function detalle_costo_masivo(id){
			$("#container_popup_fondo").show();
			$("#container_popup").show();

			var form = $('#form_table').serialize()
			
			   $.ajax({
					type: "POST",
					url:"popup_asignar_costo_compra_masivo.php",
					data: { id:id, form:form },
					success:function(data){
						console.log(data);
						$("#popup_resultado").html(data);

					}
				});
	   }
	   function funciones_masivas(id_funcion){
			if(id_funcion == 1){
				detalle_costo_masivo();
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
					<div>
						
            
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            	<div style="" class="contenedor_agregar_titulo">
                            		Tipo de producto
                            	</div>
                            	<select name="id_tipo_producto" id="id_tipo_producto" class="form-control" onchange="filtrar_tipo_productos(this.value); filtrar_resultados_tabla();">
                           			<option value="" >Selecciona</option>
                           			<?php foreach($tipos_producto as $tipo_producto): ?>
                           			<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" <?php if($resultado->Id_Tipo_Producto == $tipo_producto->Id_Tipo_Producto){ ?>selected="selected"<?php } ?>><?php echo $tipo_producto->Descripcion; ?></option>
                           			<?php endforeach; ?>
                           		</select>
                            	<?php /**
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
                        
                        
                        
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	&nbsp;
                            </div>
                            <div class="form-group col-md-6">
                             	<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="limpiar_filtros();">Limpiar Filtros</button>
                            </div>
                        </div>
                        
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                             	Funciones masivas
                            </div>
                            <div class="form-group col-md-4">
                             	<select onchange="funciones_masivas(this.value);" id="funcion_masiva" class="form-control">
                             		<option value="">Selecciona</option>
                             		<option value="1">Asignar costo masivo</option>
                             	</select>
                            </div>
                            <div class="form-group col-md-2">
                            	<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="funciones_masivas($('#funcion_masiva').val());">Seleccionar</button>
                            </div>
                        </div>
                        
                        
					</div>
					<div id="resultado_filtrados" style="width:100%; overflow-x:scroll;">
						<form id="form_table">
    					<table class="table datatable-basic">
    						<thead>
    							<tr>
    								<td><input type="checkbox" id="select_all" /></td>
			
    								<th>C&oacute;digo de Barras</th>
    								<th>Imagen</th>
    								<th>Nombre</th>
    								<th>Tipo de producto</th>
    								<th>Categor&iacute;a de producto</th>
    								<th>Marca</th>
    								<th>Color</th>
    								<th>Talla</th>
    								<th>Cantidad M&iacute;nima</th>
    								<th>Cantidad M&aacute;xima</th>
    								
    								<th>Existencias</th>
    								<th>Almac&eacute;n</th>
    								<?php if($id_rol == 1 || $id_rol == 4 || $id_rol == 5): ?>
    								<th>Costo</th>
    								<?php endif; ?>
    								<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 5): ?>
    								<th>Precio</th>
    								<?php endif; ?>
    								<th class="text-center">Acciones</th>
    							</tr>
    						</thead>
    						<tbody>
    							<?php 
    							//left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
    							//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto order by $tbl_main.Descripcion asc";
    							//left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    							//left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    							//left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
    							//ds_tbl_cantidad_minima_producto
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    							//ds_tbl_cantidad_minima_producto
    							//
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    							//left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen
    							//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen order by $tbl_main.Descripcion asc";
    							//left join ds_cat_categoria_producto on ds_cat_categoria_producto.Id_Categoria_Producto = ds_tbl_producto.Id_Categoria_Producto
    							$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen, ds_cat_categoria_producto.Descripcion as categoria from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen left join ds_cat_categoria_producto on ds_cat_categoria_producto.Id_Categoria_Producto = ds_tbl_producto.Id_Categoria_Producto order by $tbl_main.Descripcion asc";
    							//
    							$resultados = $obj->get_results($qry_resultados);
    						?>
    						<?php foreach($resultados as $resultado): ?>
    							<?php 
    							$id_resultado=$resultado->Id_Producto;
    							$nombre=$resultado->Nombre;
    							?>
    							<tr id="element<?php echo $id_resultado; ?>">
    								<td><input type="checkbox" name="checkbox<?php echo $id_resultado; ?>" id="checkbox<?php echo $id_resultado; ?>" /></td>
			
    								<td><?php echo $resultado->Codigo_Barras; ?></td>
                                    <?php 
                                    $qry_producto_imagen = "select * from ds_tbl_producto_imagen where Id_Producto = $id_resultado order by Id_Producto_Imagen desc limit 1";
                                    $resultado_imagen_val = $obj->get_row($qry_producto_imagen);
                                    ?>
    								<?php /**
    								<td><?php if($resultado->Imagen_Producto != ""): ?><img src="images/productos/<?php echo $resultado->Imagen_Producto; ?>" style="max-height:50px; max-width:100px;" /><?php endif; ?></td>
    								*/ ?>
    								<td><?php if($resultado_imagen_val->Url_Imagen != ""): ?><img src="images/productos/<?php echo $resultado_imagen_val->Url_Imagen; ?>" style="max-height:50px; max-width:100px;" /><?php endif; ?></td>
    								<td><?php echo $nombre; ?></td>
    								<td><?php echo $resultado->tipo_producto; ?></td>
    								<td><?php echo $resultado->categoria; ?></td>
    								<td><?php echo $resultado->marca; ?></td>
    								<?php /**
    								<td><?php echo $resultado->color; ?> <?php echo $resultado->Codigo_Hexadecimal; ?><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $resultado->Codigo_Hexadecimal; ?>"></div></td>
    								*/ ?>
    								<td><?php echo $resultado->color; ?></td>
    								<td><?php echo $resultado->talla; ?></td>
    								
    								<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 4 || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
									<td style="text-align:center;" id="contenedor_resultado_input_cantidad_minima<?php echo $id_resultado; ?>"><div id="resultado_input_cantidad_minima<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_cantidad_minima<?php echo $id_resultado; ?>').show(); $('#input_cantidad_minima<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Cantidad_Minima != ""){ $res_pintar = $resultado->Cantidad_Minima; }else{ $res_pintar = "Introduce su cantidad m&iacute;nima"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo_cantidad_minima<?php echo $id_resultado; ?>" ><input type="text" id="input_cantidad_minima<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Cantidad_Minima; ?>" onblur="actualizar_cantidad_minima(this.value, <?php echo $id_resultado; ?>);" style="width:55px;" /></div></td>
    								<?php /**
									<td><div id="resultado_input_existencia<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_existencia<?php echo $id_resultado; ?>').show(); $('#input_existencia<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Cantidad_Inventario != ""){ $res_pintar = $resultado->Cantidad_Inventario; }else{ $res_pintar = "Introduce su existencia"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo_existencia<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Cantidad_Inventario; ?>" onblur="actualizar_existencia(this.value, <?php echo $id_resultado; ?>);" /></div></td>
    								<td><?php echo $resultado->Cantidad_Minima; ?></td>
    								*/ ?>
    								<?php endif; ?>
    								<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 4 || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
									<td style="text-align:center;" id="contenedor_resultado_input_cantidad_maxima<?php echo $id_resultado; ?>"><div id="resultado_input_cantidad_maxima<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_cantidad_maxima<?php echo $id_resultado; ?>').show(); $('#input_cantidad_maxima<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Cantidad_Maxima != ""){ $res_pintar = $resultado->Cantidad_Maxima; }else{ $res_pintar = "Introduce su cantidad m&aacute;xima"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo_cantidad_maxima<?php echo $id_resultado; ?>" ><input type="text" id="input_cantidad_maxima<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Cantidad_Maxima; ?>" onblur="actualizar_cantidad_maxima(this.value, <?php echo $id_resultado; ?>);" style="width:55px;" /></div></td>
    								<?php /**
    								<td><?php echo $resultado->Cantidad_Maxima; ?></td>
    								*/ ?>
    								<?php endif; ?>
    								
    								<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 4 || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
									<td style="text-align:center;" id="contenedor_resultado_input_existencia<?php echo $id_resultado; ?>"><div id="resultado_input_existencia<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_existencia<?php echo $id_resultado; ?>').show(); $('#input_existencia<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Cantidad_Inventario != ""){ $res_pintar = $resultado->Cantidad_Inventario; }else{ $res_pintar = "Introduce su existencia"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo_existencia<?php echo $id_resultado; ?>" ><input type="text" id="input_existencia<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Cantidad_Inventario; ?>" onblur="actualizar_existencia(this.value, <?php echo $id_resultado; ?>);" style="width:55px;" /></div></td>
    								<td><?php echo $resultado->almacen; ?></td>
    								<?php endif; ?>
    								
    								
    								<?php /**
    								<td><?php echo $resultado->Cantidad_Inventario; ?><?php //print_r($resultado); ?></td>
    								<td><?php echo $resultado->Costo_Compra; ?></td>
    								
    								<td style="text-align:right;"><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = "$" . number_format($resultado->Costo_Compra, 2); }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" style=" width:55px;" /></div></td>
    								<td style="text-align:right;"><div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Venta != ""){ $res_pintar_precio = "$" . number_format($resultado->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Venta; ?>" onblur="actualizar_precio(this.value, <?php echo $id_resultado; ?>);" style=" width:55px;" /></div></td>
    								
    								<td style="text-align:right;" id="contenedor_resultado_input<?php echo $id_resultado; ?>"><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = "$" . number_format($resultado->Costo_Compra, 2); }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><select name="select_divisa_costo<?php echo $id_resultado; ?>" id="select_divisa_costo<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" style="width:55px;" /><input type="button" onclick="actualizar_costo($('#input<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);" value="Guardar" /></div></td>
    								
    								*/?>
    								<?php if($id_rol == 1 || $id_rol == 4 || $id_rol == 5): ?>
    								<td style="text-align:right;" id="contenedor_resultado_input<?php echo $id_resultado; ?>"><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = "$" . number_format($resultado->Costo_Compra, 2); }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none; width:170px;" id="input_alternativo<?php echo $id_resultado; ?>" ><select name="select_divisa_costo<?php echo $id_resultado; ?>" id="select_divisa_costo<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" style="width:55px; margin:0 5px;" /><span><i class="icon-checkmark4 mr-3 icon-1x" onclick="actualizar_costo($('#input<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);"></i></span></div></td>
    								
    								<?php endif; ?>
    								<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 5): ?>
						
									<td style="text-align:right;" id="contenedor_resultado_input_precio<?php echo $id_resultado; ?>"><div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Venta != ""){ $res_pintar_precio = "$" . number_format($resultado->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none; width:170px;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><select name="select_divisa_precio<?php echo $id_resultado; ?>" id="select_divisa_precio<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input_precio<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Venta; ?>" style="width:55px; margin:0 5px;" /><i class="icon-checkmark4 mr-3 icon-1x" onclick="actualizar_precio($('#input_precio<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);"></i></div></td>
    								
    								
									<?php /**
    								<td style="text-align:right;" id="contenedor_resultado_input_precio<?php echo $id_resultado; ?>"><div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Venta != ""){ $res_pintar_precio = "$" . number_format($resultado->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none; width:170px;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><select name="select_divisa_precio<?php echo $id_resultado; ?>" id="select_divisa_precio<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input_precio<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Venta; ?>" style="width:55px; margin:0 5px;" /><input type="button" onclick="actualizar_precio($('#input_precio<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);" value="Guardar" /><i class="icon-checkmark4 mr-3 icon-1x" onclick="actualizar_precio($('#input_precio<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);"></i></div></td>
    								<td><?php echo $resultado->Costo_Venta; ?></td>
    								*/ ?>
    								<?php endif; ?>
    								<td class="text-center">
    									<div class="list-icons">
    										<div class="dropdown">
    											<a href="#" class="list-icons-item" data-toggle="dropdown">
    												<i class="icon-menu9"></i>
    											</a>
    											<div class="dropdown-menu dropdown-menu-right">
    												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $nombre; ?>');"><i class="icon-bin"></i> Eliminar</a>
    												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
    												<?php /**
    												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
    												*/ ?>
    											</div>
    										</div>
    									</div>
    								</td>
    							</tr>
    							<?php endforeach; ?>
    						</tbody>
    					</table>
    					</form>
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