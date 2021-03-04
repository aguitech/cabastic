<?php include("includes/includes.php");
?>
<?php 
//print_r($_POST);


$costo = $_POST["costo"];
$divisa = $_POST["divisa"];
$checkboxes_str = str_replace("&", "", $_POST["checkboxes"]);

$checkboxes_explode = explode("checkbox=", $checkboxes_str);
//print_r($checkboxes_explode);

if($checkboxes_explode[0] == ""){
    unset($checkboxes_explode[0]);
}

?>
<?php /**
<?php foreach($checkboxes_explode as $checkbox_id): ?>
	<?php echo $checkbox_id; ?>
<?php endforeach; ?>
*/ ?>
<script>
alert("Test");
/*
actualizar_costo_masivo(costo, id, divisa);
*/
<?php foreach($checkboxes_explode as $checkbox_id): ?>
actualizar_costo_masivo(<?php echo $costo; ?>, <?php echo $checkbox_id; ?>, <?php echo $divisa; ?>);

<?php endforeach; ?>
</script>