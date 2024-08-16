<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You</title>
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
            <form class="cer" method="post">
                <div class="details">
                    <span class="close-button" onclick="closeLogin()">🗙</span>
                    <h4>Once again, thanks for participate in Witchcraft.Code</h4>
                    <img src="../image/thank you.gif" class="img"/>

                    <div class="form">
                        <div class="button-container">
                            <button id="exit" class="btn" type="button" onclick="window.location.href='../user/homepage.php';">Exit</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <?php include "../header_footer/footer.php"; ?>
    </body>
</html>
