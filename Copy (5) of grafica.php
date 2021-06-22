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

switch ($dia_de_semana){
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
        $val_mar = 1;
        $val_mie = 2;
        $val_jue = 3;
        $val_vie = 4;
        $val_sab = 5;
        $val_dom = 6;
        break;
    case 1:
        echo "Martes";
        $val_lun = -1;
        $val_mar = 0;
        $val_mie = 1;
        $val_jue = 2;
        $val_vie = 3;
        $val_sab = 4;
        $val_dom = 5;
        break;
    case 1:
        echo "Miercoles";
        $val_lun = -2;
        $val_mar = -1;
        $val_mie = 0;
        $val_jue = 1;
        $val_vie = 2;
        $val_sab = 3;
        $val_dom = 4;
        break;
    case 1:
        echo "Jueves";
        $val_lun = -3;
        $val_mar = -2;
        $val_mie = -1;
        $val_jue = 0;
        $val_vie = 1;
        $val_sab = 2;
        $val_dom = 3;
        break;
    case 1:
        echo "Viernes";
        $val_lun = -4;
        $val_mar = -3;
        $val_mie = -2;
        $val_jue = -1;
        $val_vie = 0;
        $val_sab = 1;
        $val_dom = 2;
        break;
    case 1:
        echo "Sabado";
        $val_lun = -5;
        $val_mar = -4;
        $val_mie = -3;
        $val_jue = -2;
        $val_vie = -1;
        $val_sab = 0;
        $val_dom = 1;
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

<!DOCTYPE html>
<html>
	<head>
		<script src="https://aguitech.com/js/jquery-3.3.1.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=1" />
		
	</head>
	<body>
		<script>
		function mostrar_horarios_home(fecha){
			$("#graph_home_days").hide();
			$("#graph_home_hours").show();

			$.ajax({
				type: "POST",
				url:"ajax_graph_hours.php",
				data: { fecha:fecha },
				success:function(data){
					$("#graph_home_hours").html(data);
				}
			});
			
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
        		<input type="date" value="<?php echo $fecha_val; ?>" />
        		
        		
        	</div>
        	<div id="graph_home_days">
            	<div style="height:300px;  width:100%; display:flex; align-items:baseline; justify-content:center;">
            		<div style="width:0px; height:100%;"></div>
            		<?php 
            		//$qry_res_lun = "select * from ds_tbl_venta";
            		
            		//$new_fecha_val = date('Y-m-d', strtotime($fecha_val. ' + 5 days'));
            		//$new_fecha_val = date('Y-m-d', strtotime($fecha_val. ' + 5 days'));
            		$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_lun} days"));
            		
            		$fecha_val_start = $new_fecha_val . ' 00:00:00';
            		$fecha_val_end = $new_fecha_val . ' 23:59:59';
            		
            		echo $new_fecha_val;
            		//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
            		//MontoTotalMXN
            		//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
            		$qry_res_lun = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
            		
            		$res_lun = $obj->get_row($qry_res_lun);
            		//print_r($res_lun);
            		$percent_lun = $value_percent * $res_lun->sumatoria;
            		?>
            		<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:<?php echo $percent_lun; ?>%;"></div>
                	<?php 
            		//$qry_res_lun = "select * from ds_tbl_venta";
            		
                	$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_mar} days"));
                	
                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                	
                	echo $new_fecha_val;
                	//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
                	//MontoTotalMXN
                	//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	$qry_res_mar = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	
                	$res_mar = $obj->get_row($qry_res_mar);
                	$percent_mar = $value_percent * $res_mar->sumatoria;
            		?>
            		<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:<?php echo $percent_mar; ?>%;"></div>
                	<?php 
            		//$qry_res_lun = "select * from ds_tbl_venta";
            		
                	$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_mie} days"));
                	
                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                	
                	echo $new_fecha_val;
                	//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
                	//MontoTotalMXN
                	//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	$qry_res_mie = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	
                	$res_mie = $obj->get_row($qry_res_mie);
                	$percent_mie = $value_percent * $res_mie->sumatoria;
            		?>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:<?php echo $percent_mie; ?>%;"></div>
                	<?php 
            		//$qry_res_lun = "select * from ds_tbl_venta";
            		
                	$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_jue} days"));
                	
                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                	
                	echo $new_fecha_val;
                	//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
                	//MontoTotalMXN
                	//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	$qry_res_jue = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	
                	$res_jue = $obj->get_row($qry_res_jue);
                	$percent_jue = $value_percent * $res_jue->sumatoria;
            		?>
            		<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:<?php echo $percent_jue; ?>%;"></div>
                	<?php 
            		//$qry_res_lun = "select * from ds_tbl_venta";
            		
                	$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_vie} days"));
                	
                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                	
                	echo $new_fecha_val;
                	//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
                	//MontoTotalMXN
                	//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	$qry_res_vie = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	
                	$res_vie = $obj->get_row($qry_res_vie);
            		?>
            		<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                	<?php 
            		//$qry_res_lun = "select * from ds_tbl_venta";
            		
                	$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_sab} days"));
                	
                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                	
                	echo $new_fecha_val;
                	//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
                	//MontoTotalMXN
                	//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	$qry_res_sab = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	
                	$res_sab = $obj->get_row($qry_res_sab);
            		?>
            		<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                	<?php 
            		//$qry_res_lun = "select * from ds_tbl_venta";
            		
                	$new_fecha_val = date("Y-m-d", strtotime($fecha_val. " {$val_dom} days"));
                	
                	$fecha_val_start = $new_fecha_val . ' 00:00:00';
                	$fecha_val_end = $new_fecha_val . ' 23:59:59';
                	
                	echo $new_fecha_val;
                	//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
                	//MontoTotalMXN
                	//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	$qry_res_dom = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
                	
                	$res_dom = $obj->get_row($qry_res_dom);
            		?>
            		<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                	
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
                	<div class="graph_home_percent" style=""><?php echo $percent_lun; ?>%</div>
                	<div class="graph_home_percent" style=""><?php echo $percent_mar; ?>%</div>
                	<div class="graph_home_percent" style=""><?php echo $percent_mie; ?>%</div>
                	<div class="graph_home_percent" style=""><?php echo $percent_jue; ?>%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
            	</div>
            </div>
            <div id="graph_home_hours" style="display:none;">
            	
            </div>
        </div>
        
        <?php print_r(phpversion()); ?>
        <br />
        <?php print_r($_SERVER); ?>
        <?php 
        
        $res = $obj->get_results("select * from ds_tbl_venta");
        
        print_r($res);
        ?>
	</body>

</html>

