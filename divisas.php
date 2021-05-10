<?php include("includes/includes.php"); ?>
<?php include("common_files/sesion.php"); ?>
<?php 
$nombre_seccion = "Divisas";
$tbl_main = "ds_tbl_evento";
$nombre_simple = "divisa";
$url_name = "divisas.php";
$url_crear_name = "crear_divisa.php";
?>
<?php 
if($_POST["Descripcion"] != ""){
    //print_r($_POST);
    $val_evento = $_POST["Descripcion"];
    $val_fecha_inicio = $_POST["Fecha_Inicio"] . " 00:00:00";
    $val_fecha_cierre = $_POST["Fecha_Cierre"] . " 23:59:59";
    $val_calle = $_POST["Calle"];
    
    $val_colonia = $_POST["Colonia"];
    $val_codigo_postal = $_POST["Id_Codigo_Postal"];
    
    
    $fecha_hoy = date("Y-m-d H:i:s");
    
    
    if($_POST["editar"] != ""){
        $id_editar = $_POST["editar"];
        //$qry_edit = "update ds_cat_tipo_sustancia set Descripcion = '{$val_descripcion}', Abreviatura = '{$val_abreviatura}', Comentario = '{$val_comentario}', Activo = $val_activo, Fecha_Actualiza = '{$fecha_hoy}' where Id_Tipo_Sustancia = $id_editar";
        //echo $qry_edit;
        //$qry_edit = "update ds_tbl_evento set Descripcion = '{$val_evento}', Fecha_Inicio = '{$val_fecha_inicio}', Fecha_Cierre = '{$val_fecha_cierre}', Calle = '{$val_calle}', Colonia = '{$val_colonia}', Fecha_Actualiza = '{$fecha_hoy}' where Id_Talla = $id_editar";
        //
        //$qry_edit = "update ds_tbl_evento set Descripcion = '{$val_evento}', Fecha_Inicio = '{$val_fecha_inicio}', Fecha_Cierre = '{$val_fecha_cierre}', Calle = '{$val_calle}', Colonia = '{$val_colonia}', Fecha_Actualiza = '{$fecha_hoy}' where Id_Talla = $id_editar";
        //
        $qry_edit = "update ds_tbl_evento set Descripcion = '{$val_evento}', Fecha_Inicio = '{$val_fecha_inicio}', Fecha_Cierre = '{$val_fecha_cierre}', Calle = '{$val_calle}', Colonia = '{$val_colonia}', Activo = 1 where Id_Evento = $id_editar";
        //
        $obj->query($qry_edit);
    }else{
        
        $last_id_qry = $obj->get_row("select * from ds_tbl_evento order by Id_Evento desc");
        
        $last_id = $last_id_qry->Id_Evento;
        $neext_id = $last_id + 1;
        
        //$qry_insert = "insert into ds_cat_tipo_sustancia (Descripcion, Abreviatura, Comentario, Activo, Fecha_Alta, Fecha_Actualiza) values ('{$val_descripcion}', '{$val_abreviatura}', '{$val_comentario}', 1, '{$fecha_hoy}', '{$fecha_hoy}')";
        //$qry_insert = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Fecha_Cierre, Calle, Colonia) values ('{$val_descripcion}', '{$val_abreviatura}', 1, '{$fecha_hoy}', '{$fecha_hoy}')";
        //$qry_insert = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Fecha_Cierre, Calle, Colonia, Fecha_Alta, Activo) values ('{$val_evento}', '{$val_fecha_inicio}', '{$val_fecha_cierre}', '{$val_calle}', '{$val_colonia}', '{$fecha_hoy}', 1)";
        //$qry_insert = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Fecha_Cierre, Calle, Colonia, Fecha_Alta, Activo) values ('{$val_evento}', '{$val_fecha_inicio}', '{$val_fecha_cierre}', '{$val_calle}', '{$val_colonia}', '{$fecha_hoy}', 1)";
        $qry_insert = "insert into ds_tbl_evento (Id_Evento = Descripcion, Fecha_Inicio, Fecha_Cierre, Calle, Colonia, Fecha_Alta, Activo) values ($neext_id, '{$val_evento}', '{$val_fecha_inicio}', '{$val_fecha_cierre}', '{$val_calle}', '{$val_colonia}', '{$fecha_hoy}', 1)";
        //echo $qry_insert;
        $obj->query($qry_insert);
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
		function mostrar_divisa(id){
			$.ajax({
				type: "POST",
                url:"mostrar_divisa.php",
                //data: { limit:val_limit, offset:val_offset },
                data: { id:id },
                success:function(data){
                	console.log(data);
                	//$("#resultado_votos_detalle").html(data);
                	//$("#publicaciones_adicionales").html(data);
                	//$("#publicaciones_adicionales").append(data);
                	//$("#container").html(data);
                	$("#valor_divisa").html(data);
                }
			});
		}

		function actualizar_divisa(){
			var valor_divisa = $("#nuevo_divisa").val();
			var id_divisa = $("#id_divisa").val();

			//alert(valor_divisa);

			$.ajax({
				type: "POST",
                url:"actualizar_divisa.php",
                //data: { limit:val_limit, offset:val_offset },
                data: { id_divisa:id_divisa, valor_divisa:valor_divisa },
                success:function(data){
                	console.log(data);
                	//$("#resultado_votos_detalle").html(data);
                	//$("#publicaciones_adicionales").html(data);
                	//$("#publicaciones_adicionales").append(data);
                	//$("#container").html(data);
                	alert("Se ha actualizado la divisa");
                	$("#valor_divisa").html(data);
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
					<?php $divisas = $obj->get_results("select * from ds_cat_tipo_cambio"); ?>
					<div class="form-row">
                        <div class="form-group col-md-6">
                         	<div>Divisas</div>
                         	<select onclick="mostrar_divisa(this.value);" id="id_divisa" class="form-control">
                         		<option value="">Selecciona</option>
                         		<?php foreach($divisas as $divisa): ?>
                         		<option value="<?php echo $divisa->Id_Tipo_Cambio; ?>"><?php echo $divisa->Descripcion; ?></option>
                         		<?php endforeach; ?>
                         	</select>
                         	<br /><br />
                 			<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="mostrar_divisa($('#id_divisa').val());">Ver Divisa <i class="material-icons right">send</i></button>
                        </div>
                        <div class="form-group col-md-6">
                         	<!-- 
                         	<div>Status</div>
                         	-->
                         	<div id="valor_divisa"></div>
                        </div>
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