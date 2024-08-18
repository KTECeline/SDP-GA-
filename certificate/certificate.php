<?php
    session_start();

    include '../conn/conn.php';

    if (isset($_SESSION['USER_ID'])) {
        $user_id = $_SESSION['USER_ID']; 

        $stmt = $dbConn->prepare("SELECT CERTIFICATE_NAME, CERTIFICATE_ID FROM certificate_information WHERE USER_ID = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($name,$certificate_id);
        $stmt->fetch();

        if (!$name|| !$certificate_id) {
            echo "<script>alert('No certificate found for this user.'); window.location.href = 'certificate_details.php';</script>";
            exit();
        }
        $name = htmlspecialchars($name);
        $certificate_id = htmlspecialchars($certificate_id);

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
        <header class="active">
            <div class="container">
                <a href="../user/homepage.php"><img src="../image/Witchcraft.Code Logo.png"/></a>
            
                <ul class="header-action">
                    <li><a href="leaderboard.php">Leaderboard</a></li>
                    <?php 
                        if (isset($_SESSION['name'])) { 
                    ?>
                        <li class="dropdown">
                            <a href="../user/homepage.php" class="dropbtn"><?php echo $_SESSION['name']; ?></a>
                            <div class="dropdown-content">
                                <a href="../user/user_profile.php">Profile</a>
                                <a href="../login_register/logout.php">Logout</a>
                            </div>
                        </li>
                    <?php 
                        } else { 
                    ?>
                        <li><a href="../login_register/login.php"><i class="fa fa-sign-in"></i>Login</a></li>
                    <?php 
                        }
                    ?>   
                </ul>
            </div>
        </header>

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
            <button id="downloaddata" class="download-button" onclick="downloadCertificate()">Download E-Certificate</button>
            <button id="next" class="download-button" onclick="window.location.href='feedback.php?certificate_id=<?php echo urlencode($certificate_id); ?>'">Next</button>
        </div>

        <br>
        <?php include "../header_footer/footer.php"; ?>
        
    </body>
</html>