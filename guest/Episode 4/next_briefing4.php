<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Briefing 4</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/Episode4.css">
        <style>
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
        <script>
            function startEpisode() {
                document.body.classList.add('fade-out'); 
                setTimeout(function() {
                    window.location.href = "loading4.php"; 
                }, 1000); 
            }
        </script>
    </head>

    <body>
        <header class="active">
            <div class="container">
                <a href="../user/homepage.php"><img src="../image/Witchcraft.Code Logo.png"/></a>
            </div>
        </header>

        <main class="mission-briefing">
            <div class="rule-box">
                <h1>🌟 Game Instructions 🌟</h1>
                <div class="briefing-card">
                    <p>You need to navigate through the maze using the arrow keys on your keyboard.<br>
                    <i class="fas fa-arrow-left arrow-left" title="Left"></i> Left &nbsp;
                    <i class="fas fa-arrow-up arrow-up" title="Up"></i> Up &nbsp;
                    <i class="fas fa-arrow-right arrow-right" title="Right"></i> Right &nbsp;
                    <i class="fas fa-arrow-down arrow-down" title="Down"></i> Down<br><br>
                    When you get close to a treasure chest, you'll trigger questions to answer.<br>
                    Ready to test your skills and find your way out? Let's go!</p>
                </div>
            </div>
        </main>
           
        <main class="button">
            <div class="action-buttons left">
                <a href="../Episode4/vid.php" class="btn btn-secondary"> &lt;-- Back</a>
            </div>
        
            <div class="action-buttons right">
                <a href="javascript:void(0);" onclick="startEpisode()" class="btn btn-primary">Start --&gt; </a>
            </div>
        </main>        
    </body>
</html>