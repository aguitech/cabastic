<?php include("includes/includes.php"); ?>
<?php
if($_GET["fecha"] != ""){
    $fecha_val = $_GET["fecha"];
}else{
    $fecha_val = date("Y-m-d");
}
?>
<?php /**echo date("DAY"); ?>
<br />
<?php echo date('w'); */?>
<?php 
//domingo = 0
//lunes = 1
//$orgDate = "2019-02-26";
$orgDate = "13-12-2020";
//$newDate = date("m-d-Y", strtotime($orgDate));
//$newDate = date("w", strtotime($orgDate));
$newDate = date("w", strtotime($fecha_val));

echo "New date format is: ".$newDate. " (MM-DD-YYYY)";

$dia_de_semana = date('w');

//$newDate
//switch ($dia_de_semana){
switch ($newDate){
    case 0:
        echo "Domingo";
        $val_lun = -6;
        $val_mar = -5;
        $val_mie = -4;
        $val_jue = -3;
        $val_vie = -2;
        $val_sab = -1;
        $val_dom = 0;
        
        break;
    case 1:
        echo "Lunes";
        $val_lun = 0;
        $val_mar = +1;
        $val_mie = +2;
        $val_jue = +3;
        $val_vie = +4;
        $val_sab = +5;
        $val_dom = +6;
        break;
    case 1:
        echo "Martes";
        $val_lun = -1;
        $val_mar = 0;
        $val_mie = +1;
        $val_jue = +2;
        $val_vie = +3;
        $val_sab = +4;
        $val_dom = +5;
        break;
    case 1:
        echo "Miercoles";
        $val_lun = -2;
        $val_mar = -1;
        $val_mie = 0;
        $val_jue = +1;
        $val_vie = +2;
        $val_sab = +3;
        $val_dom = +4;
        break;
    case 1:
        echo "Jueves";
        $val_lun = -3;
        $val_mar = -2;
        $val_mie = -1;
        $val_jue = 0;
        $val_vie = +1;
        $val_sab = +2;
        $val_dom = +3;
        break;
    case 1:
        echo "Viernes";
        $val_lun = -4;
        $val_mar = -3;
        $val_mie = -2;
        $val_jue = -1;
        $val_vie = 0;
        $val_sab = +1;
        $val_dom = +2;
        break;
    case 1:
        echo "Sabado";
        $val_lun = -5;
        $val_mar = -4;
        $val_mie = -3;
        $val_jue = -2;
        $val_vie = -1;
        $val_sab = 0;
        $val_dom = +1;
        break;
        

}


$new_fecha_inicio_semana = date("Y-m-d", strtotime($fecha_val. " {$val_lun} days"));
$fecha_inicio_val_start = $new_fecha_inicio_semana . ' 00:00:00';
//$fecha_inicio_val_end = $new_fecha_inicio_semana . ' 23:59:59';

$new_fecha_final_semana = date("Y-m-d", strtotime($fecha_val. " {$val_dom} days"));
//$fecha_final_val_start = $new_fecha_final_semana . ' 00:00:00';
$fecha_final_val_end = $new_fecha_final_semana . ' 23:59:59';


$qry_semana = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_inicio_val_start}' and Fecha_Venta <= '{$fecha_final_val_end}'";
//echo $qry_hours;
$res_semana = $obj->get_row($qry_semana);

echo $res_semana->sumatoria;

$value_percent = 100 / $res_semana->sumatoria;

?>
 <?php
//session_start();
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Usuarios</span> - Listado</h4>
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
							<a href="usuarios.php" class="breadcrumb-item">Usuarios</a>
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

				<!-- Basic datatable -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Usuarios</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
						La lista de <code>Usuarios</code> muestra todos los participantes que pueden acceder a la <code>intranet</code>.
					</div>

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
                			var valor_fecha = $('#fecha_home').val();
                			window.location="?fecha=" + valor_fecha;
                		}
                		</script>
                		<style>
                        .graph_home{
                        	background:orange;
                        	background: linear-gradient(180deg, red, yellow);
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
                        		<input type="date" value="<?php echo $fecha_val; ?>" id="fecha_home" onchange="ir_detalle()" />
                        		
                        		
                        	</div>
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
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_lun, 1, '.', ','); ?>%</div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_mar, 1, '.', ','); ?>%</div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_mie, 1, '.', ','); ?>%</div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_jue, 1, '.', ','); ?>%</div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_vie, 1, '.', ','); ?>%</div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_sab, 1, '.', ','); ?>%</div>
                                	<div class="graph_home_percent" style=""><?php echo number_format($percent_dom, 1, '.', ','); ?>%</div>
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
