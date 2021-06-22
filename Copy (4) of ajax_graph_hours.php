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
		
		<?php if($i%2==0): ?>
		<div class="graph_home_hours">
			<div class="graph_home_hour" style="width:70%;"></div>
		</div>
		<?php else: ?>
		<div class="graph_home_hours">
			<div class="graph_home_hour" style="width:50%;"></div>
		</div>
		<?php endif; ?>
		
		<div style="width:55px; text-align:center;">21%</div>
	</div>
	<?php endfor; ?>
</div>

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