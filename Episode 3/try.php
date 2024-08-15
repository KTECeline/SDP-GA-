<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Zoom and Scroll</title>
    <style>
        .image-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }
        .witch{
            position: absolute; /* Use absolute positioning for the witch image */
            top: 50%; /* Adjust the top position to center the witch image vertically */
            left: 60%; /* Adjust the left position to center the witch image horizontally */
            transform: translate(-50%, -50%); /* Use translate to center the witch image */
            z-index: 1; /* Set the z-index to place the witch image on top of the tower image */
            width: 200px; /* Set the width of the witch image to 20px (adjust as needed) */
            height: 200px; /* Set the height of the witch image to 20px (adjust as needed) */
        }

        .image-container img {
            width: 100%;
            transition: transform 2s ease;
            cursor: pointer;
        }

        .scroll-floor-0 {
            transform: scale(5) translateY(-60%);
        }

        .scroll-floor-1 {
            transform: scale(5) translateY(-46%); /* Adjust percentage based on the height of each floor */
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
        .scroll-floor-12 {
            transform: scale(5) translateY(53%);
        }
    </style>
</head>
<body>
<div class="image-container">
    <img src="../image/tower.png" alt="Zoomable Image" id="zoomable-image">
    <div class="witch">
        <img src="../image/Flying witch.gif" />
    </div>
</div>
    <script>
        const img = document.getElementById('zoomable-image');
        let currentFloor = 0;

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
