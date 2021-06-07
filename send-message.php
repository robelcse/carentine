<?php
require 'includes/mailer/src/Exception.php';
require 'includes/mailer/src/PHPMailer.php';
require 'includes/mailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mesaages ="The email below was sent via your website's Contact form.<br>" ;
$mesaages.="---------------------------------------------------"."<br>";
$mesaages.="Name: ".htmlentities($_POST['name'])."<br>";
$mesaages.="Email: ".htmlentities($_POST['email'])."<br>";
$mesaages.="Message: ".htmlentities($_POST['message'])."<br>";
$mesaages.="---------------------------------------------------"."<br>";


$mail = new PHPMailer(true);

try {
    $mail->IsSMTP();                                //Use SMTP
    $mail->SMTPDebug   = 2;                         //2 to enable SMTP debug information
    $mail->Host        = "mail.carentine.com";   //Sets SMTP server
    $mail->Port        = 587;                       //set the SMTP port
    $mail->SMTPAuth    = TRUE;                      //enable SMTP authentication
    $mail->SMTPSecure  = "tls";                     //Secure conection
    $mail->Username    = 'contact@carentine.com';   //SMTP account username
    $mail->Password    = 'iUQ,{fa$V0M)';   
    $mail->IsHTML(true);
    $mail->addAddress('contact@carentine.com', '');
    $mail->From        = 'contact@carentine.com';
    $mail->FromName    = 'Carentine';
    $mail->Subject     = 'Message from Contact Form';
    $mail->Body        = $mesaages;
    $mail->AltBody     = 'This is the body in plain text for non-HTML mail clients';
    $mail->WordWrap    = 50; // set word wrap to 50 characters

  if($mail->send()){
        echo 1;
   }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
