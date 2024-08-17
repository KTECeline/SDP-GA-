<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Feedback Form</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/certificate.css">
        <script src="../Javascript/certificate.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    </head>
    
    <body>
        <?php include "../header_footer/header.php"; ?>

        <section id="certificate">
            <form class="cer" action="certificate_save.php" method="post">
                <div class="details">
                    <span class="close-button" onclick="closeLogin()">🗙</span>
                    <h1>Feedback Form</h1>
                    <h4>Thanks for playing Witchcraft.code! <br>
                        Please share your feedback about our e-learning game.</h4>
                    <div class="form">
                        <label>Your feedback:</label>
                        <input type="text" name="feedback" required placeholder="Enter your feedback">
                    </div>
                    <div class="form">
                        <div class="button-container">
                            <button id="feedback" class="submit-btn" type="submit" name="feedback">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <?php include "../header_footer/footer.php"; ?>
    </body>
</html>