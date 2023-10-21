<?php
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
    $username = $_POST['username'];
    $raw_password = $_POST['password'];

    // Check if the provided username exists in the database
    $check_query = "SELECT * FROM tbl_users WHERE username = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the provided password
        if (password_verify($raw_password, $hashed_password)) {
            // Password is correct, set session variables and redirect
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            header("location: land.php"); // Replace with your landing page
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Invalid username. Please try again.";
    }

    // Close the check statement
    $check_stmt->close();
}

$conn->close();
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $username_err = "Please enter your username.";
    } else {
        $username = $_POST["username"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $password_err = "Please enter your password.";
    } else {
        $password = $_POST["password"];
    }

    // Check input errors before checking the database
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT username, password FROM tbl_users WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $hashed_password = $row["password"];

                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["username"] = $row["username"];

                        // Redirect to the landing page
                        header("location: landing.php");
                        exit;
                    } else {
                        // Display an error message if the password is not valid
                        $password_err = "The password you entered is not valid.";
                    }
                } else {
                    // Display an error message if the username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    // Close connection
    $conn->close();
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
=======
    <link rel="stylesheet" href="log.css">
</head>

<body>
    <div class = "container">

         <div class = "form-box">
            <form id="registration form" method="POST" action="log.php" >
                <h2>Register Here</h2>
                <div class="input-box">
                    <input type="text" name="username" placeholder ="username">
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder ="Email">
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder ="Password">
                </div>

                <div class="button">
                    <input type="submit" class="btn" value ="Login">
                </div>

                <div class="group">
                    <span><a href= "#" >Forgot Password</a><span><br><br>
                    <span><a href= "#" >Don't have an account? Register</a><span><br><br>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

    <script>
        // JavaScript function to redirect to the landing page after form submission
        document.getElementById("login-form").addEventListener("submit", function() {
            // Replace 'landing.php' with the URL of the desired landing page
            window.location.href = 'landing.php';
        });
    </script>
</body>
</html>
