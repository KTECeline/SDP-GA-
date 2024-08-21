<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdp_ga";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$total_sql = "SELECT COUNT(*) as total FROM game_episode WHERE EPISODE_ID = 2";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_questions = $total_row['total'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witchcraft Code</title>
    <link rel="stylesheet" href="css/style.css">

<!-- Google link font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">

</head>

<style>
    input[type="radio"] {
        display: none;
    }

    body{
    margin-bottom: 30px;
    }
</style>

<body>

<header class="active">

<div class="container">
    <a href="#"><img src="image/Witchcraft.Code Logo.png"/></a>

    <div class="header-title">
            Episode 2: Control Flow and Function
        </div>
    
    <ul class="header-action">
        <li><a href="#" onclick="showExitMessage()">Exit</a></li>
    </ul>

</div>

</header>



<div class="quiz-container">
        <div class="status-bar">
            <div class="progress">
                <p>Progress : <span id="question-number">1</span>/<?php echo $total_questions; ?></p>
            </div>
            <div class="score" id="score">
                <p>Score XP : <span id="score-value">0</span></p>
            </div>
            <div class="timer">
                <img src="image/timer.png" alt="Timer" class="timer-icon">
                <p>Time : <span id="timer-display">00:00</span></p>
            </div>

        </div>

        <div id="question-container" class="question-container">
            <!-- Question content will be loaded here -->
        </div>

        <div id="explanation-container" class="explanation-container" style="display:none;">
            <p id="explanation-text" class="explanation-text"> </p>
        </div>

        <div class="navigation-buttons">
            <!-- <button id="prev-btn" class="prev-btn" onclick="loadQuestion(currentQuestion - 1)" disabled>Previous</button> -->
        </div>
</div>

<div id="summary-modal" class="modal">
    <div class="modal-content">
        <h2 class="modal-title">Episode 2 Summary</h2>
        <p class="modal-info" id="modal-message"></p>
        <div class="modal-buttons">
            <button id="next-episode-btn" class="exit-btn" style="display: none;" href="javascript:void(0);" onclick="nextEpisodeFunction()">Enter Tower</button>
            <button id="replay-btn" class="exit-btn" style="display: none;" onclick="replayGame()">Replay</button>
            <button class="exit-btn" onclick="exitFunction()">Exit Game</button>
        </div>
    </div>
</div>



    <div id="timeoutModal" class="model">
        <div class="model-content">
            <p id="messageText" class="Text">Time is up! You failed this episode.</p><br>
            <button onclick="replayGame()" class='next-button'>Replay</button>
            <button onclick="endGame()"class='next-button'>End Game</button>
        </div>
    </div>
    
    
    <div id="rulesModal" class="model">
    <div class="model-content">
        <p id="messageText" class="hints-Text">Welcome to Episode 2 ! 🚀</p><br>
        <p id="messageText" class="Text">This episode is designed to test your skills in Control Flow and Functions (if-else statements, loops). These are crucial concepts in programming, so be sure to think critically and apply what you've learned.</p><br>
        <p id="messageText" class="Text">Note: You need to score at least <strong>600 out of 1000 XP</strong> to pass this episode. Good luck! 🍀</p><br>
        <p id="messageText" class="Text">Rules:</p>
        <ul>
            <li>1. To advance, you must answer the Dragon Gatekeeper's question correctly.</li>
            <li>2. You can only enter <strong>A, B, C, or D</strong> according to the text cloud displayed in the input field.</li>
            <li>3. You only have <strong>"one chance"</strong> to answer, so choose wisely!</li>
            <li>4. Incorrect answers will result in a deduction of <strong>25 XP</strong>.</li>
        </ul>
        <button onclick="closeRulesMessage()" class='next-button'>Back</button>
    </div>
