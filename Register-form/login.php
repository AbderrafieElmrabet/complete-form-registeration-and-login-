<?php
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

  if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    try {

      $email = $_POST["email"];
      $password = $_POST["password"];

      $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $select = $connect->query("SELECT email, password FROM $table WHERE email='$email'");
      $element = $select->fetch();

      if (!empty($element)) {
        if ($element["password"] == $password) {
          echo "<span style='color:green;'>&#x2713; You have logged in successfully!</span>";
        } else {
          echo "<span style='color:red;'>&#9888; wrong password!</span>";
        }
      } else {
        echo "<span style='color:red;'>&#9888; email does not exist!</span>";
      }
    } catch (Exception $e) {
      echo "an error occured" . $e->getMessage();
    }
  } else {
    echo "<span style='color:red;'>&#9888; please enter your email and password!</span>";
  }
}
