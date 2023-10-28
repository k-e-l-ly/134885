<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: land.php");
    exit;
  }

  require_once "connect.php";

  $username = $password = "";
  $username_err = $password_err = "";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(empty(trim($_POST['username']))){
      $username_err = 'Please enter username.';
    } else{
      $username = trim($_POST['username']);
    }

    if(empty(trim($_POST['password']))){
      $password_err = 'Please enter your password.';
    } else{
      $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
    
      $sql = 'SELECT username, password FROM tbl_users WHERE username = ?';

      if ($stmt = $conn->prepare($sql)) {

        $param_username = $username;
        $stmt->bind_param('s', $param_username);

        if ($stmt->execute()) {
          $stmt->store_result();

          if ($stmt->num_rows == 1) {
            
            $stmt->bind_result($username, $hashed_password);
            if ($stmt->fetch()) {
              if (password_verify($password, $hashed_password)) {

                session_start();

                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                
                ///header('location: land.php');
                echo "<script>window.location.href='http://localhost/Eyecancer/land.php';</script>";
              
              
              } else {

                $password_err = 'Invalid password';

              }
            }
          } else {

            $username_err = "Username does not exists.";

          }
        } else {
          echo "Oops! Something went wrong please try again";
        }
       
        $stmt->close();
      }

      $conn->close();
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="reg.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <form method="POST" action="log.php">
                <h2>Login</h2>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username">
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <div class="button">
                    <input type="submit" class="btn" value="Login">
                </div>

                <div class="group">
                    <span><a href="userreg.php">Don't have an account? Register</a></span><br><br>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
