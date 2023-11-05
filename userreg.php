<?php
require 'C:\xampp\htdocs\Eyecancer\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Eyecancer\vendor\phpmailer\phpmailer\src\SMTP.php';
require 'C:\xampp\htdocs\Eyecancer\vendor\phpmailer\phpmailer\src\Exception.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "eyecancer";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array(); // Create an array to store validation errors

    $username = $_POST['username'];
    $email = $_POST['email'];
    $raw_password = $_POST['password'];
    $dateofbirth = $_POST['dateofbirth'];
    $gender = $_POST['gender'];

    // Validate inputs
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    }

    if (empty($raw_password)) {
        $errors[] = "Password is required.";
    }

    if (count($errors) == 0) {
        // Hash the password
        $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

        // Set the role_id for users (assuming 2 is for users)
        $role_id = 2;

        // Generate a verification code
        $verification_code = md5(uniqid(rand(), true));

        // Store the verification information in the tbl_verification table
        $insert_verification_query = "INSERT INTO tbl_verificaton (role_id, verification_code, email) VALUES (?, ?, ?)";

        $stmt_verification = $conn->prepare($insert_verification_query);
        $stmt_verification->bind_param("iss", $role_id, $verification_code, $email);

        if ($stmt_verification->execute()) {
            // Registration successful, send a verification email
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            // Set up your SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kelly.mbai@gmail.com';
            $mail->Password = 'vwwk bovk ltmp qrid';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set email parameters
            $mail->setFrom('verification@eyetest.com', 'Your Name');
            $mail->addAddress($email, $username);
            $mail->isHTML(true);
            $mail->Subject = 'Verify Your Email';

            // Create a verification link with the verification code
            $verification_link = 'http://eyetest.com/verify.php?code=' . $verification_code;
            $mail->Body = "Click the following link to verify your email: <a href='$verification_link'>$verification_link</a>";

            if ($mail->send()) {
                // Email sent successfully
                header("location: verify.php");
                exit;
            } else {
                echo "Email sending failed. Please try again later.";
            }

            // Close the verification insertion statement
            $stmt_verification->close();
        } else {
            echo "Registration failed. Please try again later.";
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="reg.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class = "container">

         <div class = "form-box">
            <form id="registration form" method="POST" action="userreg.php" >
                <h2>Register Here</h2>
                <div class="input-box">
                    <input type="text" name="username" placeholder ="username">
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder ="Email">
                </div>

                <!--<div class="input-box">
                    <input type="email" name="phonenumber" placeholder ="Phone Number">
                </div>-->

                <div class="input-box">
                    <input type="password" name="password" placeholder ="Password">
                </div>

                <div class="input-box">
                    <input type="password" name="confirmpassword" placeholder ="Confirm Password">
                </div>

                <div class="input-box">
                    <input type="date" name="dateofbirth" required>
                </div>

                <div class="input-box">
                    <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                    </select>
                </div>

                <div class="button">
                    <input type="submit" class="btn" value="Register" onclick="redirectToAnotherPage()">
                </div>

                <div class="group">
                    <span><a href= "log.php" >Have an account? Login</a><span><br><br>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript function to redirect to another page
        function redirectToAnotherPage() {
            // Replace 'landing.php' with the URL of the desired page
            window.location.href = 'verify.php';
        }
    </script>

</body>
</html>