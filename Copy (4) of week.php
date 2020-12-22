<?php include("includes/includes.php"); ?>
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
        	<div id="graph_home_days">
            	<div style="height:300px;  width:100%; display:flex; align-items:baseline; justify-content:center;">
            		<div style="width:0px; height:100%;"></div>
                	<div class="graph_home" onclick="mostrar_horarios_home(1)" style="height:50px;"></div>
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
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
                	<div class="graph_home_percent" style="">28%</div>
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

