<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}

$marcas = $obj->get_results("select * from ds_cat_marca order by Descripcion asc");

//ds_cat_talla
$tallas = $obj->get_results("select * from ds_cat_talla order by Descripcion asc");

$colores = $obj->get_results("select * from ds_cat_color order by Descripcion asc");


$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");

$sustancias = $obj->get_results("select * from ds_cat_tipo_sustancia order by Descripcion asc");

$generos = $obj->get_results("select * from ds_cat_genero order by Descripcion asc");

//ds_cat_tipo_mercado
$tipos_mercado = $obj->get_results("select * from ds_cat_tipo_mercado order by Descripcion asc");

$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");

?>
<style>
.contenedor_dinamico_producto{
	padding:20px;
	background:#DCDCDC;
	margin:2px;
	border-radius:5px;
}
</style>
<div style="width:100%; padding:0 10%;" class="content_form_crear">
<form id="" method="post" action="?" enctype="multipart/form-data">
	<div class="card-header header-elements-inline">
    	<h5 class="card-tit