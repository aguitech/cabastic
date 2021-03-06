<?php
include("includes/includes.php");
session_start();

/*
$categoria = new categoria();
$categoria->get_query = "select * from categoria where status = 1";
$categorias = $categoria->get();
*/

$_POST["correo"] = "aguitech@aguitech.com";
$_POST["nombre"] = "Hector";
$_POST["telefono"] = "hwy";
$_POST["mensaje"] = "hola";

if($_POST["correo"] != ""){
    $subject = "Contacto desarrollo de software Aguitech.";
    /**
    $body = '
	<center><a href="https://aguitech.com"><img src="https://aguitech.com/blue/images/logo_aguitech/Aguitech_logo.png" alt="Aguitech" style="width:300px;" /></a></center>
	';
    */
    $email = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $mensaje = $_POST["mensaje"];
    
    //if($enviar){
    $body .= "<div style='font-size:16px; color:#003D7B;'>Hola " . $nombre . ",</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Gracias por escribirnos,</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>" . $mensaje . "</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>En un momento personal de nuestro equipo o uno de nuestros creadores se comunicar&aacute; contigo al siguiente n&uacute;mero " . $telefono . ".</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Si no puedes esperar te dejo nuestro contacto:</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>E-mail. hola@aguitech.com</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Tel&eacute;fono. 55445249906</div>";
    
    $body_cliente = $body . "<div style='margin-top:20px; border-radius:7px; padding:20px; border:1px solid #003D7B; background-color:white; color:#003D7B;'>Aguitech Solutions<br /><br />Tel&eacute;fono: 55 45 24 99 06<br /><br />E-mail: hola@aguitech.com<br /></div>";
    
    
    echo $body;
    
    //emailSend($subject, $body_cliente, $email);
    
    
    $body .= "<div style='margin-top:20px; border-radius:7px; padding:20px; border:1px solid #003D7B; background-color:white; color:#003D7B;'>" . $_POST["nombre_cotizacion"] . "<br /><br />" . $_POST["telefono_cotizacion"] . "<br /><br />E-mail: " . $email . "<br /></div>";
    emailSend("Contacto desarrollo de software Aguitech", $body, "hector@aguitech.com");
    echo "<script>alert('E-mail enviado " . $email . "');</script>";
}
?>
HOla