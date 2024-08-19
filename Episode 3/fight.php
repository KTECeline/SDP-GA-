<?php
session_start();
// if (isset($_SESSION['name'])) { 
//     $username = $_SESSION['username'];
//     $user = $_SESSION['USER_ID'];
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/ocr-a-std" rel="stylesheet">
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
            transform: scale(5) translateY(-46%);
        }

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

        .monster {
            position: absolute;
            top: 55%;
            left: 40%;
            transform: translate(-50%, -50%) scaleX(-1);
            z-index: 2;
        }

        .laser {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            display: none;
        }

        .monster img {
            width: 200px;
            height: 200px;
        }

        .laser img {
            width: 200px;
            height: 200px;
        }

        header {
            background: #150849;
            width: 100%;
            height: 75px;
            position: fixed;
            z-index: 4;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.30);
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-grow: 0;
        }

        .logo-container img {
            width: 70px;
            cursor: pointer;
        }

        .header-title {
            flex-grow: 1;
            color: white;
            font-size: 18px;
            text-align: center;
        }
        .instructions {
            font-size: 25px;
            text-align: center;
            width: 2000px;
            padding: 10px;
            color: white;
            background-color: #150849;
            border-radius: 5px;
            position: absolute;
            bottom: 20px; /* Position it 20px from the bottom */
            left: 50%; /* Position it horizontally centered */
            transform: translateX(-50%); /* Center it with respect to its width */
            z-index: 1000; /* Ensures the instructions box is on top of other elements */
        }
    </style>
</head>
<body>
<header>
    <div class="logo-container">
        <a href="#"><img src="../image/Witchcraft.Code Logo.png"/></a>
    </div>
    <div class="header-title">Episode 3: Data Structure</div>
</header>

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
    <div class="instructions"> Click on the monsters to kill them!<div>
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

            if (currentMonster <= 10) {
                currentMonster++;
                monsterImg.src = `../image/monster${currentMonster}.png`;
                monsterDiv.style.display = 'block';
            }
        }
        if (currentFloor === 12) {
            window.location.href = "congrats.php";
        }
    });

    monsterDiv.addEventListener('click', () => {
        laserDiv.style.display = 'block';

        setTimeout(() => {
            laserDiv.style.display = 'none';
            monsterDiv.style.display = 'none';
            if (currentFloor < 12) {
                currentFloor++;
                img.className = 'scroll-floor-' + currentFloor;
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
