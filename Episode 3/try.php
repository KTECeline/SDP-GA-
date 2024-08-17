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
            width: 200px;
            height: 200px;
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
    
    </style>
</head>
<body>
    <div class="image-container">
        <img src="../image/tower.png" alt="Zoomable Image" id="zoomable-image" class="start-position">
        <div class="witch">
            <img src="../image/Flying witch.gif" />
        </div>
        <div class="monster">
            <img src="../image/monster1.png" />
            <img src="../image/monster2.png" />
            <img src="../image/monster3.png" />
            <img src="../image/monster4.png" />
            <img src="../image/monster5.png" />
            <img src="../image/monster6.png" />
            <img src="../image/monster7.png" />
            <img src="../image/monster8.png" />
            <img src="../image/monster9.png" />
            <img src="../image/monster10.png" />
        </div>
        <div class= "laser">
            <img src="../image/laser.gif" />
        </div>
    </div>
    <script>
        const img = document.getElementById('zoomable-image');
        let currentFloor = 1;
        let monster = 1;

        img.addEventListener('click', () => {
            if (currentFloor < 12) {
                currentFloor++;
                img.className = 'scroll-floor-' + currentFloor;
            } else {
                img.className = 'scroll-floor-0';
                currentFloor = 0;
            }
        });
    </script>
</body>
</html>
