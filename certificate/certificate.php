<?php
    session_start();

    include '../conn/conn.php';

    if (isset($_SESSION['USER_ID'])) {
        $user_id = $_SESSION['USER_ID']; 

        $stmt = $dbConn->prepare("SELECT CERTIFICATE_NAME FROM certificate_information WHERE USER_ID = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();

        if (!$name) {
            echo "<script>alert('No certificate found for this user.'); window.location.href = 'certificate_details.php';</script>";
            exit();
        }

        $stmt->close();
    } else {
        echo "<script>alert('User not logged in.'); window.location.href = '../login_register/login_register.php';</script>";
        exit();
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Certificate</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/certificate.css">
        <script src="../Javascript/certificate.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    </head>

    <body>

        <?php include "../header_footer/header.php"; ?>

        <div id="main"> 
            <div id="certs" class="certs">
                <div class="certi">
                    <img src="../image/Witchcraft.Code Logo (Without bg).png" alt="logo" class="img1"/>
                    <div class="logo">Witchcraft.Code</div>

                    <div class="marquee">Certificate of Completion</div>

                    <div class="assignment">This certificate is proudly presented to</div>

                    <div class="person">
                        <?php echo htmlspecialchars($name); ?>
                    </div>

                    <div class="reason">
                        For successfully completing the <br>
                        Witchcraft.Code Python E-learning Game.
                    </div>
                </div>
            </div>
        </div>

        <div class="button">
            <button id="back" class="btn" onclick="window.location.href='certificate_details.php'">Back</button>
            <button id="downloaddata" class="btn" onclick="downloadCertificate()">Download E-Certificate</button>
            <button id="exit" class="btn" onclick="window.location.href='../user/homepage.php'">Exit</button>
        </div>

        <br>
        <?php include "../header_footer/footer.php"; ?>
        
    </body>
</html>