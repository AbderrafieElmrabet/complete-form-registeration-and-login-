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

  if (!empty($_POST["recoverycode"])) {
    try {
      $recoverycode = $_POST["recoverycode"];

      $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if ($recoverycode == $_SESSION['code']) {
        echo "<span style='color:green;'>&#x2713; account recovered</span>";
      } else {
        echo "<span style='color:red;'>&#9888; recovery code is wrong!</span>";
      }
    } catch (Exception $e) {
      echo "an error occured" . $e->getMessage();
    }
  } else {
    echo "<span style='color:red;'>&#9888; please enter the recovery code!</span>";
  }
}