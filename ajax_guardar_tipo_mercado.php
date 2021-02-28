<?php include("includes/includes.php");
$descripcion_val = $_POST["descripcion"];
if($_POST["descripcion"] != ""){
    $qry_insert = "insert into ds_cat_tipo_mercado (Descripcion) values ('{$descripcion_val}')";
    $obj->query($qry_insert);
}


$tipos_mercado = $obj->get_results("select * from ds_cat_tipo_mercado order by Descripcion asc");
?>
<?php foreach($tipos_mercado as $tipo_mercado): ?>
<option value="<?php echo $tipo_mercado->Id_Tipo_Mercado; ?>" ><?php echo $tipo_mercado->Descripcion; ?></option>
<?php endforeach; ?>