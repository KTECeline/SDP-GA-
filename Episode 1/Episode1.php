<?php
include '../conn/conn.php';
session_start();

// Handle the current question ID from the POST request or default to 1
$currentQuestion = isset($_GET['EPISODE_QUESTION_ID']) ? (int)$_GET['EPISODE_QUESTION_ID'] : 1;

// Initialize variables
$showNextButton = false;
$explanationText = '';
$isIncorrect = false; // Flag to track if the selected answer is incorrect

// If the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer'])) {
        $selectedAnswer = $_POST['answer'];

        // Prepare the SQL query
        $sql = "SELECT * FROM game_episode WHERE EPISODE_ID = 1 AND EPISODE_QUESTION_ID = ?";
        $stmt = $dbConn->prepare($sql);
        $stmt->bind_param("i", $currentQuestion);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Fetch question details
        $correctAnswer = $row['CORRECT_ANSWER'];
        $explanation = array(
            "A" => $row['OPTION_A_EXPLANATION'],
            "B" => $row['OPTION_B_EXPLANATION'],
            "C" => $row['OPTION_C_EXPLANATION'],
            "D" => $row['OPTION_D_EXPLANATION'],
        );

        // Determine if the selected answer is correct
        if ($selectedAnswer === $correctAnswer) {
            $showNextButton = true;
            $explanationText = "Correct! " . (isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '');
        } else {
            $explanationText = "Incorrect. " . (isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '');
            $isIncorrect = true; // Set flag to true when answer is incorrect
        }
        $stmt->close();
    }

    if (isset($_POST['nextQuestion'])) {
        // Increment the question ID for the next question
        if ($currentQuestion < 10) {
            $nextQuestion = $currentQuestion + 1;
            header("Location: " . $_SERVER['PHP_SELF'] . "?EPISODE_QUESTION_ID=" . $nextQuestion);
        } else {
            header("Location: last.php");
        }
        exit;
    }
}

// Fetch the current question details
$sql = "SELECT * FROM game_episode WHERE EPISODE_ID = 1 AND EPISODE_QUESTION_ID = ?";
$stmt = $dbConn->prepare($sql);
$stmt->bind_param("i", $currentQuestion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $quizQuestion = $row['EPISODE_QUESTION'];
    $optionA = $row['OPTION_A'];
    $optionB = $row['OPTION_B'];
    $optionC = $row['OPTION_C'];
    $optionD = $row['OPTION_D'];
} else {
    // No more questions available
    $episode_id = 3;

    // Prepare SQL statement with placeholders
    $insertSql = "INSERT INTO episode_result ( SCORE, EPISODE_ID, USER_ID) VALUES (?, ?, ?)";
    $stmt = $dbConn->prepare($insertSql);
    $stmt->bind_param("iii", $date, $marks, $episode_id, $user);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: last.php?marks=" . $marks);
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
                header("Location: " . $_SERVER['PHP_SELF'] . "?question_id=" . $nextQuestion . "&marks=" . $marks);
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
    <link rel="stylesheet" href="../css/Episode1.css"/>
</head>
<body>
    <div id="timer"><?php echo $remaining_time; ?></div>
    <div class="container">
        <div class="container-image">
            <img width="400px" src="../image/Flying witch.gif" alt="Flying witch" class="rotate90">
        </div>
        <div class="container-right">
            <div class="question">
                <form method="post">
                    <p><?= $quizQuestion ?></p>
                    <input type="hidden" name="EPISODE_QUESTION_ID" value="<?= $currentQuestion ?>">
                    <div class="answer">
                        <button type="submit" class="button" name="answer" value="A"><?= $optionA ?></button>
                        <button type="submit" class="button" name="answer" value="B"><?= $optionB ?></button>
                        <button type="submit" class="button" name="answer" value="C"><?= $optionC ?></button>
                        <button type="submit" class="button" name="answer" value="D"><?= $optionD ?></button>
                    </div>
                    <div class="explanation"><?php if ($explanationText): ?>
                        <p><?= $explanationText ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($showNextButton): ?>
                        <button type="submit" class="button" name="nextQuestion" value="next">Next Question</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <img id="boom" src="../image/boom.gif" alt="Boom" style="display:none;">

    <script>
    // Timer
    var remainingTime = <?php echo $remaining_time; ?>;
    var timerElement = document.getElementById('timer');

    function updateTimer() {
        if (remainingTime > 0) {
            timerElement.textContent = remainingTime;
            remainingTime--;
            setTimeout(updateTimer, 1000);
        } else {
            timerElement.textContent = "Time's up!";
            window.location.href = "timeup.php";
        }
    }
    updateTimer();

    // Show boom.gif if the answer is incorrect
    var isIncorrect = <?php echo $isIncorrect ? 'true' : 'false'; ?>;
    if (isIncorrect) {
        document.getElementById('boom').style.display = 'block';
    }
    </script>
</body>
</html>
