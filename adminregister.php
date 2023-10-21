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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $raw_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($raw_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Directly set the role ID for "admin" role
    $role_id = 1; // You mentioned that the role ID for "admin" is 1

    $hashed_password = md5($raw_password); // Using MD5 hashing

    $insert_query = "INSERT INTO tbl_admin (username, email, password, role_id) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("sssi", $username, $email, $hashed_password, $role_id);

    if ($insert_stmt->execute()) {
        echo "Admin registration successful!";
    } else {
        echo "Admin registration failed.";
    }

    $insert_stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }
        .container{
            padding-top:100px;
        }
        form {
            margin-top: 100px;
            position: center;
            background-color: #ffffff;
            max-width: 300px;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class = "container">
    <form method="POST" action="adminregister.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" name="register" value="Register">
    </form>
</div>
</body>
</html>