</div>


    <div id="hintsModal" class="modal" style="display: none;">

        <div class="model-content">
            <p id="messageText" class="hints-Text">Hint for this Question 🚀</p><br>
            <p id="hints-text" class="hints-text"> </p>
            <button onclick="closeHintsMessage()" class='next-button'>Back</button>
        </div>
 
    </div>


    <div id="exitModal" class="model" style="display: none;">
        <div class="model-content">
            <p id="messageText" class="Text">Are you sure you want to exit?</p><br>
            <button onclick="closeExitMessage()" class='next-button'>Cancel</button>
            <button onclick="confirmExit()" class='next-button'>Exit</button>
        </div>
    </div>


    <script>

let currentQuestion = 1;
let score = 0;
const totalQuestions = <?php echo $total_questions; ?>;
let correctAnswer = '';
let response = {}; // Global response object

document.addEventListener('DOMContentLoaded', function() {
    loadQuestion(currentQuestion);
});

function loadQuestion(questionNumber) {
    if (questionNumber < 1 || questionNumber > totalQuestions) {
        return;
    }

    currentQuestion = questionNumber;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'get_question.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            response = JSON.parse(xhr.responseText);

            if (response.error) {
                document.getElementById('question-container').innerHTML = '<p>' + response.error + '</p>';
                document.getElementById('explanation-container').style.display = 'none';
            } else {
                correctAnswer = response.CORRECT_ANSWER;

                const questionHtml = `
                    <div class="question-box" style="background-image: url('image/background6.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <img src="image/dragon.gif" alt="Question" class="gatekeeper">
                        <div class="question-image">
                            <img src="image/text_cloud_left.png" alt="Question Cloud" class="question-cloud">
                            <p class="question">${response.EPISODE_QUESTION}</p>
                        </div>
                        <div class="options-image">
                            <img src="image/text_cloud_right.png" alt="Options Cloud">
                            <div class="options">
                                <label>A. <input type="radio" name="answer_${response.EPISODE_QUESTION_ID}" value="A"> ${response.OPTION_A}</label>
                                <label>B. <input type="radio" name="answer_${response.EPISODE_QUESTION_ID}" value="B"> ${response.OPTION_B}</label>
                                <label>C. <input type="radio" name="answer_${response.EPISODE_QUESTION_ID}" value="C"> ${response.OPTION_C}</label>
                                <label>D. <input type="radio" name="answer_${response.EPISODE_QUESTION_ID}" value="D"> ${response.OPTION_D}</label>
                            </div>
                        </div>
                        <img src="image/cute bat.gif" alt="bat" class="bat" onclick="showRulesMessage()">
                        <img src="image/lightbulb.png" alt="lightbulb" class="lightbulb" onclick="showHintsMessage()">
                        <img src="image/Flying witch.gif" alt="witch" class="witch">
                        <div class="selected-answer">
                            <p>
                                Answer:    
                                <input type="text" id="typed-answer" placeholder="Type your answer">
                                <button onclick="submitAnswer()" id="sub-btn" class="submit-btn">Submit</button>
                                <button id="next-btn" class="next-btn" onclick="loadQuestion(currentQuestion + 1)" disabled>Next</button>
                                <button id="submit-btn" class="submit-btn" type="submit" style="display:none;" disabled onclick="showSummary()">Finish</button>
                            </p>
                        </div>
                    </div>
                `;

                document.getElementById('question-container').innerHTML = questionHtml;
                document.getElementById('question-number').innerText = currentQuestion;

                document.getElementById('explanation-container').style.display = 'none';

                document.getElementById('next-btn').style.display = currentQuestion === totalQuestions ? 'none' : 'inline-block';
                document.getElementById('submit-btn').style.display = currentQuestion === totalQuestions ? 'inline-block' : 'none';


        }
    }};

    xhr.send('question_number=' + questionNumber);
}


let totalQuestionsAnswered = 0;
let correctAnswers = 0;
let wrongAnswers = 0;


