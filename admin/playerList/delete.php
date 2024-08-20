<?php
include '../../admin/playerList/conn.php';

// Check if `user_id` is set
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    
    // Start transaction
    $dbConn->begin_transaction();
    
    try {
        // Delete related records in score_information
        $sql1 = "DELETE FROM score_information WHERE USER_ID = ?";
        $stmt1 = $dbConn->prepare($sql1);
        $stmt1->bind_param('i', $user_id);
        $stmt1->execute();
        $stmt1->close();

        // Delete the user from user_information
        $sql2 = "DELETE FROM user_information WHERE USER_ID = ?";
        $stmt2 = $dbConn->prepare($sql2);
        $stmt2->bind_param('i', $user_id);
        $stmt2->execute();
        $stmt2->close();

        // Commit transaction
        $dbConn->commit();

        // Redirect to playerList.php if deletion is successful
        header('Location: ../../admin/playerList/playerList.php');
        exit();
    } catch (Exception $e) {
        // Rollback transaction if there is an error
        $dbConn->rollback();
        echo "Error deleting user: " . $e->getMessage();
    }
} else {
    echo "No user ID specified.";
}

mysqli_close($dbConn);
?>
