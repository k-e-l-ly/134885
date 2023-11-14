<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: land.php");
        die();
    }

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    include 'connect.php';
    $msg = "";

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $dateofbirth = mysqli_real_escape_string($conn, $_POST['dateofbirth']);
        $code = mysqli_real_escape_string($conn, md5(rand()));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has already been used.</div>";
        } else {
            if ($password === $confirm_password) {
                $role_id = 2; // Set the role_id

                $sql = "INSERT INTO tbl_users (username, email, password, gender, dateofbirth, role_id, code) 
                        VALUES ('{$username}', '{$email}', '{$password}', '{$gender}', '{$dateofbirth}', '{$role_id}', '{$code}')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<div style='display: none;'>";
                    // Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        // Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
                        $mail->isSMTP();  // Send using SMTP
                        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
                        $mail->SMTPAuth = true;  // Enable SMTP authentication
                        $mail->Username = 'kelly.mbai@strathmore.edu';  // SMTP username
                        $mail->Password = 'vwwk bovk ltmp qrid';  // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Enable implicit TLS encryption
                        $mail->Port = 465;  // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        // Recipients
                        $mail->setFrom('kelly.mbai@strathmore.edu');
                        $mail->addAddress($email);

                        // Content
                        $mail->isHTML(true);  // Set email format to HTML
                        $mail->Subject = 'no reply';
                        $mail->Body = 'Here is the verification link <b><a href="http://localhost/simple/index.php?verification='.$code.'">http://localhost/simple/index.php?verification='.$code.'</a></b>';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>We've sent a verification link to your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Something went wrong.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
        }
    }
?>

<!-- Rest of the HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Register With Us</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="urstyle.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="Authentication_Isometric.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <p>Register Here</p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="username" name="username" placeholder="Enter Your Name" value="<?php if (isset($_POST['submit'])) { echo $username; } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" required>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" required>
                            <input type="date" class="dateofbirth" name="dateofbirth" required>
                            <div class="gender-select">
                            <label for="gender">Gender</label>
                                <select id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                        <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
</body>
</html>