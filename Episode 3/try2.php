<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Zoom and Scroll</title>
    <style>
        body {
            background: url('../image/fight.gif') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-align: center;
            font-family: 'OCR A Std', sans-serif;
        }
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
            width: 250px;
            height: 250px;
        }
        .image-container img {
            width: 100%;
            transition: transform 2s ease;
            cursor: pointer;
        }
        .start-position {
            transform: scale(5) translateY(-46%); /* Adjust this value to start from the bottom */
        }
        .scroll-floor-1 {
            transform: scale(5) translateY(-46%);
        }
        .scroll-floor-2 {
            transform: scale(5) translateY(-37%);
        }
        .scroll-floor-3 {
            transform: scale(5) translateY(-28%);
        }
        .scroll-floor-4 {
            transform: scale(5) translateY(-19%);
        }
        .scroll-floor-5 {
            transform: scale(5) translateY(-10%);
        }
        .scroll-floor-6 {
            transform: scale(5) translateY(-1%);
        }
        .scroll-floor-7 {
            transform: scale(5) translateY(8%);
        }
        .scroll-floor-8 {
            transform: scale(5) translateY(17%);
        }
        .scroll-floor-9 {
            transform: scale(5) translateY(26%);
        }
        .scroll-floor-10 {
            transform: scale(5) translateY(35%);
        }
        .scroll-floor-11 {
            transform: scale(5) translateY(44%);
        }
        .monster {
            position: absolute;
            top: 55%; /* Adjust the position as needed */
            left: 40%; /* Adjust the position as needed */
            transform: translate(-50%, -50%) scaleX(-1);
            z-index: 2;
        }
        .laser {
            position: absolute;
            top: 50%; /* Adjust the position as needed */
            left: 50%; /* Adjust the position as needed */
            transform: translate(-50%, -50%);
            z-index: 3;
            display: none;
        }
        .monster img {
            width: 200px; /* Resize the monster */
            height: 200px;
        }
        .laser img {
            width: 200px; /* Resize the laser */
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="../image/tower.png" alt="Zoomable Image" id="zoomable-image" class="start-position">
        <div class="witch">
            <img src="../image/Flying witch.gif" />
        </div>
        <div class="monster" id="monster">
            <img src="../image/monster1.png" id="monster-img"/>
        </div>
        <div class="laser" id="laser">
            <img src="../image/laser.gif" />
        </div>
    </div>
    <script>
        const img = document.getElementById('zoomable-image');
        const monsterImg = document.getElementById('monster-img');
        const monsterDiv = document.getElementById('monster');
        const laserDiv = document.getElementById('laser');

        let currentFloor = 1;
        let currentMonster = 1;

        img.addEventListener('click', () => {
            if (currentFloor < 12) {
                currentFloor++;
                img.className = 'scroll-floor-' + currentFloor;

                // Show the next monster
                if (currentMonster <= 10) {
                    currentMonster++;
                    monsterImg.src = `../image/monster${currentMonster}.png`;
                    monsterDiv.style.display = 'block';
                }
            } else {
                img.className = 'scroll-floor-1';
                currentFloor = 1;
                currentMonster = 1;
                monsterImg.src = `../image/monster${currentMonster}.png`;
                monsterDiv.style.display = 'block';
            }
        });

        monsterDiv.addEventListener('click', () => {
            // Show laser effect first
            laserDiv.style.display = 'block';

            setTimeout(() => {
                laserDiv.style.display = 'none'; // Hide the laser after 1.5 seconds
                monsterDiv.style.display = 'none'; // Hide the monster after laser effect
                
                // Automatically scroll the tower after the monster disappears
                if (currentFloor < 12) {
                    currentFloor++;
                    img.className = 'scroll-floor-' + currentFloor;

                    // Show the next monster
                    if (currentMonster < 10) {
                        currentMonster++;
                        monsterImg.src = `../image/monster${currentMonster}.png`;
                        monsterDiv.style.display = 'block';
                    }
                }
            }, 1500);
        });
    </script>
</body>
</html>
