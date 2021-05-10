<?php include("includes/includes.php");
include("common_files/sesion.php");
?>
<?php 
$total = 0;
$i = 0;
foreach($_SESSION["producto"] as $resultado){
    $total += $_SESSION["cantidad"][$i] * $_SESSION["precio"][$i];
    //echo $total . "<br />";
    $i++;
}
echo "$" . number_format($total, 2);
?>