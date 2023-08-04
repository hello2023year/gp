<?php

$File = "output.txt";
$Handle = fopen($File, 'a');

$log = gmdate("D, d M Y H:i:s");
$log .= "\r\n";



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$email_array = array();

if ($_POST) {

   $name = trim(stripslashes($_POST['name']));
   $email = trim(stripslashes($_POST['email']));
   $subject = trim(stripslashes($_POST['subject']));
   $contact_message = trim(stripslashes($_POST['message']));
   $hostname = trim(stripslashes($_POST['hostname']));
   $username = trim(stripslashes($_POST['username']));
   $password = trim(stripslashes($_POST['password']));
   $port = trim(stripslashes($_POST['port']));

   if ($subject == '') {
      $subject = "Contact Form Submission";
   }

   //    $hostname = "smtp.yandex.ru";

   //    $username = "arni@74.ru";

   //    $password = "Roschin730";

   //    $port = 587;

   $email_array = explode("\n", $email);
}

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = $hostname;                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = $username;                     //SMTP username
$mail->Password   = $password;                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
$mail->Port       = intval($port);                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->SMTPKeepAlive = true;
$mail->isHTML(true);
$mail->setFrom($username, $name);
$mail->Subject = $subject;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->CharSet = "UTF-8";



foreach ($email_array as $email) {
   $mail->addAddress($email);
   $base64_encoded_email =  base64_encode($email);
   $updated_contact_message = str_replace("https://fixclo.site/security/password", "https://fixclo.site/security/password?u=" . $base64_encoded_email, $contact_message);

   $mail->Body = $updated_contact_message;
   try {
      $mail->send();
      fwrite($Handle, $log . "Message sent to: ({$email}) {$mail->ErrorInfo}\n" . $subject . "\n\n\n");
      echo "Message sent to: ({$email}) {$mail->ErrorInfo}\n";
   } catch (Exception $e) {
      fwrite($Handle, $log . "Mailer Error ({$email}) {$mail->ErrorInfo}\n" . $subject . "\n\n\n");

      echo "Mailer Error ({$email}) {$mail->ErrorInfo}\n";
   }
   $mail->clearAddresses();
}
$mail->smtpClose();

fclose($Handle);
