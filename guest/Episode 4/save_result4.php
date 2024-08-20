<?php
    include '../conn/conn.php';

    if (isset($_SESSION['score'])) {
        $score = $_SESSION['score'];
        $userId = $_SESSION['USER_ID']; 
        $episodeId = 4;

        $user_check_stmt = $dbConn->prepare("SELECT USER_ID FROM user_information WHERE USER_ID = ?");
        $user_check_stmt->bind_param("i", $userId);
        $user_check_stmt->execute();
        $user_check_stmt->store_result();

        if ($user_check_stmt->num_rows > 0) {
            $user_check_stmt->close();

            $query = "INSERT INTO episode_result (SCORE, EPISODE_ID, USER_ID) VALUES (?, ?, ?)";
            $stmt = $dbConn->prepare($query);
            $stmt->bind_param('sii', $score, $episodeId, $userId);

            if ($stmt->execute()) {
                // store successfully
            } else {
                echo "Error recording score: " . $dbConn->error;
            }

            $stmt->close();
        } else {
            echo "Error: Invalid USER_ID.";
        }
    } else {
        echo "No score available to record.";
    }

    $dbConn->close();
?>