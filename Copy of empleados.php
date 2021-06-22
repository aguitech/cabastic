<?php include("includes/includes.php"); ?>
<?php include("common_files/sesion.php"); ?>
<?php 
$nombre_seccion = "Empleados";
$tbl_main = "ds_tbl_empleado";
$nombre_simple = "empleado";
$url_name = "empleados.php";
$url_crear_name = "crear_empleado.php";
?>
<?php 
print_r($_POST);

$fecha_hoy = date("Y-m-d H:i:s");
$nombre = $_POST["Nombre"];
$apellido_paterno = $_POST["Apellido_Paterno"];
$apellido_materno = $_POST["Apellido_Materno"];
$curp = $_POST["CURP"];
$correo_electronico = $_POST["Correo_Electronico"];
$telefono = $_POST["Telefono"];
$contrasena = md5($_POST["Contrasena"]);
$celular = $_POST["Celular"];
$codigo_cliente = $_POST["Codigo_Cliente"];


$calle = $_POST["Calle"];
$colonia = $_POST["Colonia"];
$id_codigo_postal = $_POST["Id_Codigo_Postal"];
$usuario = $_POST["Usuario"];
$contrasena_usuario = $_POST["Contrasena_Usuario"];
$id_empleado_alta = $_POST["Id_Empleado_Alta"];
$id_empleado_rol = $_POST["Id_Empleado_Rol"];
$id_pago_empleado = $_POST["Id_Pago_Empleado"];


$activo = $_POST["Activo"];


if($_POST["editar"] != ""){
    $id_editar = $_POST["editar"];
    //$qry_update = "update $tbl_main set Id_Cliente = '{}', Nombre = '{$nombre}', Apellido_Paterno = '{$apellido_paterno}', Apellido_Materno = '{$apellido_materno}', CURP = '{$curp}', Correo_Electronico = '{$correo_electronico}', Telefono = '{$telefono}', Celular = '{$celular}', Codigo_Cliente = '{$codigo_cliente}', Contrasena = '{$contrasena}', Fecha_Alta = '{$fecha_hoy}', Fecha_Actualiza = '{$fecha_hoy}', Es_Comisionista = '{$es_comisionista}', Activo = '{$activo}' where Id_Cliente = $id_editar";
    /**
    $qry_update = "update $tbl_main set Nombre = '{$nombre}', Apellido_Paterno = '{$apellido_paterno}', Apellido_Materno = '{$apellido_materno}', CURP = '{$curp}', Correo_Electronico = '{$correo_electronico}', Telefono = '{$telefono}', Celular = '{$celular}', Codigo_Cliente = '{$codigo_cliente}', Contrasena = '{$contrasena}', Fecha_Alta = '{$fecha_hoy}', Fecha_Actualiza = '{$fecha_hoy}', Activo = '{$activo}' where Id_Empleado = $id_editar";
    */
    $qry_update = "update $tbl_main set Nombre = '{$nombre}', Apellido_Paterno = '{$apellido_paterno}', Apellido_Materno = '{$apellido_materno}', CURP = '{$curp}', Correo_Electronico = '{$correo_electronico}', Telefono = '{$telefono}', Celular = '{$celular}', Codigo_Cliente = '{$codigo_cliente}', Contrasena = '{$contrasena}', Fecha_Alta = '{$fecha_hoy}', Fecha_Actualiza = '{$fecha_hoy}', Activo = '{$activo}' where Id_Empleado = $id_editar";
    $obj->query($qry_update);
}else{
    //Textos completos	Id_Cliente	Nombre	Apellido_Paterno	Apellido_Materno	CURP	Correo_Electronico	Telefono	Celular	Codigo_Cliente	Contrasena	Fecha_Alta	Fecha_Actualiza	Es_Comisionista	Activo
    $last_cliente = $obj->get_row("select * from ds_tbl_cliente order by Id_Cliente desc limit 1");
    $next_id_cliente = $last_cliente->Id_Cliente + 1;
    
    $qry_insert = "insert into $tbl_main (Id_Cliente, Nombre, Apellido_Paterno, Apellido_Materno, CURP, Correo_Electronico, Telefono, Celular, Codigo_Cliente, Contrasena, Fecha_Alta, Fecha_Actualiza, Activo) values ($next_id_cliente, '{$nombre}', '{$apellido_paterno}', '{$apellido_materno}', '{$curp}', '{$correo_electronico}', '{$telefono}', '{$celular}', '{$codigo_cliente}', '{$contrasena}', '{$fecha_hoy}', '{$fecha_hoy}', '{$activo}')";
    echo $qry_insert;
    $obj->query($qry_insert);
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
								
								<th>Nombre</th>
								<th>Nombre de usuario</th>
								
								<th>Correo electr&oacute;nico</th>
								<th>Rol</th>
								
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							

							<?php
							//}
							?>

							<?php 
							//Id_Empleado_Rol
							$qry_resultados = "select *, ds_cat_empleado_rol.Descripcion as rol_empleado from $tbl_main left join ds_cat_empleado_rol on ds_cat_empleado_rol.Id_Empleado_Rol = $tbl_main.Id_Empleado_Rol order by Nombre asc";
							
							//$qry_resultados = "select * from $tbl_main order by Nombre asc";
						
							$resultados = $obj->get_results($qry_resultados);
						
						//$qry_resultados = "select * from $tbl_main order by Fecha_Venta desc";
						
						//$resultados = $obj->get_results($qry_resultados);
						
						
						?>
						<?php foreach($resultados as $resultado): ?>
						
							<?php //print_r($resultado); ?>
						
							<?php //for($i=0; $i<=10; $i++):
						/*
						 * Id_Empleado] => 8 [Nombre] => costos [Apellido_Paterno] => Sarahi [Apellido_Materno] => c [CURP] => costos [Correo_Electronico] => costos@cabastic.com [Telefono] => 11 [Celular] => 11 [Codigo_Cliente] => 12 [Contrasena] => costos [Fecha_Alta] => 2020-07-27 12:13:38 [Fecha_Actualiza] => 2020-07-27 12:13:38 [Calle] => 11 [Colonia] => 1 [Id_Codigo_Postal] => 10 [Usuario] => costos [Contrasena_Usuario] => costos [Id_Empleado_Alta] => 1 [Id_Empleado_Rol] => 4 [Activo] => 1 [Id_Pago_Empleado] => 4 
						 */
						      ?>
							
							<?php 
							$id_usuario=$resultado->Id_Empleado;
							$nombre=$resultado->Nombre . " " . $resultado->Apellido_Paterno . " " . $resultado->Apellido_Materno;
							$username=$resultado->Usuario;
							$email=$resultado->Correo_Electronico;
							$extension=$resultado->Usuario;
							$rol_empleado=$resultado->rol_empleado;
							
							$area="Hola";
							$completo="Hola";
							$niveles="Hola";
							?>
								
							<tr id="element<?php echo $id_usuario; ?>">
								<td><?php echo $nombre; ?></td>
								<td><?php echo $username; ?></td>
								
								<td><?php echo $email; ?></td>
								<td><?php echo $rol_empleado; ?></td>
								

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
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_usuario; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Eliminar</a>
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
