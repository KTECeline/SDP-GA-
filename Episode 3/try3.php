<?php
include '../conn/conn.php';

$currentQuestion = isset($_POST['question_id']) ? (int)$_POST['question_id'] : 1;
$zoomLevel = isset($_POST['zoom_level']) ? (int)$_POST['zoom_level'] : 0; // Default zoom level

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
            $showNextButton = true;
            if (isset($_POST['nextQuestion'])) {
                $nextQuestion = (int)$_POST['question_id'] + 1;
                $zoomLevel = ($zoomLevel + 1) % 13; // Increment zoom level and wrap around
                // Reload the page with the updated question ID and zoom level
                header("Location: " . $_SERVER['PHP_SELF'] . "?question_id=" . $nextQuestion . "&zoom_level=" . $zoomLevel);
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
    <title>Quiz with Image Zoom and Scroll</title>
    <style>
        .image-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .witch {
            position: absolute;
            top: 50%;
            left: 60%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 200px;
            height: 200px;
        }

        .image-container img {
            width: 100%;
            transition: transform 2s ease;
            cursor: pointer;
        }

        .scroll-floor-0 { transform: scale(5) translateY(-60%); }
        .scroll-floor-1 { transform: scale(5) translateY(-46%); }
        .scroll-floor-2 { transform: scale(5) translateY(-37%); }
        .scroll-floor-3 { transform: scale(5) translateY(-28%); }
        .scroll-floor-4 { transform: scale(5) translateY(-19%); }
        .scroll-floor-5 { transform: scale(5) translateY(-10%); }
        .scroll-floor-6 { transform: scale(5) translateY(-1%); }
        .scroll-floor-7 { transform: scale(5) translateY(8%); }
        .scroll-floor-8 { transform: scale(5) translateY(17%); }
        .scroll-floor-9 { transform: scale(5) translateY(26%); }
        .scroll-floor-10 { transform: scale(5) translateY(35%); }
        .scroll-floor-11 { transform: scale(5) translateY(44%); }
        .scroll-floor-12 { transform: scale(5) translateY(53%); }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="../image/tower.png" alt="Zoomable Image" id="zoomable-image">
        <div class="witch">
            <img src="../image/Flying witch.gif" />
        </div>
    </div>

    <div class="question">
        <form method="post">
            <p><?= $quizQuestion ?></p>
            <input type="hidden" name="question_id" value="<?= $nextQuestion ?>">
            <input type="hidden" name="zoom_level" id="zoom-level-input" value="<?= $zoomLevel ?>">
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
document.addEventListener('DOMContentLoaded', () => {
    const img = document.getElementById('zoomable-image');
    const zoomLevelInput = document.getElementById('zoom-level-input');
    let currentFloor = parseInt(zoomLevelInput.value) || 0; // Retrieve saved zoom level

    console.log(`Initial floor: ${currentFloor}`); // Debug logging

    img.className = 'scroll-floor-' + currentFloor;

    img.addEventListener('click', () => {
        if (currentFloor < 12) {
            currentFloor++;
        } else {
            currentFloor = 0;
        }
        img.className = 'scroll-floor-' + currentFloor;
        zoomLevelInput.value = currentFloor; // Update hidden input with new zoom level
        console.log(`New floor: ${currentFloor}`); // Debug logging
    });
});
</script>
</body>
</html>