function submitAnswer() {
    const typedAnswer = document.getElementById('typed-answer').value.trim().toUpperCase();

    // Validate that an answer is provided
    if (typedAnswer === '') {
        alert('Please type your answer before submitting.');
        return;
    }

    // Check if the typed answer matches the correct answer
    if (typedAnswer === correctAnswer) {
        score += 100;
        correctAnswers++;
        showExplanation(typedAnswer);
    } else {
        score -= 25;
        wrongAnswers++;
        showExplanation(typedAnswer);
    }

    document.getElementById('score-value').innerText = score;

    // Disable the submit button and enable the next button
    document.getElementById('sub-btn').disabled = true;
    document.getElementById('next-btn').disabled = false;

    // If this is the last question, enable the Finish button
    if (currentQuestion === totalQuestions) {
        document.getElementById('submit-btn').disabled = false;
    }
}



function showExplanation(selectedOption) {
    const explanations = {
        A: response.OPTION_A_EXPLANATION,
        B: response.OPTION_B_EXPLANATION,
        C: response.OPTION_C_EXPLANATION,
        D: response.OPTION_D_EXPLANATION
    };

    const explanationText = explanations[selectedOption] || 'You answered wrong, you lose one chance ! Choose wisely, or face the consequences ! Remember, you can only input A, B, C, or D in the answer field.';
    document.getElementById('explanation-text').innerHTML = explanationText;
    document.getElementById('explanation-container').style.display = 'block';

    // Add smooth scrolling effect to explanation container
    const explanationContainer = document.getElementById('explanation-container');
    explanationContainer.scrollIntoView({ behavior: 'smooth' });
}




function replayGame() {
    window.location.href = 'episode2.php?reset=true';
}

function endGame() {
    window.location.href = '../../index.html'; 
}

function showExitMessage() {
    var messageModal = document.getElementById('exitModal');
    if (messageModal) {
        messageModal.style.display = 'block'; 
    } else {
        console.error('Exit modal element not found');
    }
}

function closeExitMessage() {
    var messageModal = document.getElementById('exitModal');
    if (messageModal) {
    messageModal.style.display = 'none';
}
}

function confirmExit() {
    var messageModal = document.getElementById('exitModal');
    if (messageModal) {
    messageModal.style.display = 'none';
    window.location.href = '../../index.html';
}
}


function exitFunction() {
    var messageModal = document.getElementById('summary-modal');
    if (messageModal) {
    messageModal.style.display = 'none';
    window.location.href = '../../index.html';

}
}

function showTimeoutMessage() {
    var messageModal = document.getElementById('timeoutModal');
    if (messageModal) {
    messageModal.style.display = 'block'; 
    } else {
    console.error('Timeout modal element not found');
    }
}

function showRulesMessage() {
    var messageModal = document.getElementById('rulesModal');
    if (messageModal) {
    messageModal.style.display = 'block'; 
    } else {
    console.error('Rules modal element not found');
    }
}

function closeRulesMessage() {
    var messageModal = document.getElementById('rulesModal');
    if (messageModal) {
    messageModal.style.display = 'none'; 
    } else {
    console.error('Hints modal element not found');
    }
}

function nextEpisodeFunction(){
    window.location.href = '../Episode 3/briefing3.php';
}

function showExplanation(selectedOption) {
    const explanations = {
        A: response.OPTION_A_EXPLANATION,
        B: response.OPTION_B_EXPLANATION,
        C: response.OPTION_C_EXPLANATION,
        D: response.OPTION_D_EXPLANATION
    };

    const explanationText = explanations[selectedOption] || 'You answered wrong, you lose one chance ! Remember, you should only answer with A, B, C, or D.';
    document.getElementById('explanation-text').innerHTML = explanationText;
    document.getElementById('explanation-container').style.display = 'block';

    // Add smooth scrolling effect to explanation container
    const explanationContainer = document.getElementById('explanation-container');
    explanationContainer.scrollIntoView({ behavior: 'smooth' });
}

