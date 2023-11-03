<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connect.php";

if (isset($_POST['update'])) {
  $user_id = $_POST['user_id'];
  $new_username = $_POST['new_username'];
  $new_email = $_POST['new_email'];
  $new_password = $_POST['new_password'];

  // Hash the new password
  $new_password = password_hash($new_password, PASSWORD_DEFAULT);

  // Use $user_id, $new_username, $new_email, and $new_password in your SQL UPDATE query
  $sql = "UPDATE tbl_users SET username = ?, email = ?, password = ? WHERE user_id = ?";

  // Prepare and execute the SQL query
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sssi', $new_username, $new_email, $new_password, $user_id);

  if ($stmt->execute()) {
    // Redirect to allusers.php
    header('Location: allusers.php');
  } else {
    echo "Error updating user: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
  <title>Update User</title>
  <style>
    label {
      display: block;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <h2>Update User Username</h2>
  <form method="POST" action="update.php">
    <label for="user_id">User ID to Update:</label>
    <input type="text" name="user_id" placeholder="Enter User ID" required>

    <label for="new_username">New Username:</label>
    <input type="text" name="new_username" placeholder="Enter New Username" required>

    <label for="new_email">New Email:</label>
    <input type="email" name="new_email" placeholder="Enter New Email" required>

    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" placeholder="Enter New Password" required>

    <input type="submit" name="update" value="Update User">
  </form>

</body>
</html>