<?php
include("includes/includes.php");
// Include and initialize phpmailer class
//require 'PHPMailer/PHPMailerAutoload.php';
//require 'class.phpmailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//existencias_actual=10&existencias_nuevas=8&id_producto=10
$usuario_actual = $_GET["usuario"];
$existencias_actual = $_GET["existencias_actual"];
$existencias_nuevas = $_GET["existencias_nuevas"];
$id_producto = $_GET["id_producto"];


//function enviar_correo($existencias_actual, $existencias_nuevas, $id_producto){




require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



function generarCSV($arreglo, $ruta, $delimitador, $encapsulador){
    $file_handle = fopen($ruta, 'w');
    foreach ($arreglo as $linea) {
        fputcsv($file_handle, $linea, $delimitador, $encapsulador);
    }
    rewind($file_handle);
    fclose($file_handle);
}

$arreglo[0] = array("xaNombre","xbApellido","xcAnimal","xdFruto");
$arreglo[1] = array("xaJuan","Juarez","Jirafa","Jicama");
$arreglo[2] = array("xbMaria","Martinez","Mono","Mandarina");
$arreglo[3] = array("xcEsperanza","Escobedo","Elefante","Elote");
//$ruta ="C:/mi_archivo.csv";
$ruta ="./archivo.csv";
generarCSV($arreglo, $ruta, $delimitador = ';', $encapsulador = '"');



$mail = new PHPMailer;
// SMTP configuration
$mail->isSMTP();
$mail->Host = 'mail.cabastic.info';
$mail->SMTPAuth = true;
$mail->Username = 'notificaciones@cabastic.info';
$mail->Password = 'n0t1f1c4c10n3s';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
//$mail->Port = 465;


$mail->setFrom('notificaciones@cabastic.info', 'Notificaciones');
$mail->addReplyTo('notificaciones@cabastic.info', 'Notificaciones');

// Add a recipient
$mail->addAddress('hector@aguitech.com');
//$mail->addAddress('israel.aguilar@divagsystems.com');
//$mail->addAddress('tanya.martinezbaca.rivera@gmail.com');
//$mail->addAddress('jjimenez@cabastic.com');

// Add cc or bcc
//$mail->addCC([email protected]');
//$mail->addBCC([email protected]');

//Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
$mail->addAttachment('./archivo.csv', 'orden_compra.csv');

// Email subject
$mail->Subject = 'Alerta de existencias';

// Set email format to HTML
$mail->isHTML(true);

// Email body content
$mailContent = "<h3>Actualizaci&oacute;n de existencias</h3>
        <p>Se han modificado existencias.</p>";

/**
 $mailContent = "<h1>Aguitech</h1>
 <p>This is a test email has sent using SMTP mail server with PHPMailer.</p>";
 
 $qry_resultados = "select * from ds_cat_marca order by Descripcion asc";
 
 $resultados = $obj->get_results($qry_resultados);
 
 foreach($resultados as $resultado){
 $mailContent .= $resultado->Descripcion . "<br />";
 
 }
 
 $mailContent .= "Se actualizo el producto:<br />";
 
 */

$tbl_main = "ds_tbl_producto";

$qry_producto_val = "select * from ds_tbl_producto where Id_Producto = {$id_producto}";
//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen, ds_cat_categoria_producto.Descripcion as categoria from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen left join ds_cat_categoria_producto on ds_cat_categoria_producto.Id_Categoria_Producto = ds_tbl_producto.Id_Categoria_Producto group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
$qry_producto_val = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen, ds_cat_categoria_producto.Descripcion as categoria from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen left join ds_cat_categoria_producto on ds_cat_categoria_producto.Id_Categoria_Producto = ds_tbl_producto.Id_Categoria_Producto where ds_tbl_producto.Id_Producto = {$id_producto} group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";


$producto_val = $obj->get_row($qry_producto_val);

$mailContent .= $usuario_actual;
$mailContent .= " actualiz&oacute; el producto:<br />";

$mailContent .= $producto_val->Nombre . "<br />";
$mailContent .= "Descripci&oacute;n: " . $producto_val->descripcion_producto . "<br />";
$mailContent .= "Marca: " . $producto_val->marca . "<br />";
$mailContent .= "Talla: " . $producto_val->talla . "<br />";
$mailContent .= "Color: " . $producto_val->color . "<br />";


$mailContent .= "Disminuy&oacute; de {$existencias_actual} a {$existencias_nuevas}:<br />";
$mailContent .= date("Y-m-d H:i");

$mail->Body = $mailContent;

// Send email
if(!$mail->send()){
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    //echo 'Message has been sent';
}
//}


//enviar_correo(1, 2, 10);