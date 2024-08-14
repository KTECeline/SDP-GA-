let preQuizTimer;
let quizTimer;
let timeLeft = 60;
let initialCountdownShown = false; // Flag to track if the initial countdown was shown

function startPreQuizTimer() {
    let count = 3;
    const preCountdownElement = document.getElementById('countdown');
    preCountdownElement.style.display = 'block';

    preQuizTimer = setInterval(function() {
        preCountdownElement.innerText = count;
        count--;
        if (count < 0) {
            clearInterval(preQuizTimer);
            preCountdownElement.style.display = 'none';
            startQuizTimer();
        }
    }, 1000);
}

function startQuizTimer() {
    document.getElementById('quiz-section').style.display = 'block';
    quizTimer = setInterval(function() {
        const countdownElement = document.getElementById('quiz-countdown');
        countdownElement.innerText = 'Time Left: ' + timeLeft + 's';
        timeLeft--;

        if (timeLeft < 0) {
            clearInterval(quizTimer);
            alert("Time's up! Moving to the next question.");
            document.querySelector("form").submit();
        }
    }, 1000);
}

function stopQuizTimer() {
    clearInterval(quizTimer);
    timeLeft = 60; // Reset the timer for the next question
}


function handleCorrectAnswer() {
    stopQuizTimer();
    document.getElementById('next-button').style.display = 'block'; // Show the next button
}