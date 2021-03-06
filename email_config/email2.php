<?php
$to      = 'hector@aguitech.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: notificaciones@cabastic.info' . "\r\n" .
    'Reply-To: notificaciones@cabastic.info' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 