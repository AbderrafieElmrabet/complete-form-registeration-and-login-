<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  function clear($check)
  {
    $check = trim($check);
    $check = htmlspecialchars($check);
    $check = stripslashes($check);
    return $check;
  }

  $host = "localhost";
  $database = "loginForms";
  $table = "users";
  $usrname = "root";
  $passcode = "";

  if (!empty($_POST["fullName"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      if ($_POST["password"] == $_POST["cpassword"]) {

        $fullname = clear($_POST["fullName"]);
        $username = clear($_POST["username"]);
        $email = clear($_POST["email"]);
        $password = clear($_POST["password"]);

        if (($_POST["check"]) == "true") {
          try {
            $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $select = $connect->query("SELECT username, email FROM $table WHERE username='$username' OR email='$email'");
            $result = $select->fetch();

            if (empty($result)) {
              $insert = $connect->prepare(
                "INSERT INTO $table (fullname, username, email, password) VALUES (:hello, :username, :email, :password)"
              );

              $insert->bindParam(":hello", $fullname);
              $insert->bindParam(":username", $username);
              $insert->bindParam(":email", $email);
              $insert->bindParam(":password", $password);
              $insert->execute();
              echo "<span style='color:green;'>&#x2713; Your account has been created successfully!</span>";
            } else {
              echo "<span style='color:red;'> &#9888; email or username already exist!</span>";
            }
          } catch (Exception $e) {
            echo "an error occured" . $e->getMessage();
          }
        } else {
          echo "<span style='color:red;'> &#9888; You must agree to the terms and conditions!</span>";
        }
      } else {
        echo "<span style='color:red;'> &#9888; passwords don't match!</span>";
      }
    } else {
      echo "<span style='color:red;'> &#9888; invalid email!</span>";
    }
  } else {
    echo "<span style='color:red;'> &#9888; Full name, Username and Password are required!</span>";
  }
}
