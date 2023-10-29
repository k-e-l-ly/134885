<?php

if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    // Use $user_id in your SQL DELETE query
    $sql = "DELETE FROM tbl_users WHERE user_id = ?";
    
    // Prepare and execute the SQL query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    
    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }
    
    $stmt->close();
}
?>
