<?php
session_start();
include '../conn/conn.php';

// Check if the user is logged in
if (isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID'];

    // Calculate total score from all episodes
    $stmt = $dbConn->prepare("SELECT SUM(SCORE) AS total_score FROM episode_result WHERE USER_ID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($total_score);
    $stmt->fetch();
    $stmt->close();

    if ($total_score === null) {
        $total_score = 0;
    }

    // Insert the total score into the score_information table
    $insert_stmt = $dbConn->prepare("INSERT INTO score_information (EPISODE_TOTAL_SCORE, USER_ID) VALUES (?, ?)");
    $insert_stmt->bind_param("ii", $total_score, $user_id);
    $insert_stmt->execute();
    $insert_stmt->close();

    // Redirect to the thank you page with the user's ID
    header("Location: thankyou.php?user_id=" . $user_id);
    exit();
} else {
    echo "<script>alert('User not logged in.'); window.location.href = '../login_register/login_register.php';</script>";
    exit();
}
?>
