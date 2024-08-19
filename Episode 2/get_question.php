<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdp_ga";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$question_number = isset($_POST['question_number']) ? (int)$_POST['question_number'] : 1;

$sql = "SELECT EPISODE_QUESTION_ID, EPISODE_QUESTION, EPISODE_HINT, OPTION_A, OPTION_A_EXPLANATION, OPTION_B, OPTION_B_EXPLANATION, OPTION_C, OPTION_C_EXPLANATION, OPTION_D, OPTION_D_EXPLANATION, CORRECT_ANSWER, EPISODE_ID 
        FROM game_episode 
        WHERE EPISODE_ID = 2
        LIMIT " . ($question_number - 1) . ", 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'No questions found.']);
}

$conn->close();
?>

