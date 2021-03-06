<?php
// Include and initialize phpmailer class
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->SMTPAuth = true;
$mail->Username = [email protected]';
$mail->Password = '******';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom([email protected]', 'Programacionnet');
$mail->addReplyTo([email protected]', 'Programacionnet');

// Add a recipient
$mail->addAddress([email protected]');

// Add cc or bcc 
$mail->addCC([email protected]');
$mail->addBCC([email protected]');

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