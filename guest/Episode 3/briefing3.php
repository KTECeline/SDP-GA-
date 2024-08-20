<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episode 3 Brief</title>
    <link rel="stylesheet" href="../Episode 2/css/brief.css">
    

<!-- Google link font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">


    <script src="Javascript/script.js"></script>

<style>
    body {
        height: 100vh;
        width: 100%;
        background: var(--dark-violet) url('../Episode 2/image/background12.jpg') no-repeat center center/cover;
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
        <a href="../../index.html"><img src="../../image/Witchcraft.Code Logo.png"/></a>
    </div>
</header>

<main class="mission-briefing">
    <div class="rule-box">
        <h1>⭐ Mission Briefing ⭐</h1>
        <div class="briefing-card">
            <h2>Episode 3: The Tower of Horrors 🐉</h2>
            <p>🎉 Congratulations! 🎉</p>
            <p>You've successfully completed Episode 2 and passed the gate!
                <br>But the journey ahead is filled with even greater challenges! <br>
             </p>
        <p>🏰 In this mission, you must prove your mastery of <strong>"Data Structure"</strong> by collecting wands to upgrade your spells.
                These questions will test your mastery of lists, tuples, dictionaries, and sets. 💻
                <br>Each correct answer strengthens your wand's power, bringing you one step closer to victory. 
                <br>But beware—wrong answers will strengthen its defenses 🛡️ and could bar your passage to the next episode. 🚫</p>

            </div>
    </div>
</main>

<main class="button">
    <div class="action-buttons left">
        <a href="../../index.html" class="btn btn-secondary"> &lt;-- Back</a>
    </div>

    <div class="action-buttons right">
    <a href="vid.php" class="btn btn-primary">Next --&gt; </a>
    </div>
</main>        
    </body>
</html>