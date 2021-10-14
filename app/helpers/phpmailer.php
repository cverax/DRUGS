<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../../libraries/phpmailer/src/Exception.php');
require_once('../../libraries/phpmailer/src/PHPMailer.php');
require_once('../../libraries/phpmailer/src/SMTP.php'); 
require_once('../../libraries/phpmailer52/class.smtp.php'); 


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug =0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'drugsinternationalservice@gmail.com';                     //SMTP username
    $mail->Password   = 'Luis123.';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('drugsinternationalservice@gmail.com', 'Administracion');
    $mail->addAddress($_SESSION['correo']); 

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Recupere su contraseña';
    $mail->Body    = 'recupere su contraseña<a href="http://localhost/GitHub/DRUGS/views/recuperacion.php?token='.$_SESSION['token'].'">Este Link</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}