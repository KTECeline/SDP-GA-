<?php
session_start();

if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

$current_time = time();
$remaining_time = 5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episode</title>
    <link rel="stylesheet" href="../css/Episode1.css/">
    
</head>
<body>
    <div id="timer"><?php echo $remaining_time; ?></div>
    <div class="container">
        <div class="container-image">
            <img width="400px" src="Flying witch.gif" alt="Flying witch" class="rotate90">
        </div>
        <div class="container-right">
            <h1 class="question">1+1=?</h1>
            <div class="answer-grid">
                <a href="corrent1.php" class="answer-box">answer 1</a>
                <a href="#.php" class="answer-box wrong">answer 2</a>
                <a href="#.php" class="answer-box wrong">answer 3</a>
                <a href="#.php" class="answer-box wrong">answer 4</a>                
            </div>
        </div>
    </div>

    <img id="boom" src="boom.gif" alt="Boom">

    <script>
    // timer
    var remainingTime = <?php echo $remaining_time; ?>;
    var timerElement = document.getElementById('timer');

    function updateTimer() {
        if (remainingTime > 0) {
            timerElement.textContent = remainingTime;
            remainingTime--;
            setTimeout(updateTimer, 1000);
        } else {
            timerElement.textContent = "Time's up !";
            window.location.href = "timeup.php"
        }
    }
    updateTimer();

    var answerBoxes = document.querySelectorAll('.answer-box');

    // anwser changer color
    answerBoxes.forEach(function(answerBox) {
        answerBox.addEventListener('mouseover', function() {
            this.style.backgroundColor = 'lightgreen'; 
        });

        answerBox.addEventListener('mouseout', function() {
            this.style.backgroundColor = ''; 
        });
        
        // boom effect
        if (answerBox.classList.contains('wrong')) {
            answerBox.addEventListener('click', function(e) {
                e.preventDefault();
                showBoomEffect();
            });
        }
    });

    function showBoomEffect() {
        var boom = document.getElementById('boom');
        boom.style.display = 'block';
        setTimeout(function() {
            window.location.href = 'wrong.php';
        }, 1000); // Redirect after 1 second
    }

    </script>
</body>
</html>