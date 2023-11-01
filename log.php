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
            <form method="POST" action="logaction.php">
                <h2>Login</h2>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username">
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <?php
                if (!empty($username_err)) {
                    echo '<div class="error-message">' . $username_err . '</div>';
                }
                if (!empty($password_err)) {
                    echo '<div class="error-message">' . $password_err . '</div>';
                }
                ?>

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
