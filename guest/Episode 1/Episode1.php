<?php
include '../../conn/conn.php';
session_start();

// Handle game restart
if (isset($_POST['restartGame'])) {
    // Clear session variables
    unset($_SESSION['start_time']);
    unset($_SESSION['score']);
    unset($_SESSION['answered_questions']); // Clear answered questions
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Initialize start time, score, and answered questions if not set
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
if (!isset($_SESSION['answered_questions'])) {
    $_SESSION['answered_questions'] = array();
}

// Handle the current question ID from the GET request or default to 1
$currentQuestion = isset($_GET['EPISODE_QUESTION_ID']) ? (int)$_GET['EPISODE_QUESTION_ID'] : 1;

// Initialize variables
$showNextButton = false;
$showRestartButton = false;
$explanationText = '';
$isIncorrect = false;

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
            // Check if the user has already answered this question
            if (!in_array($currentQuestion, $_SESSION['answered_questions'])) {
                $_SESSION['answered_questions'][] = $currentQuestion; // Mark the question as answered

                $explanationText = "Correct! " . (isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '');
                
                // Calculate score (you may need to adjust this based on your scoring system)
                $score = 50; // Example: 50 points for each correct answer
                $_SESSION['score'] += $score;

                // Show Next Question and Restart buttons
                $showNextButton = true;
                $showRestartButton = true;
            } else {
                $explanationText = "You have already answered this question correctly. " . (isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '');
                $showNextButton = true; // Show Next button even if the answer was previously answered correctly
                $showRestartButton = true; // Ensure Restart button is also shown
            }
        } else {
            $explanationText = "Incorrect. " . (isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '');
            $isIncorrect = true;

            $scorePenalty = 5;
            $_SESSION['score'] = max(0, $_SESSION['score'] - $scorePenalty);
        }
        $stmt->close();
    }

    if (isset($_POST['nextQuestion'])) {
        // Increment the question ID for the next question
        if ($currentQuestion < 10) {
            $nextQuestion = $currentQuestion + 1;
            header("Location: " . $_SERVER['PHP_SELF'] . "?EPISODE_QUESTION_ID=" . $nextQuestion);
        } else {
            // All questions answered, insert results without time taken

            if ($stmt->execute()) {
                // Clear session variables
                unset($_SESSION['start_time']);
                unset($_SESSION['score']);
                unset($_SESSION['answered_questions']);
                
                header("Location: last.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
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
    // No more questions available, this shouldn't happen with the new logic above
    echo "No more questions available.";
    exit;
}

$stmt->close();

// Calculate remaining time
$elapsed_time = time() - $_SESSION['start_time'];
$remaining_time = max(0, 600 - $elapsed_time);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="../../css/Episode1.css"/>
</head>
<body>
<header class="active">
    <div class="header-content">
        <a href="../../index.html"><img src="../../image/Witchcraft.Code Logo.png" alt="Witchcraft Code Logo"/></a>
        <div class="header-title">
            Episode 1: Introduction to Python & Basic Syntax
        </div>
    </div>
</header>
    <div id="timer"><?php echo $remaining_time; ?></div>
    <div id="score-display">Score: <span id="score"><?php echo $_SESSION['score']; ?></span></div>
    <div class="container">
        <div class="container-image">
            <img width="400px" src="../../image/Flying witch.gif" alt="Flying witch" class="rotate90">
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
                    <div class="explanation">
                        <?php if ($explanationText): ?>
                            <p><?= $explanationText ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($showNextButton || $showRestartButton): ?>
                        <button type="submit" class="button" name="nextQuestion" value="next" style="<?php echo $showNextButton ? 'display: inline;' : 'display: none;'; ?>">Next Question</button>
                        <button type="submit" class="button" name="restartGame" value="restart" style="<?php echo $showRestartButton ? 'display: inline;' : 'display: none;'; ?>">Restart Game</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <img id="boom" src="../image/boom.gif" alt="Boom" style="display:none;">

    <script>
    document.addEventListener('DOMContentLoaded', function() {
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
            }
        }
        updateTimer();

        // Show boom.gif if the answer is incorrect
        var isIncorrect = <?php echo $isIncorrect ? 'true' : 'false'; ?>;
        if (isIncorrect) {
            document.getElementById('boom').style.display = 'block';
        }

        // Update score display
        var scoreElement = document.getElementById('score');
        var currentScore = <?php echo $_SESSION['score']; ?>;
        scoreElement.textContent = currentScore;
    });
    </script>
</body>
</html>
