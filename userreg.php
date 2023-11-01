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

    // Additional input validation can be added here

    if (count($errors) == 0) {
        // Hash the password
        $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

        // Set the role_id for users (assuming 2 is for users)
        $role_id = 2;

        // Prepare the INSERT statement
        $insert_query = "INSERT INTO tbl_users (user_id, username, email, password, dateofbirth, gender, role_id) 
                         VALUES (NULL, ?, ?, ?, ?, ?, ?)";

        // Create a prepared statement for the insertion
        $stmt = $conn->prepare($insert_query);

        // Bind the parameters for insertion
        $stmt->bind_param("sssssi", $username, $email, $hashed_password, $dateofbirth, $gender, $role_id);

        // Execute the insertion statement
        if ($stmt->execute()) {
            // Registration successful, redirect to another page
            header("location: land.php");
            exit; // Terminate the script to ensure a clean redirection
        } else {
            echo "Registration failed. Please try again later.";
        }

        // Close the insertion statement
        $stmt->close();
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
            window.location.href = 'land.php';
        }
    </script>

</body>
</html>
