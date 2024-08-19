<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loading Episode 4</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/Episode4.css">
        <script>
            setTimeout(function() {
                window.location.href = "ep3.php?reset=true";
            }, 4500);
        </script>
        <style>
            body {
                background-image: url('../image/flying-witch.gif');
                background-size: cover; 
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: flex-end; 
            }
        </style>
    </head>

    <body>
        <header class="active">
            <div class="container">
                <a href="briefing4.php"><img src="../image/Witchcraft.Code Logo.png" alt="Witchcraft Code Logo"/></a>
            </div>
        </header>
        
        <main class="mission-briefing">
            <div class="rule-box">
                <div class="briefing-card">
                    <div class="spinner"></div>
                    <p class="loading-text">Loading to Episode 3...</p>
                </div>
            </div>
        </main>
    </body>
</html>