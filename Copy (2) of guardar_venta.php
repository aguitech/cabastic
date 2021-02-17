<?php 
include("includes/includes.php");

print_r($_POST);

?>
<br />
<?php print_r($_SESSION); ?>
<?php  ?>
<?php 
$indice_actual = 0;
foreach($_SESSION["producto"] as $producto){
    
    $producto_val = $_SESSION["producto"][$indice_actual];
    $cantidad_val = $_SESSION["cantidad"][$indice_actual];
    $precio_val = $_SESSION["precio"][$indice_actual];
    
    
    
    
    $indice_actual++;
}
?>
