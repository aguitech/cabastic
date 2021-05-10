<?php include("includes/includes.php"); ?>

<?php print_r(phpversion()); ?>
<br />
<?php print_r($_SERVER); ?>
<?php 

$res = $obj->get_results("select * from ds_cat_color");

print_r($res);
?>
