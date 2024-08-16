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
$EPISODE_QUESTION = $_POST['EPISODE_QUESTION'];
$OPTION_A = $_POST['OPTION_A'];
$OPTION_A_EXPLANATION = $_POST['OPTION_A_EXPLANATION'];
$OPTION_B = $_POST['OPTION_B'];
$OPTION_B_EXPLANATION = $_POST['OPTION_B_EXPLANATION'];
$OPTION_C = $_POST['OPTION_C'];
$OPTION_C_EXPLANATION = $_POST['OPTION_C_EXPLANATION'];
$OPTION_D = $_POST['OPTION_D'];
$OPTION_D_EXPLANATION = $_POST['OPTION_D_EXPLANATION'];
$CORRECT_ANSWER = $_POST['CORRECT_ANSWER'];

$sql = "UPDATE 
  game_episode
SET 
  EPISODE_QUESTION = '$EPISODE_QUESTION',
  OPTION_A = '$OPTION_A',
  OPTION_A_EXPLANATION = '$OPTION_A_EXPLANATION',
  OPTION_B = '$OPTION_B',
  OPTION_B_EXPLANATION = '$OPTION_B_EXPLANATION',
  OPTION_C = '$OPTION_C',
  OPTION_C_EXPLANATION = '$OPTION_C_EXPLANATION',
  OPTION_D = '$OPTION_D',
  OPTION_D_EXPLANATION = '$OPTION_D_EXPLANATION',
  CORRECT_ANSWER = '$CORRECT_ANSWER'
WHERE 
  EPISODE_QUESTION_ID = '$EPISODE_QUESTION_ID';";

if ($conn->query($sql) === TRUE) {
    echo "Question updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();