<?php
$globalobj = new post();
$globalobj->get_query = "select titulo, DATE_FORMAT(fecha, '%d') as dia, DATE_FORMAT(fecha, '%c') as mes, permalink from post order by id_post desc limit 4";
$_posts = $globalobj->get();

$globalobj->get_query = "select categoria, permalink from categoria order by categoria asc limit 7";
$_cats = $globalobj->get();

if(curpage() == "index.php")
	$globalpath = "./";
else 
	$globalpath = "../";