<?php
// Include and initialize phpmailer class
//require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/src/PHPMailer.php';
$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'mail.cabastic.info';
$mail->SMTPAuth = true;
$mail->Username = 'notificaciones@cabastic.info';
$mail->Password = 'n0t1f1c4c10n3s';
$mail->SMTPSecure = 'tls';
//$mail->Port = 587;
$mail->Port = 465;


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
$mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
    <p>This is a test email has sent using SMTP mail server with PHPMailer.</p>";
$mail->Body = $mailContent;

// Send email
if(!$mail->send()){
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo 'Message has been sent';
}