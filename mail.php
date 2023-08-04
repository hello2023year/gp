<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'smtp.yandex.ru';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'arni@74.ru';                     //SMTP username
  $mail->Password   = 'Roschin730';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
  $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('arni@74.ru', 'heloGood');
  $mail->addAddress('kennedy.brenon@mail.ru', 'Joe User');     //Add a recipient

  //    $mail->addReplyTo('info@example.com', 'Information');
  //    $mail->addCC('cc@example.com');
  //    $mail->addBCC('bcc@example.com');

  //Attachments
  //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Here is the subject';
  $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  // $mail->send();
  echo 'Message has been sent';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Enter E-mail Data</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }

    input[type=text],
    select,
    textarea {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }

    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    input[type=reset] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: left;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    }

    .col-25 {
      float: left;
      width: 20%;
      margin-top: 0px;
    }

    .col-75 {
      float: left;
      width: 80%;
      margin-top: 0px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .main_iframe {
      width: 100%;
      height: 100px;
      z-index: 1;
      border-style: none;

    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

      .col-25,
      .col-75,
      input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <form action="mailer.php" method="POST">
      <div class="row">
        <div class="col-25">
          <label for="nameFrom">from_name</label>
        </div>
        <div class="col-75">
          <input type="text" id="nameFrom" name="nameFrom" placeholder="from_name">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="from">from</label>
        </div>
        <div class="col-75">
          <input type="text" id="from" name="from" placeholder="from">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="to">To:</label>
        </div>
        <div class="col-75">
          <textarea id="to" name="to" placeholder="Write anyone.." style="height:100px"></textarea>
        </div>
      </div>



      <div class="row">
        <div class="col-25">
          <label for="subject">subject</label>
        </div>
        <div class="col-75">
          <input type="text" id="subject" name="subject" placeholder="No subject">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="Message">Message</label>
        </div>
        <div class="col-75">
          <textarea id="message" name="message" placeholder="Write Message" style="height:100px"></textarea>
        </div>
      </div>


      <div class="row">
        <input type="submit" value="Send">
        <input type="reset" value="Reset" />
      </div>
    </form>
  </div>

</body>

</html>