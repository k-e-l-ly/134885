<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: land.php");
    exit;
}

require_once "connect.php"; // Make sure this file includes your database connection

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty(trim($_POST['username']))) {
        $username_err = 'Please enter your username.';
    } else {
        $username = trim($_POST['username']);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = 'SELECT user_id, username, password FROM tbl_users WHERE username = ?';

        if ($stmt = $conn->prepare($sql)) {
            $param_username = $username;
            $stmt->bind_param('s', $param_username);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['user_id'] = $id;
                            $_SESSION['username'] = $username;
                            header('Location: land.php');
                            //exit;
                        } else {
                            $password_err = 'Invalid password.';
                        }
                    }
                } else {
                    $username_err = "Username does not exist.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again. (Execute)";
            }

            $stmt->close();
        } else {
            echo "Oops! Something went wrong. Please try again. (Prepare)";
        }

        $conn->close();
    }
}
?>