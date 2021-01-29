<?php include("includes/includes.php"); ?>
<?php 
$nombre_seccion = "Reporte de inventario";
$tbl_main = "ds_tbl_producto";
$nombre_simple = "producto";
$url_name = "productos.php";
$url_crear_name = "crear_producto.php";
?>
<?php 

//	Id_Producto	Nombre	Descripcion	Imagen_Producto	Id_Marca	Id_Tipo_Producto	Id_Tipo_Sustancia	Activo	Fecha_Alta
//	Id_Producto	Nombre		Imagen_Producto	Id_Marca	Id_Tipo_Producto	Id_Tipo_Sustancia	Activo	
print_r($_POST);

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
$val_Imagen_Producto = $_POST["Imagen_Producto"];
$val_fecha_alta = date("Y-m-d H:i:s");
$cantidad_inventario = $_POST["cantidad_inventario"];

//$qry_insert = "insert into ds_tbl_producto set Nombre = '{$val_nombre}'";
//$qry_insert = "insert into ds_tbl_producto (Nombre, Descripcion, Fecha_Alta) values ('{$val_nombre}', '{$val_descripcion}', '{$val_fecha_alta}')";
//$qry_insert = "insert into ds_tbl_producto (Nombre, Descripcion, Fecha_Alta, Id_Marca, Id_Tipo_Producto, Id_Tipo_Sustancia, Id_Categoria_Producto) values ('{$val_nombre}', '{$val_descripcion}', '{$val_fecha_alta}', {$val_marca}, {$val_tipo_producto}, {$val_tipo_producto}, {$val_categoria})";
if($_POST["nombre_producto"] != ""){
    $qry_insert = "insert into ds_tbl_producto (Nombre, Descripcion, Fecha_Alta, Id_Marca, Id_Tipo_Producto, Id_Tipo_Sustancia, Id_Categoria_Producto, Activo) values ('{$val_nombre}', '{$val_descripcion}', '{$val_fecha_alta}', {$val_marca}, {$val_tipo_producto}, {$val_tipo_producto}, {$val_categoria}, 1)";
    echo $qry_insert;
    
    $obj->query($qry_insert);
    
    $qry_resultado = "select * from ds_tbl_producto where Nombre = '{$val_nombre}' and Descripcion = '{$val_descripcion}' and Fecha_Alta = '{$val_fecha_alta}' and Id_Categoria_Producto = {$val_categoria} limit 1";
    $resultado = $obj->get_row($qry_resultado);
    
    echo $qry_resultado;
    
    $id_producto = $resultado->Id_Producto;
    
    //$qry_insert_detalle = "insert into (Codigo_Barras, Id_Talla, Id_Color, Id_Producto, Id_Tipo_Mercado, Id_Genero) values ('{$val_codigo_barras}', {$val_talla}, {$val_color}, {$id_producto}, {$val_tipo_mercado}, {$val_genero})";
    $qry_insert_detalle = "insert into ds_tbl_producto_detalle (Codigo_Barras, Id_Talla, Id_Color, Id_Producto, Id_Tipo_Mercado, Id_Genero, Activo) values ('{$val_codigo_barras}', {$val_talla}, {$val_color}, {$id_producto}, {$val_tipo_mercado}, {$val_genero}, 1)";
    
    $obj->query($qry_insert_detalle);
    
    
    
    //$qry_resultado_detalle = "select * from ds_tbl_producto where Nombre = '{$val_nombre}' and Descripcion = '{$val_descripcion}' and Fecha_Alta = '{$val_fecha_alta}' and Id_Categoria_Producto = {$val_categoria} limit 1";
    $qry_resultado_detalle = "select * from ds_tbl_producto_detalle where Codigo_Barras = '{$val_codigo_barras}' and Id_Producto = {$id_producto} and Id_Genero = {$val_genero} and Id_Tipo_Mercado = {$val_tipo_mercado} limit 1";
    $resultado_detalle = $obj->get_row($qry_resultado_detalle);
    
    $id_producto_detalle = $resultado_detalle->Id_Producto_Detalle;
    
    //ds_tbl_precio_venta_producto
    //Costo_Venta, Costo_Venta_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Euro, Libra, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior
    $qry_insert_detalle_precio_venta = "insert into ds_tbl_precio_venta_producto (Id_Producto_Detalle, Costo_Venta) values ({$id_producto_detalle}, '{$val_precio_venta}')";
    $obj->query($qry_insert_detalle_precio_venta);
    
    /**
    $qry_insert_detalle_cantidad_producto = "insert into ds_tbl_precio_venta_producto (Id_Producto_Detalle, Costo_Venta) values ({$id_producto_detalle}, '{$val_precio_venta}')";
    $obj->query($qry_insert_detalle_cantidad_producto);
    
    $qry_insert_detalle_cantidad_producto = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Cantidad_Inventario) values ({$id_producto_detalle}, '{$val_precio_venta}')";
    $obj->query($qry_insert_detalle_cantidad_producto);
    
    */
    //$qry_insert_detalle_cantidad_producto = "insert into ds_tbl_cantidad_minima_producto (Id_Producto_Detalle, Cantidad_Minima, Cantidad_Maxima) values ({$id_producto_detalle}, {$val_cantidad_minima}, {$val_cantidad_maxima})";
    $qry_insert_detalle_cantidad_producto = "insert into ds_tbl_cantidad_minima_producto (Id_Producto_Detalle, Cantidad_Minima, Cantidad_Maxima, Activo, Fecha_alta, Fecha_Actualiza) values ({$id_producto_detalle}, {$val_cantidad_minima}, {$val_cantidad_maxima}, 1, '{$val_fecha_alta}', '{$val_fecha_alta}')";
    $obj->query($qry_insert_detalle_cantidad_producto);
    
    
    //$qry_resultado_detalle_cantidad_producto = "select * from ds_tbl_producto_detalle where Codigo_Barras = '{$val_codigo_barras}' and Id_Producto = {$id_producto} and Id_Genero = {$val_genero} and Id_Tipo_Mercado = {$val_tipo_mercado} limit 1";
    $qry_resultado_detalle_cantidad_producto = "select * from ds_tbl_cantidad_minima_producto where Id_Producto_Detalle = {$id_producto_detalle} and Fecha_alta = '{$val_fecha_alta}' limit 1";
    $resultado_detalle_cantidad_producto = $obj->get_row($qry_resultado_detalle_cantidad_producto);
    
    $id_cantidad_producto = $resultado_detalle_cantidad_producto->Id_Cantidad_Producto;
    
    
    
    //$qry_insert_detalle_inventario_almacen = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Cantidad_Inventario) values ({$id_producto_detalle}, {$cantidad_inventario})";
    //$qry_insert_detalle_inventario_almacen = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Cantidad_Inventario, Id_Cantidad_Producto) values ({$id_producto_detalle}, {$cantidad_inventario}, {$id_cantidad_producto})";
    $qry_insert_detalle_inventario_almacen = "insert into ds_tbl_inventario_almacen (Id_Producto_Detalle, Cantidad_Inventario, Id_Cantidad_Producto, Fecha_Actualizacion) values ({$id_producto_detalle}, {$cantidad_inventario}, {$id_cantidad_producto}, '{$val_fecha_alta}')";
    $obj->query($qry_insert_detalle_cantidad_producto);
}


