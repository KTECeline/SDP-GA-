<?php
include '../conn/conn.php';

$currentQuestion = isset($_POST['question_id']) ? (int)$_POST['question_id'] : 1;
$bullet = isset($_POST['bullet']) ? (int)$_POST['bullet'] : 0;

$sql = "SELECT * FROM game_episode WHERE EPISODE_ID = 4 AND EPISODE_QUESTION_ID = ?";
$stmt = $dbConn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($dbConn->error));
}

$stmt->bind_param("i", $currentQuestion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
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
} else {
    $quizQuestion = "No questions available.";
    $hint = "";
    $optionA = $optionB = $optionC = $optionD = "";
    $correctAnswer = "";
    $explanation = [];
}

$nextQuestion = $currentQuestion;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer'])) {
        $selectedAnswer = $_POST['answer'];
        $explanationText = isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '';

        if ($selectedAnswer === $correctAnswer) {
            $nextQuestion = $currentQuestion + 1;
            $bullet += 1; // Increment bullet count
            $showNextButton = true;
            if (isset($_POST['nextQuestion'])) {
                // Reload the page with the updated question ID and bullet count
                header("Location: " . $_SERVER['PHP_SELF'] . "?question_id=" . $nextQuestion . "&bullet=" . $bullet);
                exit;
            }
        } else {
            $showNextButton = false;
        }
    }
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="../css/Episode3.css"/>
</head>
<body>
    <div class="question">
        <form method="post">
            <input type="hidden" name="question_id" value="<?= $nextQuestion ?>">
            <input type="hidden" name="bullet" value="<?= $bullet ?>">
            <div class="bullet">
                <p>
                    <img src="../image/magic-wond.png" alt="Magic Wand" style="width:24px; height:auto; vertical-align:middle;">
                    Magic Wond = <?= $bullet ?>
                </p> <!-- Display bullet count with image -->
            </div>
            <p><?= $quizQuestion ?></p>
            <div class="answer">
                <button type="submit" class="button" name="answer" value="A"><?= $optionA ?></button>
                <button type="submit" class="button" name="answer" value="B"><?= $optionB ?></button>
                <button type="submit" class="button" name="answer" value="C"><?= $optionC ?></button>
                <button type="submit" class="button" name="answer" value="D"><?= $optionD ?></button>
            </div>
            <?php if (isset($explanationText)): ?>
                <p><?= $explanationText ?></p>
            <?php endif; ?>
            <?php if (isset($showNextButton) && $showNextButton): ?>
                <button type="submit" class="button" name="nextQuestion" value="next">Next Question</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
