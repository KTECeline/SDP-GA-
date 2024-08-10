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

</head>

<body>

<header class="active">

<div class="container">
    <a href="homepage.php"><img src="../image/Witchcraft.Code Logo.png"/></a>

    <ul class="header-action">
        <li><a href="leaderboard.php">Leaderboard</a></li>
        <li><a href="profile.php">Profile</a></li>
    </ul>

</div>

<div class="mPage">
    <img src="../image/Witchcraft.Code Logo (Without bg).png" name="backgroundLogo"/>
    <img src="../image/purpleSky.jpeg" alt="purpleSky" name="backgroundhidden">
    <button onclick="playnow()">Play Now</button>
</div>

</header>


<!-- Dashboard button -->

<input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>


<!-- Dashboard -->

<section id="side-bar">
        <div class="profile">
            <img src="../image/cute ghost 2.gif" class="logo-image" alt="">
        </div>

        <div class="course">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Past Papers</a></li>
                <li><a href="#">Tests & Quizzes</a></li>
                <li><a href="#">View Result</a></li>
            </ul>
        </div>
</section>


<footer>

    <div class="footer-bottom">
        <div class="container">
            <p class="copyright">&copy; 2024 Witchcraft.Code. All rights reserved.</p>
        </div>
    </div>
    
    </footer>




</body>
</html>