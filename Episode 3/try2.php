<?php
include '../conn/conn.php';

session_start();

if (isset($_SESSION['name'])) { 
    $username = $_SESSION['username']; 
    $user = $_SESSION['USER_ID'];}

$currentQuestion = isset($_POST['question_id']) ? (int)$_POST['question_id'] : 21;
$bullet = isset($_POST['bullet']) ? (int)$_POST['bullet'] : 0;
$attempts = isset($_POST['attempts']) ? (int)$_POST['attempts'] : 0; // Track attempts
$marks = isset($_POST['marks']) ? (int)$_POST['marks'] : 0; // Track total marks

// Set the timer
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

// Calculate remaining time
$current_time = time();
$remaining_time = 100 - ($current_time - $_SESSION['start_time']);

$sql = "SELECT * FROM game_episode WHERE EPISODE_ID = 4 AND EPISODE_QUESTION_ID = ?";
$stmt = $dbConn->prepare($sql);
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
    // No more questions available
    $episode_id = 3;

    // Prepare SQL statement with placeholders
    $insertSql = "INSERT INTO episode_result ( SCORE, EPISODE_ID, USER_ID) VALUES (?, ?, ?)";
    $stmt = $dbConn->prepare($insertSql);
    $stmt->bind_param("iii", $date, $marks, $episode_id, $user);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: fight.php?marks=" . $marks);
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

$nextQuestion = $currentQuestion;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer'])) {
        $selectedAnswer = $_POST['answer'];
        $explanationText = isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '';
        $attempts += 1; // Increment attempts

        if ($selectedAnswer === $correctAnswer) {
            if ($remaining_time <= 0) {
                $score = 2; // Set score to 2 if time's up
            } else {
                // Calculate score based on attempts and remaining time
                switch ($attempts) {
                    case 1: $score = 10; break;
                    case 2: $score = 8; break;
                    case 3: $score = 6; break;
                    case 4: $score = 4; break;
                    default: $score = 0;
                }
            }
            $marks += $score; // Update total marks
            $nextQuestion = $currentQuestion + 1;
            $bullet += 1;
            $showNextButton = true;
            $attempts = 0; // Reset attempts after correct answer

            // Stop the timer by unsetting the session start time
            unset($_SESSION['start_time']);

            if (isset($_POST['nextQuestion'])) {
                header("Location: " . $_SERVER['PHP_SELF'] . "?question_id=" . $nextQuestion . "&bullet=" . $bullet . "&marks=" . $marks);
                exit;
            }
        } else {
            // Deduct 10 seconds for incorrect answer
            $_SESSION['start_time'] -= 10;
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
    <link href="https://fonts.cdnfonts.com/css/ocr-a-std" rel="stylesheet">
</head>
<body>
<div id="marks"> Marks = <?= $marks ?> </div>
<div id="timer"><?= $remaining_time ?></div>

<div class="question">
    <form method="post">
        <input type="hidden" name="question_id" value="<?= $nextQuestion ?>">
        <input type="hidden" name="bullet" value="<?= $bullet ?>">
        <input type="hidden" name="attempts" value="<?= $attempts ?>">
        <input type="hidden" name="marks" value="<?= $marks ?>">
        <div class="bullet">
            <p><img src="../image/magic-wond.png" alt="Magic Wand" style="width:24px; height:auto; vertical-align:middle;"> Magic Wand = <?= $bullet ?></p>
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

<script>
    var remainingTime = <?= $remaining_time ?>;
    var timerElement = document.getElementById('timer');

    function updateTimer() {
        if (remainingTime > 0) {
            timerElement.textContent = remainingTime;
            remainingTime--;
            setTimeout(updateTimer, 1000);
        } else {
            timerElement.textContent = "Time's up!";
        }
    }
    updateTimer();
</script>
</body>
</html>
