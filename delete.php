<?php

require_once "connect.php";

if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    // Check if the user exists
    $sql = "SELECT id FROM tbl_users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Delete the user
        $sql = "DELETE FROM tbl_users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        if ($stmt->execute()) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . $stmt->error;
        }
    } else {
        echo "User does not exist.";
    }

    $stmt->close();
}

$conn->close();

?>
