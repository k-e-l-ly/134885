<?php
if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $new_username = $_POST['new_username'];

    // Use $user_id and $new_username in your SQL UPDATE query
    $sql = "UPDATE tbl_users SET username = ? WHERE user_id = ?";
    
    // Prepare and execute the SQL query
    $stmt->prepare($sql);
    $stmt->bind_param('si', $new_username, $user_id);
    
    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $stmt->error;
    }
    
    $stmt->close();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User Username</h2>
    <form method="POST" action="update.php">
    <label for="user_id">User ID to Update:</label>
    <input type="text" name="user_id" placeholder="Enter User ID" required>
    
    <label for="new_username">New Username:</label>
    <input type="text" name="new_username" placeholder="Enter New Username" required>
    
    <input type="submit" name="update" value="Update User">
</form>

</body>
</html>
