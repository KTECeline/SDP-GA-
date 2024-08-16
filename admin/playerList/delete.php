<?php
include '../../admin/playerList/conn.php';

// Check if `user_id` is set
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    
    // Prepare SQL to delete the user
    $sql = "DELETE FROM user_information WHERE USER_ID = ?";
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        // Redirect to playerList.php if deletion is successful
        header('Location: ../../admin/playerList/playerList.php');
        exit();
    } else {
        echo "Error deleting user: " . $dbConn->error;
    }

    $stmt->close();
} else {
    echo "No user ID specified.";
}

mysqli_close($dbConn);
?>
