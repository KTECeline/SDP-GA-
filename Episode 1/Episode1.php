<?php
include 'conn.php';
session_start();

// Handle the current question ID from the POST request or default to 1
$currentQuestion = isset($_GET['question_id']) ? (int)$_GET['question_id'] : 1;

// Initialize variables
$showNextButton = false;
$explanationText = '';
$isIncorrect = false; // Flag to track if the selected answer is incorrect

// If the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer'])) {
        $selectedAnswer = $_POST['answer'];

        // Prepare the SQL query
        $sql = "SELECT * FROM episode1 WHERE EPISODE_ID = 1 AND EPISODE_QUESTION_ID = ?";
        $stmt = $dbConn->prepare($sql);
        $stmt->bind_param("i", $currentQuestion);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Fetch question details
        $correctAnswer = $row['CORRECT_ANSWER'];
        $explanation = array(
            "(A)" => $row['OPTION_A_EXPLANATION'],
            "(B)" => $row['OPTION_B_EXPLANATION'],
            "(C)" => $row['OPTION_C_EXPLANATION'],
            "(D)" => $row['OPTION_D_EXPLANATION'],
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
        $nextQuestion = $currentQuestion + 1;
        header("Location: " . $_SERVER['PHP_SELF'] . "?question_id=" . $nextQuestion);
        exit;
    }
}

// Fetch the current question details
$sql = "SELECT * FROM episode1 WHERE EPISODE_ID = 1 AND EPISODE_QUESTION_ID = ?";
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
    $quizQuestion = "No questions available.";
    $optionA = $optionB = $optionC = $optionD = "";
}

$stmt->close();

// Initialize session and time
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

$remaining_time = 1000;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="episodes1.css"/>
</head>
<body>
    <div id="timer"><?php echo $remaining_time; ?></div>
    <div class="container">
        <div class="container-image">
            <img width="400px" src="Flying witch.gif" alt="Flying witch" class="rotate90">
        </div>
        <div class="container-right">
            <div class="question">
                <form method="post">
                    <p><?= $quizQuestion ?></p>
                    <input type="hidden" name="question_id" value="<?= $currentQuestion ?>">
                    <div class="answer">
                        <button type="submit" class="button" name="answer" value="(A)"><?= $optionA ?></button>
                        <button type="submit" class="button" name="answer" value="(B)"><?= $optionB ?></button>
                        <button type="submit" class="button" name="answer" value="(C)"><?= $optionC ?></button>
                        <button type="submit" class="button" name="answer" value="(D)"><?= $optionD ?></button>
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
    <img id="boom" src="boom.gif" alt="Boom" style="display:none;">

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
