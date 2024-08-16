<?php
session_start();
include '../../conn/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['reset_users'])) {
        $resetUsers = $_POST['reset_users'];
        foreach ($resetUsers as $userId) {
            // Reset the user's score
            $resetSql = "UPDATE score_information SET EPISODE_TOTAL_SCORE = 0 WHERE USER_ID = ?";
            $stmt = $dbConn->prepare($resetSql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->close();
        }
        echo "<script>alert('Selected users\' scores have been reset.'); window.location.href='leaderboard.php';</script>";
    } else {
        echo "<script>alert('No users selected for score reset.'); window.location.href='leaderboard.php';</script>";
    }
}

$dbConn->close();
?>