?>
<?php
include_once("login.php");
?>
<?php
include_once("db.php");
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

					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>ID</th>
								<th>Imagen</th>
								<th>Nombre</th>
								<th>Tipo de producto</th>
								
								<th>Color</th>
								<th>Talla</th>
								<th>Existencias</th>
								
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
							//ds_tbl_producto_detalle
							//$qry_resultados = "select * from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto order by $tbl_main.Descripcion asc";
							//ds_cat_color
							//$qry_resultados = "select * from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla order by $tbl_main.Descripcion asc";
							//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto order by $tbl_main.Descripcion asc";
							//ds_tbl_inventario_almacen
							$qry_resultados = "select *, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
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
							
							$id_usuario=$resultado->Id_Producto;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Descripcion;
							$id_nivel="Hola";
							$extension="Hola";
							$area="Hola";
							$completo="Hola";
							$niveles="Hola";
							?>
								
							<tr id="element<?php echo $id_usuario; ?>">
								<td><?php echo $id_usuario; ?></td>
								<td><?php if($resultado->Imagen_Producto != ""): ?><img src="images/productos/<?php echo $resultado->Imagen_Producto; ?>" style="max-height:50px; max-width:100px;" /><?php endif; ?></td>
								
								<td><a href="productos.php?id=<?php echo $id_usuario; ?>"><?php echo $nombre; ?></td>
								<td><?php echo $resultado->tipo_producto; ?></td>
								
								<?php /**
								<td><?php echo $resultado->descripcion_producto; ?></td>
								*/ ?>
								
								
								<td><?php echo $resultado->color; ?> <?php echo $resultado->Codigo_Hexadecimal; ?><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $resultado->Codigo_Hexadecimal; ?>"></div></td>
								<td><?php echo $resultado->talla; ?></td>
								<td><?php echo $resultado->Cantidad_Inventario; ?></td>
								

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
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_usuario; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Remove</a>
												<a onclick="cargar_editar('<?php echo $id_usuario; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
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
