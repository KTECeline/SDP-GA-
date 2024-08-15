<?php
// Database connection
$localhost = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'sdp_ga';
$conn = new mysqli($localhost, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$EPISODE_QUESTION_ID = $_POST['EPISODE_QUESTION_ID'];

$sql = "SELECT 
  EPISODE_QUESTION,
  OPTION_A,
  OPTION_A_EXPLANATION,
  OPTION_B,
  OPTION_B_EXPLANATION,
  OPTION_C,
  OPTION_C_EXPLANATION,
  OPTION_D,
  OPTION_D_EXPLANATION,
  CORRECT_ANSWER
FROM 
  game_episode
WHERE 
  EPISODE_QUESTION_ID = '$EPISODE_QUESTION_ID';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $questionData = $result->fetch_assoc();
    echo json_encode($questionData);
} else {
    echo "Error: No question found";
}

$conn->close();