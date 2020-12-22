<?php include("includes/includes.php"); 
//2020-08-28
$fecha_val = '2020-08-28';
$fecha_val_start = $fecha_val . ' 00:00:00';
$fecha_val_end = $fecha_val . ' 23:59:59';
//$qry_hours = "select * from ds_tbl_venta where Fecha_Venta = date('2020-08-28')";
//MontoTotalMXN
//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
$qry_hours = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
echo $qry_hours;
$res_hours = $obj->get_results($qry_hours);
print_r($res_hours);


$value_percent = 100 / $res_hours[0]->sumatoria;

echo $value_percent;
?>
<hr />
<style>
.graph_home_hours{
	height:16px; margin:2px 0; width:100%;
    /*background: red;*/ /* For browsers that do not support gradients */
    /*background: linear-gradient(-90deg, red, yellow); *//* Standard syntax (must be last) */
}
.graph_home_hour{
	background:purple;
	background: linear-gradient(-90deg, red, yellow);
	width:70%;
	height:16px;
	
	border-radius:0 4px 4px 0;
	
}
</style>
<div onclick="$('#graph_home_hours').hide(); $('#graph_home_days').show();" style="text-align:right; cursor:pointer;">
	REGRESAR
</div>
<div style="height:500px;  width:100%;">
	
	<?php for($i=0; $i<=23; $i++): ?>
	<div style="width:100%; display:flex;">
		<div style="width:55px; text-align:right; padding-right:5px; border-right:1px solid gray;"><?php echo $i; ?>:00</div>
		
		<?php 
		//str_pad($value, 8, '0', STR_PAD_LEFT);
		$i_hours = str_pad($i, 2, '0', STR_PAD_LEFT);
		$fecha_val_start = $fecha_val . ' ' . $i_hours . ':00:00';
		$fecha_val_end = $fecha_val . ' ' . $i_hours . ':59:59';
		//MontoTotalMXN
		//$qry_hours = "select *, sum(MontoTotal) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
		$qry_hours = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_val_start}' and Fecha_Venta <= '{$fecha_val_end}'";
		//echo $qry_hours;
		
		
		$res_hour = $obj->get_row($qry_hours);
		
		$val_percent_hour = $res_hour->sumatoria * $value_percent;
		
		//echo $val_percent_hour;
		?>
		
		<?php if($i%2==0): ?>
		<div class="graph_home_hours">
			<div class="graph_home_hour" style="width:<?php echo number_format($val_percent_hour, 1, '.', ','); ?>%;"></div>
		</div>
		<?php else: ?>
		<div class="graph_home_hours">
			<div class="graph_home_hour" style="width:<?php echo number_format($val_percent_hour, 1, '.', ','); ?>%;"></div>
		</div>
		<?php endif; ?>
		
		<div style="width:65px; text-align:center;"><?php echo number_format($val_percent_hour, 1, '.', ','); ?>%</div>
	</div>
	<?php endfor; ?>
</div>
<?php /**
<div style="height:300px;  width:100%; display:flex; align-items:baseline; justify-content:center;">
            		<div style="width:0px; height:100%;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:90%;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:100px;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50%;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
            	</div>
            	<div style="height:30px; width:100%; display:flex; align-items:baseline; justify-content:center; border-top:1px solid gray;">
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
                	<div class="graph_home_percent" style="">90%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
            	</div>
            	*/ ?>