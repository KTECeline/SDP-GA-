<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/last.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&family=Matemasie&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="header-content">
        <a href="#"><img src="../image/Witchcraft.Code Logo.png" alt="Witchcraft Code Logo"/></a>
        <div class="header-title">
            Episode 1: Introduction to Python & Basic Syntax
        </div>
    </div>
</header>
    <div class="hint">
        Please Double Click The Witch, There Will Be An Evolution !!<br><br>Congratulations, You Can Proceed To Episode 2 !
    </div>
    <div class="image">
        <img src="../image/Flying witch.gif" alt="Flying witch" class="rotate90" id="witch">
    </div>

    <img src="../image/evolution.gif" alt="evolution" id="evolution">
    <img src="../image/NewWitch.gif" alt="New Witch" id="newWitch">
    
    <div class="next"><a href="../Episode 2/briefing2.php">NEXT</a></div>
    <div class="home"><a href="../user/homepage.php">HOME</a></div>

    <script>
        // JavaScript to handle the click event
        document.getElementById('witch').addEventListener('click', function() {
            var evolution = document.getElementById('evolution');
            var newWitch = document.getElementById('newWitch');
            var oldWitch = document.getElementById('witch');
            var next = document.querySelector('.next');
            var home = document.querySelector('.home');

            if (evolution.style.display === 'none') {
                evolution.style.display = 'block'; // Show evolution effect

                // Delay of 3 seconds (3000 milliseconds) before showing new witch GIF
                setTimeout(function() {
                    newWitch.style.display = 'block';

                    // After the new witch is shown, make it "run out"
                    setTimeout(function() {
                        newWitch.classList.add('run-out');
                        next.style.display = 'block';
                        home.style.display = 'block'
                    }, 2000);

                    // Remove the old witch and evolution effect after the run-out is complete
                    setTimeout(function() {
                        evolution.remove();
                        oldWitch.remove();
                    }, 1);

                }, 3000);
            } else {
                evolution.style.display = 'none'; // Hide evolution effect
                newWitch.style.display = 'none'; 
                next.style.display = 'none';
                home.style.display = 'none';
            }
        });
    </script>
</body>
</html>
