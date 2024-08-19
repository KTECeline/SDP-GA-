<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episode 1 Brief</title>
    <link rel="stylesheet" href="../css/brief.css">
    

<!-- Google link font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">


    <script src="Javascript/script.js"></script>

<style>
    body {
        height: 100vh;
        width: 100%;
        background: var(--dark-violet) url('image/background12.jpg') no-repeat center center/cover;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        font-family: "Kanit", sans-serif;
    }
            
    .fade-out {
        animation: fadeOut 1s forwards; 
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
</style>

</head>

<body>


<header class="active">
    <div class="container">
        <a href="../user/homepage.php"><img src="image/Witchcraft.Code Logo.png"/></a>
    </div>
</header>

<main class="mission-briefing">
    <div class="rule-b>ox">
        <h1>⭐ Mission Briefing ⭐</h1>
        <div class="briefing-card">
            <h2>Episode 1: Escape the castle! 🐉</h2>
            <p>🎉 HII, thanks for helping out 🎉</p>
            <p>The witch here is stuck for 15 years miserably in the castle
                <br>She needs your help in escaping! <br>
             </p>
        <p>🏰 In this mission, you must prove your mastery of <strong>"Basic of Python and its Syntax"</strong>.
                These questions will test your mastery of variables and operations. 
                <br>Learn to help the witch escape!</p>

            </div>
    </div>
</main>

<main class="button">
    <div class="action-buttons left">
        <a href="../user/homepage.php" class="btn btn-secondary"> &lt;-- Back</a>
    </div>

    <div class="action-buttons right">
    <a href="vid.php" class="btn btn-primary">Next --&gt; </a>
    </div>
</main>        
    </body>
</html>