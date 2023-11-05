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

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    // Check if the verification code exists in the tbl_verification table
    $check_query = "SELECT * FROM tbl_verification WHERE verification_code = ?";
    $stmt_check = $conn->prepare($check_query);
    $stmt_check->bind_param("s", $verification_code);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows === 1) {
        // Verification code exists, mark the email as verified
        $user_data = $result->fetch_assoc();
        $email = $user_data['email'];
        $update_query = "UPDATE tbl_users SET email_verified = 1 WHERE email = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("s", $email);
        $stmt_update->execute();

        // Delete the verification entry
        $delete_query = "DELETE FROM tbl_verificaton WHERE verification_code = ?";
        $stmt_delete = $conn->prepare($delete_query);
        $stmt_delete->bind_param("s", $verification_code);
        $stmt_delete->execute();

        // Display a success message
        echo "Email verification successful. You can now <a href='login.php'>login</a> to your account.";
    } else {
        // Verification code not found
        echo "Invalid or expired verification code. Please try again.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
