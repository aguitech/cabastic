<?php include("includes/includes.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=1" />
		
	</head>
	<body>
		<style>
        .graph_home{
        	background:orange;
        	width:10%;
        	margin:0 2%;
        }
        </style>
        <div style=" height:300px; background:red;">
        	<div style="height:300px;  width:100%; display:flex; align-items:baseline; justify-content:center;">
        		<div style="width:0px; height:100%;"></div>
            	<div class="graph_home" style="height:50px;"></div>
            	<div class="graph_home" style="height:100px;"></div>
            	<div class="graph_home" style="height:50px;"></div>
            	<div class="graph_home" style="height:50%;"></div>
            	<div class="graph_home" style="height:50px;"></div>
            	<div class="graph_home" style="height:50px;"></div>
            	<div class="graph_home" style="height:50px;"></div>
        	</div>
        	Hola
        	
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

