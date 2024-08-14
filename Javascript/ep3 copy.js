function moveImage() {
    var image = document.getElementById("myImage");
    image.classList.add("move");
  }

  var quizCountdownTimer;

  function startQuizCountdown(duration) {
      var countDownDate = new Date().getTime() + duration * 1000;
      clearInterval(quizCountdownTimer); // Clear any existing timer
      quizCountdownTimer = setInterval(function() {
          var now = new Date().getTime();
          var distance = countDownDate - now;
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          document.getElementById("quiz-countdown").innerHTML = minutes + "m " + seconds + "s ";
          if (distance < 0) {
              clearInterval(quizCountdownTimer);
              document.getElementById("quiz-countdown").innerHTML = "EXPIRED";
          }
      }, 1000);
  }
  
  function stopQuizCountdown() {
      clearInterval(quizCountdownTimer);
      document.getElementById("quiz-countdown").innerHTML = "Timer stopped";
  }

function countdown(parent, callback) {
    var texts = ['3', '2', '1','START!'];
    var paragraph = null;

    function count() {
        if (paragraph) {
            paragraph.remove();
        }

        if (texts.length === 0) {
            clearInterval(interval);
            callback();
            return;
        }

        var text = texts.shift();
        paragraph = document.createElement("p");
        paragraph.textContent = text;
        paragraph.className = text + " nums";

        parent.appendChild(paragraph);
    }

    var interval = setInterval(count, 1000);
}

window.onload = function() {
    countdown(document.getElementById("countdown"), function() {
        document.getElementById("countdown").style.display = 'none'; // Hide countdown
        document.getElementById("quiz-section").style.display = 'block'; // Show quiz section
    });
};