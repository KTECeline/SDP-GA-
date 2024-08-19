<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Briefing 2</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/Episode4.css">
        <style>
            video {
                width: 90%;
                height: auto;
            }

            .rule-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                margin-top: 50px;
            }
        </style>
    </head>

    <body>
        <header class="active">
            <div class="container">
                <a href="../user/homepage.php"><img src="../image/Witchcraft.Code Logo.png"/></a>
            </div>
        </header>

        <main class="mission-briefing">
            <div class="rule-box">
                <h1>Tutorial</h1>
                    <video widht="400px" height="500px" controls autoplay>
                        <source src="ep2vid.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
            </div>
        </main>

        <main class="button">
            <div class="action-buttons left">
                <a href="ep2brief.php" class="btn btn-secondary"> &lt;-- Back</a>
            </div>
        
            <div class="action-buttons right">
                
                <a href="javascript:void(0);" onclick="startEpisode()" class="btn btn-primary">Start --&gt; </a>
            </div>
        </main>        
    </body>
</html>

<script>
    function startEpisode() {
        document.body.classList.add('fade-out'); 
        setTimeout(function() {
            window.location.href = "ep2loading.php"; 
        }, 1000); 
    }
</script>