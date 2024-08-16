<?php
    session_start();

    include '../conn/conn.php';

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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
                    echo "<script>window.location.href = 'certificate.php';</script>";
                    exit();
                } catch (mysqli_sql_exception $e) {
                    echo "Error: " . $e->getMessage();
                }

                $stmt->close();
            } else {
                echo "<script>alert('Error: User ID does not exist.');</script>";
            }

            $user_check_stmt->close();
        } else {
            echo "<script>alert('Error: User not logged in.');</script>";
        }
    }
?>