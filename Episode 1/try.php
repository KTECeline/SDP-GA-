<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timer Test</title>
</head>
<body>
    <div id="timer"></div>

    <script>
    var endTime = new Date().getTime() + 30000; // 30 seconds from now
    var timerElement = document.getElementById('timer');

    function updateTimer() {
        var currentTime = new Date().getTime();
        var remainingTime = Math.max(0, Math.floor((endTime - currentTime) / 1000));
        timerElement.textContent = remainingTime;

        if (remainingTime > 0) {
            setTimeout(updateTimer, 1000);
        } else {
            timerElement.textContent = "Time's up!";
        }
    }
    updateTimer();
    </script>
</body>
</html>
