<?php
require_once "connect.php";

// sql to delete a record
$sql = "DELETE FROM tbl_users WHERE user_id = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_id);
    
    // Set parameters
    $param_id = intval($_GET['user_id']);
    
    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        echo "User was deleted successfully.";
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

$stmt->close();
$conn->close();

// Redirect to the same page
header("Location: allusers.php");
exit;
?>
