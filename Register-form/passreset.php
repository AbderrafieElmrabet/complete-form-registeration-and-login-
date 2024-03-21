<?php
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

  if (!empty($_POST["newpass"])) {
    if ($_POST["newpass"] == $_POST["cnewpass"]) {
      try {
        $newpass = $_POST["newpass"];
        $email = $_SESSION["email"];

        $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE $table SET password = :password WHERE email = :email";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':password', $newpass);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo "<span style='color:green;'>&#9888; password has been reset!</span> <br> $email's new password is $newpass";
      } catch (Exception $e) {
        echo "an error occured" . $e->getMessage();
      }
    } else {
      echo "<span style='color:red;'>&#9888; passwords don't match!</span>";
    }
  } else {
    echo "<span style='color:red;'>&#9888; please enter a new password!</span>";
  }
}
