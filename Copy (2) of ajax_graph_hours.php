<div onclick="$('#graph_home_hours').hide(); $('#graph_home_days').show();" style="text-align:right; cursor:pointer;">
	REGRESAR
</div>
<div style="height:500px;  width:100%;">
	
	<?php for($i=0; $i<=23; $i++): ?>
	<div style="width:100%; display:flex;">
		<div style="width:55px; background:red;"><?php echo $i; ?>:00</div>
		
		<?php if($i%2==0): ?>
		<div style="height:16px; margin:2px 0; background:orange; width:100%;">
			<div style="height:16px; background:purple; width:70%;"></div>
		</div>
		<?php else: ?>
		<div style="height:16px; margin:2px 0; background:orange; width:100%;">
			<div style="height:16px; background:blue; width:50%;"></div>
		</div>
		<?php endif; ?>
		
		<div style="width:55px; background:red;">20%</div>
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
            	<div style="height:30px;  width:100%; display:flex; align-items:baseline; justify-content:center;">
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