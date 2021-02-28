<?php include("includes/includes.php"); ?>
<?php include("common_files/sesion.php"); ?>
<?php
if($_GET["fecha"] != ""){
    $fecha_val = $_GET["fecha"];
}else{
    $fecha_val = date("Y-m-d");
}
if($_GET["fecha_fin"] != ""){
    $fecha_fin = $_GET["fecha_fin"];
}else{
    $fecha_fin = date("Y-m-d");
}
$nombre_seccion = "Home";

?>
<?php 
//domingo = 0
//lunes = 1
//$orgDate = "2019-02-26";
$orgDate = "13-12-2020";
//$newDate = date("m-d-Y", strtotime($orgDate));
//$newDate = date("w", strtotime($orgDate));
$newDate = date("w", strtotime($fecha_val));

//echo "New date format is: ".$newDate. " (MM-DD-YYYY)";

$dia_de_semana = date('w');




//$new_fecha_inicio_semana = date("Y-m-d", strtotime($fecha_val. " {$val_lun} days"));
$fecha_inicio_val_start = $fecha_val . ' 00:00:00';
//$fecha_inicio_val_end = $new_fecha_inicio_semana . ' 23:59:59';

//$fecha_final_val_start = $new_fecha_final_semana . ' 00:00:00';
$fecha_final_val_end = $fecha_fin . ' 23:59:59';


$qry_semana = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_inicio_val_start}' and Fecha_Venta <= '{$fecha_final_val_end}'";
//echo $qry_hours;
$res_semana = $obj->get_row($qry_semana);

//echo $res_semana->sumatoria;

$value_percent = 100 / $res_semana->sumatoria;

//ds_tbl_venta_metodo_pago
//$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_inicio_val_start}' and Fecha_Venta <= '{$fecha_final_val_end}'";
//$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta_metodo_pago.Id_Venta = ds_tbl_venta.Id_Venta where ds_tbl_venta.Fecha_Venta >= '{$fecha_inicio_val_start}' and ds_tbl_venta.Fecha_Venta <= '{$fecha_final_val_end}' group by ds_tbl_venta_metodo_pago.Id_Metodo_Pago";
//ds_cat_metodo_pago`
//$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta_metodo_pago.Id_Venta = ds_tbl_venta.Id_Venta where ds_tbl_venta.Fecha_Venta >= '{$fecha_inicio_val_start}' and ds_tbl_venta.Fecha_Venta <= '{$fecha_final_val_end}' group by ds_tbl_venta_metodo_pago.Id_Metodo_Pago";
$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta_metodo_pago.Id_Venta = ds_tbl_venta.Id_Venta left join ds_cat_metodo_pago on ds_tbl_venta_metodo_pago.Id_Metodo_Pago = ds_cat_metodo_pago.Id_Forma_Pago where ds_tbl_venta.Fecha_Venta >= '{$fecha_inicio_val_start}' and ds_tbl_venta.Fecha_Venta <= '{$fecha_final_val_end}' group by ds_tbl_venta_metodo_pago.Id_Metodo_Pago";
//echo $qry_hours;
//echo $qry_resultados;
$resultados = $obj->get_results($qry_resultados);

