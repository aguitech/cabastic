<?php include("includes/includes.php");
include_once("login.php");
include("common_files/sesion.php");
?>
<?php
include_once("db.php");
?>
<?php 
$nombre_seccion = "Asignar costo compra";
$tbl_main = "ds_tbl_producto";
$nombre_simple = "producto";
$url_name = "productos.php";
$url_crear_name = "crear_producto.php";


unset ($_SESSION["cantidad_productos"]);
unset ($_SESSION["producto"]);
unset ($_SESSION["precio"]);
unset ($_SESSION["cantidad"]);

/*
$_SESSION["cantidad_productos"] = "";
$_SESSION["producto"] = "";
$_SESSION["precio"] = "";
$_SESSION["cantidad"] = "";
*/
$_SESSION["cantidad_productos"] = "";
$_SESSION["producto"];
$_SESSION["precio"];
$_SESSION["cantidad"];


//print_r($_POST);





//if($_POST["id_producto"] != "" && $_POST["costo_compra"] != "" && $_POST[""] != "" && $_POST[""] != "" && $_POST[""] != "" && $_POST[""] != ""){
if($_POST["id_producto"] != "" && $_POST["id_producto_detalle"] != "" && $_POST["costo_compra"] != "" ){
    $id_producto = $_POST["id_producto"];
    $id_producto_detalle = $_POST["id_producto_detalle"];
    $costo_compra = $_POST["costo_compra"];
    $impuesto_adicional = $_POST["impuesto_adicional"];
    $costo_dolares = $_POST["costo_dolares"];
    $iva = $_POST["iva"];
    $fecha_actualizacion = date("Y-m-d H:i:s");
    
    $qry_costo_producto_actual = "select * from ds_tbl_costo_compra_producto where ds_tbl_costo_compra_producto.Id_Producto_Detalle = $id_producto_detalle";
    $precio_producto_actual = $obj->get_row($qry_costo_producto_actual);
    
    print_r($precio_producto_actual);
    echo $precio_producto_actual->Costo_Compra;
    if($precio_producto_actual->Costo_Compra != ""){
        //UPDATE
        
        $id_costo_compra_producto = $precio_producto_actual->Id_Costo_Producto;
        $costo_compra_anterior = $precio_producto_actual->Costo_Compra;
        //$qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //$qry_insert_costo_producto_actual = "insert into  (Id_Producto_Detalle, , , , , , , , ) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares, $costo_dolares)";
        //echo "HEY";
        //$qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $costo_dolares, Valor_Tipo_Cambio_Anterior = $costo_dolares)";
        //$precio_producto_actual = $obj->get_results($qry_precio_producto_actual);
        $qry_update_costo_producto = "update ds_tbl_costo_compra_producto set Costo_Compra = $costo_compra, Costo_Compra_Anterior = $costo_compra_anterior, Impuesto_Adicional = $impuesto_adicional, IVA = $iva, Fecha_Actualiza = '{$fecha_actualizacion}', Dolar = $costo_dolares, Valor_Tipo_Cambio_Dolar = $costo_dolares, Valor_Tipo_Cambio_Anterior = $costo_dolares where Id_Producto_Detalle = $id_producto_detalle and Id_Costo_Producto = $id_costo_compra_producto";
        //echo $qry_update_costo_producto;
        $obj->query($qry_update_costo_producto);
        
    }else{
        //echo "HOLA";
        //INSERT
        //
        //Id_Costo_Producto 	 	Costo_Mxn 	Costo_Dolar 	 	 	 	 	 	 	Euro 	Libra 	 	
        
        $qry_insert_costo_producto_actual = "insert into ds_tbl_costo_compra_producto (Id_Producto_Detalle, Costo_Compra, Costo_Compra_Anterior, Impuesto_Adicional, IVA, Fecha_Actualiza, Dolar, Valor_Tipo_Cambio_Dolar, Valor_Tipo_Cambio_Anterior) values ($id_producto_detalle, $costo_compra, $costo_compra, $impuesto_adicional, $iva, '{$fecha_actualizacion}', $costo_dolares, $costo_dolares