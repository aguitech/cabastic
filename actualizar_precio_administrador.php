<?php include("includes/includes.php");?>
<?php include("common_files/sesion.php"); ?>
<?php
//print_r($_POST);
?>
<?php 
//print_r($_SESSION);
?>
<?php foreach($_SESSION["producto"] as $clave => $valor){ ?>
	<?php $i = $clave; ?>
	<?php if($_SESSION["producto"][$i] == $_POST["id_producto"]){ ?>
		<?php $_SESSION["precio"][$i] = $_POST["valor"]; ?>
		
		
		$<?php echo number_format($_SESSION["precio"][$i] * $_SESSION["cantidad"][$i], 2); ?>
		
	<?php } ?>
	
	
<?php } ?>
<?php 
//print_r($_SESSION);
?>
    <?php /**
<?php echo $_SESSION["cantidad"][$i]; 
number_format($_SESSION["precio"][$i] * $_SESSION["cantidad"][$i], 2);
?>

    	<?php if($_SESSION["cantidad"][$i] != 0){ ?>
    	
    	<?php } ?>
*/ ?>