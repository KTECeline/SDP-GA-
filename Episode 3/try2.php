<?php
include '../conn/conn.php';
// Check connection
if ($dbConn->connect_error) {
    die("Connection failed: " . $dbConn->connect_error);
}

// Get the current question ID from the URL or default to the first question
$currentQuestionId = isset($_GET['question_id']) ? (int)$_GET['question_id'] : 1;

// Fetch the current question from the database
$sql = "SELECT * FROM game_episode WHERE EPISODE_QUESTION_ID = $currentQuestionId";
$result = $dbConn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the current question
    $row = $result->fetch_assoc();
    echo "<h1>Question " . $row['EPISODE_QUESTION_ID'] . "</h1>";
    echo "<p>" . $row['EPISODE_QUESTION'] . "</p>";
    echo "<ul>";
    echo "<li>A. " . $row['OPTION_A'] . "</li>";
    echo "<li>B. " . $row['OPTION_B'] . "</li>";
    echo "<li>C. " . $row['OPTION_C'] . "</li>";
    echo "<li>D. " . $row['OPTION_D'] . "</li>";
    echo "</ul>";

    // Determine the next question ID
    $nextQuestionId = $currentQuestionId + 1;

    // Check if there's a next question
    $nextQuestionSql = "SELECT EPISODE_QUESTION_ID FROM game_episode WHERE EPISODE_QUESTION_ID = $nextQuestionId";
    $nextResult = $dbConn->query($nextQuestionSql);

    if ($nextResult->num_rows > 0) {
        // If there's a next question, display the "Next" button
        echo "<a href='?question_id=$nextQuestionId'><button>Next</button></a>";
    } else {
        // If no more questions, display a "Quiz Complete" message
        echo "<p>Quiz Complete!</p>";
    }
} else {
    echo "No question found.";
}

// Close the connection
$dbConn->close();
?>