//print_r($resultados);
//exit();
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
	<link href="css/main.css" rel="stylesheet" type="text/css">
	*/ ?>
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

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],

			<?php foreach($resultados as $resultado): ?>
			['<?php echo $resultado->Descripcion; ?> <?php echo $resultado->Id_Forma_Pago; ?>',     <?php echo $resultado->sumatoria ?>],
			  

			<?php endforeach; ?>
          /*
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
          */
			['',    0]
	          
        ]);

        var options = {
          title: 'Métodos de pago',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
	
</head>

<body>

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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $nombre_seccion; ?></span></h4>
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
							<!-- 
							<a href="usuarios.php" class="breadcrumb-item">Usuarios</a>
							<span class="breadcrumb-item active">Listado</span>
							-->
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

				<!-- Basic datatable -->
				<div class="card">
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
						Gr&aacute;ficas de ventas semanales realizadas.
					</div>
					<?php /**
					<div class="card-body">
						La lista de <code>Usuarios</code> muestra todos los participantes que pueden acceder a la <code>intranet</code>.
					</div>
					*/ ?>

					<div>
					
						<script>
                		function mostrar_horarios_home(fecha){
                			$("#graph_home_days").hide();
                			$("#graph_home_hours").show();
                
                			$.ajax({
                				type: "POST",
                				//url:"ajax_graph_hours.php",
                				url:"ajax_home_horas.php",
                				data: { fecha:fecha },
                				success:function(data){
                					$("#graph_home_hours").html(data);
                				}
                			});
                			
                		}
                		function ir_detalle(){
                			var valor_fecha_inicio = $('#fecha_inicio').val();

                			var valor_fecha_fin = $('#fecha_fin').val();
                			

                			
                			
                			window.location="?fecha=" + valor_fecha_inicio + "&fecha_fin=" + valor_fecha_fin;
                		}
                		</script>
                		<style>
                        .graph_home{
                        	background:orange;
                        	/*background: linear-gradient(180deg, red, yellow);*/
                        	background: linear-gradient(180deg, #2b8bf2, yellowgreen);
                        	width:10%;
                        	margin:0 2%;
                        	cursor:pointer;
                        }
                        .graph_home_day{
                        	width:10%;
                        	margin:0 2%;
                        	text-align:center;
                        	font-weight:bold;
                        	font-size:20px;
                        }
                        .graph_home_percent{
                        	width:10%;
                        	margin:0 2%;
                        	text-align:center;
                        }
                        </style>
                        <div style="font-family:verdana;">
                        	<div>
                        		De
                        		<input type="date" value="<?php echo $fecha_val; ?>" id="fecha_inicio" onchange="ir_detalle()" />
                        		
                        		
                        	</div>
                        	<div>
                        		A
                        		<input type="date" value="<?php echo $fecha_fin; ?>" id="fecha_fin" onchange="ir_detalle()" />
                        		
                        		
                        	</div>
                        	<div id="piechart_3d" style="width: 900px; height: 500px;"></div>
                        	
                        	<div id="graph_home_days">
                            	<div style="height:300px;  width:100%; display:flex; align-items:baseline; justify-content:center;">
                            		<div style="width:0px; height:100%;"></div>
                            		<?php 
                            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_lun} days"));
                            		
                            		$fecha_val_start = $new_fecha_val . ' 00:00:00';
                            		$fecha_val_end = $new_fecha_val . ' 23:59:59';
                            		
                            		//echo $new_fecha_val;
                            		$qry_res_lun = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                            		
                            		$res_lun = $obj->get_row($qry_res_lun);
                            		$percent_lun = $value_percent * $res_lun->sumatoria;
                            		?>
                            		<div class="graph_home" onclick="mostrar_horarios_home('<?php echo $new_fecha_val; ?>')" style="height:<?php echo $percent_lun; ?>%;"></div>
                                	<?php 
                            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_mar} days"));
                                	
                                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                                	
                                	//echo $new_fecha_val;
                                	$qry_res_mar = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                                	
                                	$res_mar = $obj->get_row($qry_res_mar);
                                	$percent_mar = $value_percent * $res_mar->sumatoria;
                            		?>
                            		<div class="graph_home" onclick="mostrar_horarios_home('<?php echo $new_fecha_val; ?>')" style="height:<?php echo $percent_mar; ?>%;"></div>
                                	<?php 
                            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_mie} days"));
                                	
                                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                                	
                                	//echo $new_fecha_val;
                                	$qry_res_mie = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                                	
                                	$res_mie = $obj->get_row($qry_res_mie);
                                	$percent_mie = $value_percent * $res_mie->sumatoria;
                            		?>
                                	<div class="graph_home" onclick="mostrar_horarios_home('<?php echo $new_fecha_val; ?>')" style="height:<?php echo $percent_mie; ?>%;"></div>
                                	<?php 
                            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_jue} days"));
                                	
                                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                                	
                                	//echo $new_fecha_val;
                                	$qry_res_jue = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                                	
                                	$res_jue = $obj->get_row($qry_res_jue);
                                	$percent_jue = $value_percent * $res_jue->sumatoria;
                            		?>
                            		<div class="graph_home" onclick="mostrar_horarios_home('<?php echo $new_fecha_val; ?>')" style="height:<?php echo $percent_jue; ?>%;"></div>
                                	<?php 
                            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_vie} days"));
                                	
                                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                                	
                                	//echo $new_fecha_val;
                                	$qry_res_vie = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                                	
                                	$res_vie = $obj->get_row($qry_res_vie);
                                	$percent_vie = $value_percent * $res_vie->sumatoria;
                            		?>
                            		<div class="graph_home" onclick="mostrar_horarios_home('<?php echo $new_fecha_val; ?>')" style="height:<?php echo $percent_vie; ?>%;"></div>
                                	<?php 
                            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_sab} days"));
                                	
                                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                                	
                                	//echo $new_fecha_val;
                                	$qry_res_sab = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                                	
                                	$res_sab = $obj->get_row($qry_res_sab);
                                	$percent_sab = $value_percent * $res_sab->sumatoria;
                            		?>
                            		<div class="graph_home" onclick="mostrar_horarios_home('<?php echo $new_fecha_val; ?>')" style="height:<?php echo $percent_sab; ?>%;"></div>
                                	<?php 
                            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_dom} days"));
                                	
                                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                                	
                                	//echo $new_fecha_val;
                                	$qry_res_dom = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                                	
                                	$res_dom = $obj->get_row($qry_res_dom);
                                	$percent_dom = $value_percent * $res_dom->sumatoria;
                            		?>
                            		<div class="graph_home" onclick="mostrar_horarios_home('<?php echo $new_fecha_val; ?>')" style="height:<?php echo $percent_dom; ?>%;"></div>
                                	
                            		<?php /**
                                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:100px;"></div>
                                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50%;"></div>
                                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                                	*/ ?>
                            	</div>
                            	<div style="height:30px;  width:100%; display:flex; align-items:baseline; justify-content:center; border-top:1px solid gray;">
                            		<div style="width:0px; height:100%;"></div>
                                	<div class="graph_home_day" style="">L</div>
                                	<div class="graph_home_day" style="">M</div>
                                	<div class="graph_home_day" style="">M</div>
                                	<div class="graph_home_day" style="">J</div>
                                	<div class="graph_home_day" style="">V</div>
                                	<div class="graph_home_day" style="">S</div>
                                	<div class="graph_home_day" style="">D</div>
                            	</div>
                            	<div style="height:30px;  width:100%; display:flex; align-items:baseline; justify-content:center;">
                            		<div style="width:0px; height:100%;"></div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_lun, 1, '.', ','); ?>%<br />$<?php echo number_format($res_lun->sumatoria, 1, '.', ','); ?></div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_mar, 1, '.', ','); ?>%<br />$<?php echo number_format($res_mar->sumatoria, 1, '.', ','); ?></div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_mie, 1, '.', ','); ?>%<br />$<?php echo number_format($res_mie->sumatoria, 1, '.', ','); ?></div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_jue, 1, '.', ','); ?>%<br />$<?php echo number_format($res_jue->sumatoria, 1, '.', ','); ?></div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_vie, 1, '.', ','); ?>%<br />$<?php echo number_format($res_vie->sumatoria, 1, '.', ','); ?></div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_sab, 1, '.', ','); ?>%<br />$<?php echo number_format($res_sab->sumatoria, 1, '.', ','); ?></div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_dom, 1, '.', ','); ?>%<br />$<?php echo number_format($res_dom->sumatoria, 1, '.', ','); ?></div>
                            	</div>
                            </div>
                            <div id="graph_home_hours" style="display:none;">
                            	
                            </div>
                        </div>
                        
                        <?php //print_r(phpversion()); ?>
                        
                        <?php //print_r($_SERVER); ?>
                        <?php 
                        
                        $res = $obj->get_results("select * from ds_tbl_venta");
                        
                        //print_r($res);
                        ?>
					
					
					<br /><br /><br />
					
						<div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div style="text-align:right;">
                                    <a class="btn btn-primary" href="/Producto/ResgitrarProductoCompleto" role="button">Agregar producto</a>
                                    <a class="btn btn-primary" href="/Venta/VentaEvento?IdEvento=1&amp;Descripcion=OFICINA&amp;FechaInicio=01%2F01%2F0001%2000%3A00%3A00&amp;CP=0&amp;FechaAlta=01%2F01%2F0001%2000%3A00%3A00&amp;Activo=False&amp;FechaCierre=01%2F01%2F0001%2000%3A00%3A00&amp;IdEmpleadoAlta=0&amp;InventarioRevisado=False&amp;FechaRevisionInventario=01%2F01%2F0001%2000%3A00%3A00&amp;InventarioRevisadoDiaPost=False&amp;FechaRevisionInventarioDiaPost=01%2F01%2F0001%2000%3A00%3A00&amp;IdCierre=0&amp;CantidadProductosInventario=0&amp;FechaEntrega=01%2F01%2F0001%2000%3A00%3A00" role="button">Venta directa</a>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                        </div>
                        <br /><br /><br />
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-4">
                        <div class="card text-center">
                            <div class="body">
                                <p class="m-b-20"><i class="zmdi zmdi-assignment zmdi-hc-3x col-blue"></i></p>
                                <span>Ventas totales</span>
                                <h3 class="m-b-10 number count-to" data-from="0" data-to="595" data-speed="2000" data-fresh-interval="700">40</h3>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-lg-4 col-md-4">
                        <div class="card text-center">
                            <div class="body">
                                <p class="m-b-20"><i class="zmdi zmdi-account-box zmdi-hc-3x col-green"></i></p>
                                <span>Clientes registrados</span>
                                <h3 class="m-b-10 number count-to" data-from="0" data-to="486" data-speed="2000" data-fresh-interval="700">100</h3>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-lg-4 col-md-4">
                        <div class="card text-center">
                            <div class="body">
                                <p class="m-b-20"><i class="zmdi zmdi-balance zmdi-hc-3x col-amber"></i></p>
                                <span>Productos en préstamo</span>
                                <h3 class="m-b-10 number count-to" data-from="0" data-to="50" data-speed="2000" data-fresh-interval="700">49</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-4">
                        <div class="card text-center">
                            <div class="body">
                                <p class="m-b-20"><i class="zmdi zmdi-shopping-basket zmdi-hc-3x"></i></p>
                                <span>Consumo promedio visita</span>
                                <h3 class="m-b-10">$<span class="number count-to" data-from="0" data-to="8035.1178662292" data-speed="2000" data-fresh-interval="700">8035.1178662292</span></h3>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-lg-4 col-md-4">
                        <div class="card text-center">
                            <div class="body">
                                <p class="m-b-20"><i class="zmdi zmdi-account-circle zmdi-hc-3x col-brown"></i></p>
                                <span>Promedio visitas cliente</span>
                                <h3 class="m-b-10"><span class="number count-to" data-from="0" data-to="1.2243" data-speed="2000" data-fresh-interval="700">1.2243</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="header">
                                <h2>Productos mas vendidos</h2>
                            </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="87" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">PIANISSIMO  <span class="float-right">1251%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-dark" role="progressbar" aria-valuenow="1251" aria-valuemin="0" aria-valuemax="100" style="width: 1251%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="65" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">LEGEND  <span class="float-right">934%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-dark" role="progressbar" aria-valuenow="934" aria-valuemin="0" aria-valuemax="100" style="width: 934%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="50" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">ADEQUAN  <span class="float-right">719%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-dark" role="progressbar" aria-valuenow="719" aria-valuemin="0" aria-valuemax="100" style="width: 719%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="49" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">PERFORMIX <span class="float-right">704%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-dark" role="progressbar" aria-valuenow="704" aria-valuemin="0" aria-valuemax="100" style="width: 704%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="39" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">HORSE RIDING VEST CARTIDGE <span class="float-right">560%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-dark" role="progressbar" aria-valuenow="560" aria-valuemin="0" aria-valuemax="100" style="width: 560%;"></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="header">
                                <h2>Productos menos vendidos</h2>
                            </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="1" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">TEMPEST SWEAT WOMEN 2019 <span class="float-right">14%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-coral" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="1" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">LORIENT V GRIP BREEEC <span class="float-right">14%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-coral" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="1" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">COLLIER DE CHASSE A PONT REGLABLE CONTACT 003 NR B <span class="float-right">14%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-coral" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="1" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">HELIOS ML <span class="float-right">14%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-coral" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;"></div>
                                    </div>
                                </div>
                                <div class="body m-b-10">
                                    <h5 class="m-b-0 number count-to" data-from="0" data-to="1" data-speed="2000" data-fresh-interval="700">2651</h5>
                                    <p class="text-muted">FIRST LADDY CARBONE 2X <span class="float-right">14%</span></p>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-coral" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;"></div>
                                    </div>
                                </div>
                        </div>
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
