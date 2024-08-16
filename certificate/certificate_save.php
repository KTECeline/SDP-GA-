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

if (isset($_POST['feedback'])) {
    $feedback = $_POST['feedback'];

    if (isset($_SESSION['USER_ID'])) {
        $user_id = $_SESSION['USER_ID']; 

        // Check if a certificate record exists
        $check_stmt = $dbConn->prepare("SELECT CERTIFICATE_ID FROM certificate_information WHERE USER_ID = ? ORDER BY CERTIFICATE_ID DESC LIMIT 1");
        $check_stmt->bind_param("i", $user_id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $certificate_id = $row['CERTIFICATE_ID'];

            // Update feedback
            $update_stmt = $dbConn->prepare("UPDATE certificate_information SET CERTIFICATE_FEEDBACK = ? WHERE CERTIFICATE_ID = ?");
            $update_stmt->bind_param("si", $feedback, $certificate_id);

            try {
                $update_stmt->execute();
                if ($update_stmt->affected_rows > 0) {
                    error_log("Feedback updated for certificate ID: " . $certificate_id);
                    echo "<script>alert('Feedback updated successfully!'); window.location.href = 'thankyou.php';</script>";
                    exit();
                } else {
                    error_log("No changes made when updating feedback for certificate ID: " . $certificate_id);
                    echo "<script>alert('No changes were made. The feedback might be the same as before.'); window.location.href = 'feedback.php';</script>";
                }
            } catch (mysqli_sql_exception $e) {
                error_log("Error updating feedback: " . $e->getMessage());
                echo "Error: " . $e->getMessage();
            }

            $update_stmt->close();
        } else {
            error_log("No certificate record found for user ID: " . $user_id);
            echo "<script>alert('Error: No certificate record found. Please generate a certificate first.'); window.location.href = 'certificate_details.php';</script>";
        }

        $check_stmt->close();
    } else {
        error_log("User not logged in");
        echo "<script>alert('Error: User not logged in.'); window.location.href = '../user/login_register.php';</script>";
    } 
}
?>