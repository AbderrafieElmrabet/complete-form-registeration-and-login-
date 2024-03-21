<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer-master/mailer/autoload.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  function clear($check)
  {
    $check = htmlspecialchars($check);
    $check = stripslashes($check);
    $check = trim($check);
    return $check;
  }

  $host = "localhost";
  $database = "loginForms";
  $table = "users";
  $usrname = "root";
  $passcode = "";

  if (!empty($_POST["email"])) {
    try {
      $mail = new PHPMailer();
      $email = $_POST["email"];

      $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $select = $connect->query("SELECT email FROM $table WHERE email='$email'");
      $element = $select->fetch();

      if (!empty($element)) {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'reedrazor420@gmail.com';
        $mail->Password = 'vdktvfbehtcubssx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->isSMTP();
        $mail->setFrom('reedrazor420@gmail.com', 'ReedRazor');
        $mail->addAddress($email);
        $mail->Subject = "Validation Code";
        $code = rand(100000, 999999);
        $_SESSION["code"] = $code;
        $_SESSION["email"] = $email;
        $mail->Body = "<span>Email address validation code : <h3 style='color:blue;'>$code</h3></span>";
        $mail->isHTML(true);

        $mail->send();

        echo "<span style='color:green;'>&#x2713; email found and code sent</span>";
      } else {
        echo "<span style='color:red;'>&#9888; email is not associated with an account!</span>";
      }
    } catch (Exception $e) {
      echo "an error occured" . $e->getMessage();
    }
  } else {
    echo "<span style='color:red;'>&#9888; please enter your email!</span>";
  }
}
