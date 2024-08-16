<?php
// delete_question.php

// Database connection
$localhost = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'sdp_ga';

$conn = new mysqli($localhost, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['EPISODE_QUESTION_ID'])) {
    $EPISODE_QUESTION_ID = $_POST['EPISODE_QUESTION_ID'];

    $sql = "DELETE FROM game_episode WHERE EPISODE_QUESTION_ID = '$EPISODE_QUESTION_ID'";
    if ($conn->query($sql) === TRUE) {
        echo "Question deleted successfully";
    } else {
        echo "Error deleting question: " . $conn->error;
    }
}

$conn->close();
?>