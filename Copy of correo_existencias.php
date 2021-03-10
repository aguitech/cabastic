<?php
include("includes/includes.php");
// Include and initialize phpmailer class
//require 'PHPMailer/PHPMailerAutoload.php';
//require 'class.phpmailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$existencias_actual = 1;
$existencias_nuevas = 1;
$id_producto = 10;


//function enviar_correo($existencias_actual, $existencias_nuevas, $id_producto){
       
    
    
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
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
    
    
    $mail->setFrom('notificaciones@cabastic.info', 'Programacionnet');
    $mail->addReplyTo('notificaciones@cabastic.info', 'Programacionnet');
    
    // Add a recipient
    $mail->addAddress('hector@aguitech.com');
    
    // Add cc or bcc
    //$mail->addCC([email protected]');
    //$mail->addBCC([email protected]');
    
    // Email subject
    $mail->Subject = 'Send Email via SMTP using PHPMailer';
    
    // Set email format to HTML
    $mail->isHTML(true);
    
    // Email body content
    $mailContent = "<h1>Aguitech</h1>
        <p>This is a test email has sent using SMTP mail server with PHPMailer.</p>";
    
    $qry_resultados = "select * from ds_cat_marca order by Descripcion asc";
    
    $resultados = $obj->get_results($qry_resultados);
    
    foreach($resultados as $resultado){
        $mailContent .= $resultado->Descripcion . "<br />";
        
    }
    
    $mailContent .= "Se actualizo el producto:<br />";
    
    $qry_producto_val = "select * from ds_tbl_producto where Id_Producto = {$id_producto}";
    $producto_val = $obj->get_row($qry_producto_val);
    
    $mailContent .= "Se actualizo el producto:<br />";
    $mailContent .= $producto_val->Nombre . "<br /><br />";
    $mailContent .= "paso de {$existencias_actual} a {$existencias_nuevas}:<br />";
    
    
    
    
    $mail->Body = $mailContent;
    
    // Send email
    if(!$mail->send()){
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }else{
        echo 'Message has been sent';
    }
//}


//enviar_correo(1, 2, 10);