function showHintsMessage() {
    const hintText = response.EPISODE_HINT;

    var messageModal = document.getElementById('hintsModal');
    if (messageModal) {
    messageModal.style.display = 'block'; 
    document.getElementById('hints-text').innerText = hintText;

    } else {
    console.error('Hints modal element not found');
    }

}

function closeHintsMessage() {
    var messageModal = document.getElementById('hintsModal');
    if (messageModal) {
    messageModal.style.display = 'none'; 
    } else {
    console.error('Hints modal element not found');
    }
}

function getEpisodeHint(episodeId, callback) {
    const query = 'SELECT EPISODE_HINT FROM game_episode WHERE EPISODE_ID = 2';
    
    db.query(query, [episodeId], (err, results) => {
        if (err) {
            console.error('Error retrieving episode hint:', err);
            return callback(err, null);
        }

        if (results.length > 0) {
            const episodeHint = results[0].EPISODE_HINT;
            callback(null, { hints: episodeHint });
        } else {
            callback('No hint found for this episode', null);
        }
    });
}




let timeRemaining = 11 * 60; // 10 minutes in seconds
    let timerInterval;

function startTimer() {
    timerInterval = setInterval(updateTimer, 1000); 
}

function updateTimer() {
    if (timeRemaining > 0) {
    timeRemaining--; // Decrease the remaining time by 1 second

    const minutes = Math.floor(timeRemaining / 60);
    const seconds = timeRemaining % 60;

    const formattedTime = `${formatTime(minutes)}:${formatTime(seconds)}`;
    document.getElementById('timer-display').innerText = formattedTime;
    } else {
    clearInterval(timerInterval); // Stop the timer when it reaches 0
    showTimeoutMessage(); // Display the timeout modal
    }
}

function formatTime(value) {
        return value.toString().padStart(2, '0'); 
}

function stopTimer() {
    clearInterval(timerInterval);
}

document.addEventListener('DOMContentLoaded', function() {
startTimer();
});


function showSummary() {
    stopTimer();

    const totalPoints = score;
    const totalQuestions = <?php echo $total_questions; ?>;
    const timeTaken = document.getElementById('timer-display').innerText;

    const modalMessage = `
        <div class="summary-item">
            <span class="summary-label">Time Taken:</span> 
            <span class="summary-value">${timeTaken}</span>
        </div><br>

        <div class="summary-item">
            <span class="summary-label">Points Earned:</span> 
            <span class="summary-value">${totalPoints}</span>
        </div><br>

        <div class="summary-item">
            <span class="summary-label">Correct Answers:</span> 
            <span class="summary-value">${correctAnswers}</span>
        </div><br>

        <div class="summary-item">
            <span class="summary-label">Wrong Answers:</span> 
            <span class="summary-value">${wrongAnswers}</span>
        </div><br>

        <div class="summary-item">
            <span class="summary-label">Total Questions:</span> 
            <span class="summary-value">${totalQuestions}</span>
        </div><br>

        <span class="${totalPoints >= 600 ? 'pass-message' : 'fail-message'}">
            ${totalPoints >= 600 ? '🐉: Congratulations! You passed this episode. <br> You are now allowed to enter the tower.🏰' : 'Sorry, you did not pass this episode. You need to score at least 600 to pass.'}
        </span>
    `;

    document.getElementById('modal-message').innerHTML = modalMessage;

    // Show or hide buttons based on the score
    if (totalPoints >= 600) {
        document.getElementById('next-episode-btn').style.display = 'inline-block';
        document.getElementById('replay-btn').style.display = 'none';
    } else {
        document.getElementById('next-episode-btn').style.display = 'none';
        document.getElementById('replay-btn').style.display = 'inline-block';
    }

    document.getElementById('summary-modal').style.display = 'block';

}



document.addEventListener('DOMContentLoaded', function() {
showRulesMessage();
});

</script>


</body>
</html>