<?php
session_start();

include '../conn/conn.php';

$currentQuestion = $_SESSION['EPISODE_QUESTION_ID'] ?? 1;

$sql = "SELECT * FROM game_episode WHERE EPISODE_ID = 4 AND EPISODE_QUESTION_ID = ?";
$stmt = $dbConn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($dbConn->error));
}

$stmt->bind_param("i", $currentQuestion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $quizQuestion = $row['EPISODE_QUESTION'];
        $hint = $row['EPISODE_HINT'];
        $optionA = $row['OPTION_A'];
        $optionB = $row['OPTION_B'];
        $optionC = $row['OPTION_C'];
        $optionD = $row['OPTION_D'];
        $correctAnswer = $row['CORRECT_ANSWER'];
        $explanation = array(
            "A" => $row['OPTION_A_EXPLANATION'],
            "B" => $row['OPTION_B_EXPLANATION'],
            "C" => $row['OPTION_C_EXPLANATION'],
            "D" => $row['OPTION_D_EXPLANATION'],
        );
    }
} else {
    // If no question found, set a default message or handle accordingly
    $quizQuestion = "No questions available.";
    $hint = "";
    $optionA = $optionB = $optionC = $optionD = "";
    $correctAnswer = "";
    $explanation = [];

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer'])) {
        $selectedAnswer = $_POST['answer'];
        $explanationText = isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '';

        if ($selectedAnswer === $correctAnswer) {
            // Increment the question ID for the next question
            $_SESSION['EPISODE_QUESTION_ID'] = $currentQuestion + 1;
            // Display the explanation and the "Next Question" button
            $showNextButton = true;
        } else {
            $showNextButton = false;
        }
    } elseif (isset($_POST['nextQuestion'])) {
        // When "Next Question" button is clicked, move to the next question
        $_SESSION['EPISODE_QUESTION_ID'] = $currentQuestion + 1;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
// Close the statement
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="question">
        <form method="post">
        <p><?= $quizQuestion ?></p>
        <div class="answer">
            <button type="submit" class="button" name="answer" value="A"><?= $optionA ?></button>
            <button type="submit" class="button" name="answer" value="B"><?= $optionB ?></button>
            <button type="submit" class="button" name="answer" value="C"><?= $optionC ?></button>
            <button type="submit" class="button" name="answer" value="D"><?= $optionD ?></button>
        </div>
        </form>
    </div>
</body>
</html>
