<?php
session_start();

include '../conn/conn.php';

if (isset($_POST['certificate'])) {
    $name = $_POST['name'];

    if (isset($_SESSION['USER_ID'])) {
        $user_id = $_SESSION['USER_ID']; 

        $user_check_stmt = $dbConn->prepare("SELECT USER_ID FROM user_information WHERE USER_ID = ?");
        $user_check_stmt->bind_param("i", $user_id);
        $user_check_stmt->execute();
        $user_check_stmt->store_result();

        if ($user_check_stmt->num_rows > 0) {
            $stmt = $dbConn->prepare("INSERT INTO certificate_information (CERTIFICATE_NAME, USER_ID) VALUES (?, ?)");
            $stmt->bind_param("si", $name, $user_id); 

            try {
                $stmt->execute();
                error_log("Certificate name saved: " . $name . " for user ID: " . $user_id);
                echo "<script>window.location.href = 'certificate.php';</script>";
                exit();
            } catch (mysqli_sql_exception $e) {
                error_log("Error saving certificate: " . $e->getMessage());
                echo "Error: " . $e->getMessage();
            }

            $stmt->close();
        } else {
            error_log("User ID does not exist: " . $user_id);
            echo "<script>alert('Error: User ID does not exist.');</script>";
        }

        $user_check_stmt->close();
    } else {
        error_log("User not logged in");
        echo "<script>alert('Error: User not logged in.');</script>";
    }
}

//FFEDBACK//

if (isset($_POST['feedback']) && isset($_POST['certificate_id'])) {
    $feedback = $_POST['feedback'];
    $certificate_id = $_POST['certificate_id'];

    // Update the feedback in the database
    $updateQuery = "UPDATE certificate_information
                    SET CERTIFICATE_FEEDBACK = ? 
                    WHERE CERTIFICATE_ID = ?";

    $stmt = $dbConn->prepare($updateQuery);
    if ($stmt === false) {
        echo "Error preparing statement: " . $dbConn->error;
    } else {
        $stmt->bind_param('si', $feedback, $certificate_id);
        if ($stmt->execute()) {
            echo "Feedback updated successfully!";
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    }

    $dbConn->close();
} else {
    echo "Invalid input.";
}
?>