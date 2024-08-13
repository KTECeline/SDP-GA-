<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Google link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/header.css">

</head>
<body>
    <?php include "header.php"?>

    <div class="top">
        <img src="../image/Halloween Chill.gif" alt="Halloween chill" class="backgroundhidden">
        <img src="../image/Witchcraft.Code Logo (Without bg).png" class="backgroundImg"/>
        <button class="top-btn" onclick="playnow()" >Play Now</button>
    </div>

    <div class="midSession">
        <div class="homepageVid">
            <video class="video-placeholder" controls>
                <source src="#" type="video/mp4">
            </video>
        </div>
        <div class="homepageMidText">
            <h3>Introductions to our python learning game</h3>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                 reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, 
                  

            </p>
        </div>
    </div>

    <!-- carousel -->
    <div class="carousel">
        <!-- list item -->
        <div class="list">
            <div class="item">
                <img src="../image/1.png">
                <div class="content">
                    <div class="author">ERIC</div>
                    <div class="title">EPISODE 1</div>
                    <div class="topic">Intro to Python and Basic Syntax</div>
                    <div class="des">
                        <!-- lorem 50 -->
                        Learn more about variables, data types and basic operations in Python. This is the first episode of the Python series. Stay tuned for more episodes.
                    </div>
                    <div class="buttons">
                        <button>PLAY NOW</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../image/2.png">
                <div class="content">
                    <div class="author">HUEY YEE</div>
                    <div class="title">EPISODE 2</div>
                    <div class="topic">Control Flow and Funtion</div>
                    <div class="des">
                        If else, loops and functions are the main topics in this episode. Stay tuned for more episodes.
                    </div>
                    <div class="buttons">
                        <button>PLAY NOW</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../image/3.png">
                <div class="content">
                    <div class="author">JIN YI</div>
                    <div class="title">EPISODE 3</div>
                    <div class="topic">DATA STRUCTURE</div>
                    <div class="des">
                        list, tuples, dictionary and sets are the main topics in this episode. Stay tuned for more episodes.
                    </div>
                    <div class="buttons">
                        <button>PLAY NOW</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../image/4.png">
                <div class="content">
                    <div class="author">HUI NAN</div>
                    <div class="title">EPISODE 4</div>
                    <div class="topic">FILE HANGDLING AND LIBRARY</div>
                    <div class="des">
                        Read from, write to file
                    </div>
                    <div class="buttons">
                        <button>PLAY NOW</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- list thumnail -->
        <div class="thumbnail">
            <div class="item">
                <img src="../image/5.png">
                <div class="content">
                    <div class="title">
                        Name Slider
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../image/6.png">
                <div class="content">
                    <div class="title">
                        Name Slider
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../image/7.png">
                <div class="content">
                    <div class="title">
                        Name Slider
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../image/8.png">
                <div class="content">
                    <div class="title">
                        Name Slider
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
        </div>
        <!-- next prev -->

        <div class="arrows">
            <button id="prev"> < </button>
            <button id="next">></button>
        </div>
    </div>
    
    <?php include "footer.php"?>

    <script src="../Javascript/script.js"></script>
</body>
</html>