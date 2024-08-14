<?php
// Start the current session
session_start();

// Check if we need to reset the session (when starting fresh)
if (isset($_POST['reset'])) {
    session_unset();
    session_destroy();
    session_start();
}

// Include the database connection
include '../conn/conn.php';

// Initialize or update the current question ID in the session
$currentQuestion = $_SESSION['EPISODE_QUESTION_ID'] ?? 1;

if ($dbConn->connect_error) {
    die("Connection failed: " . $dbConn->connect_error);
}

// Prepare the SQL statement to fetch the current question
$sql = "SELECT * FROM game_episode WHERE EPISODE_ID = 4 AND EPISODE_QUESTION_ID = ?";
$stmt = $dbConn->prepare($sql);

// Check if the SQL statement was prepared successfully
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($dbConn->error));
}

$stmt->bind_param("i", $currentQuestion);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the question details
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
    // Handle the case where no question is found for the current ID
    echo "No questions found for EPISODE_QUESTION_ID = $currentQuestion"; 
    $quizQuestion = "No questions available.";
    $hint = "";
    $optionA = $optionB = $optionC = $optionD = "";
    $correctAnswer = "";
    $explanation = [];
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['answer'])) {
        $selectedAnswer = $_POST['answer'];
        $explanationText = isset($explanation[$selectedAnswer]) ? $explanation[$selectedAnswer] : '';

        // Check if the selected answer is correct
        if ($selectedAnswer === $correctAnswer) {
            // If correct, increment the question ID
            $_SESSION['EPISODE_QUESTION_ID'] = $currentQuestion + 1;
            $showNextButton = true;
        } else {
            // If incorrect, do not change the question
            $showNextButton = false;
        }
    } elseif (isset($_POST['nextQuestion'])) {
        // Move to the next question when "Next" button is clicked
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
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
    <script src="../Javascript/ep3 copy.js" defer></script>
    <style>
        #quiz-section {
            display: none; /* Hide quiz section initially */
        }
        #next-button {
            display: none; /* Hide next button initially */
        }
    </style>
</head>
<body>
    <div id="quiz-countdown"></div> <!-- 60-second Question Timer -->
    <div id="quiz-section"> <!-- Quiz section -->
        <div class="question">
            <form method="post">
                <p><?= $quizQuestion ?></p>
                <div class="answer">
                    <button type="submit" class="button" name="answer" value="A" onclick="stopQuizTimer()"><?= $optionA ?></button>
                    <button type="submit" class="button" name="answer" value="B" onclick="stopQuizTimer()"><?= $optionB ?></button>
                    <button type="submit" class="button" name="answer" value="C" onclick="stopQuizTimer()"><?= $optionC ?></button>
                    <button type="submit" class="button" name="answer" value="D" onclick="stopQuizTimer()"><?= $optionD ?></button>
                </div>
                <?php if (isset($explanationText)): ?>
                    <p><?= $explanationText ?></p>
                <?php endif; ?>
                <?php if (isset($showNextButton) && $showNextButton): ?>
                    <button type="submit" class="button" name="nextQuestion" id="next-button">Next Question</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>