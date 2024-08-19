<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episode 2 Brief</title>
    <link rel="stylesheet" href="css/brief.css">
    

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
            <h2>Episode 2: The Gatedragon's Challenge 🐉</h2>
            <p>🎉 Congratulations! 🎉</p>
            <p>You've successfully completed Episode 1 and leveled up your skills. 
                <br>But the journey ahead is filled with even greater challenges! <br>
             </p>
        <p>🏰 In this mission, you must prove your mastery of <strong>"Control Flow and Functions"</strong> by answering the Gatedragon's riddles.
                These questions will test your mastery of if-else statements, loops, and functions. 💻
                <br>Each correct answer weakens the Gatedragon's resolve, bringing you one step closer to victory. 
                <br>But beware—wrong answers will strengthen its defenses 🛡️ and could bar your passage to the next episode. 🚫</p>

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