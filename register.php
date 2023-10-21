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
} else {
    //echo "Connected successfully";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add the "username" field
    $username = $_POST['username'];
    $email = $_POST['email'];
    $raw_password = $_POST['password']; // Store the raw password
    $dateofbirth = $_POST['dateofbirth'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];

    // Hash the password
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

    // Check if the email already exists in the database
    $check_query = "SELECT * FROM tbl_users WHERE email = ?";
    
    // Create a prepared statement for the check
    $check_stmt = $conn->prepare($check_query);
    
    // Bind the parameter for the email check
    $check_stmt->bind_param("s", $email);

    // Execute the check statement
    $check_stmt->execute();
    
    // Store the result
    $result = $check_stmt->get_result();

    // Check if the email exists
    if ($result->num_rows > 0) {
        echo '<script>alert("Email already exists. Please use a different email.");</script>';
    } else {
        // Email doesn't exist, proceed with registration
        $insert_query = "INSERT INTO tbl_users (user_id, username, email, password, dateofbirth, gender, role) 
                         VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        
        // Create a prepared statement for the insertion
        $stmt = $conn->prepare($insert_query);
        
        // Bind the parameters for insertion
        $stmt->bind_param("ssssss", $username, $email, $hashed_password, $dateofbirth, $gender, $role);

        // Execute the insertion statement
        if ($stmt->execute()) {
            echo "Recorded successfully";
        } else {
            echo "Not Successful: " . $stmt->error; // Display the specific error message
        }

        // Close the insertion statement
        $stmt->close();
    }

    // Close the check statement
    $check_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        /* Add some basic styling for the form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        select, input[type="text"], input[type="email"], input[type="password"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form id="registrationForm" method="POST" action="register.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <label for="dateofbirth">Date of Birth:</label>
            <input type="date" id="dateofbirth" name="dateofbirth" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
