<?php
    session_start();
    include '../conn/conn.php';

    $row = [];
    $certificates = [];

    if (isset($_SESSION['name'])) {
        $username = $_SESSION['name'];
        $sql = "SELECT * FROM user_information WHERE USER_USERNAME = ?";
        $stmt = $dbConn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<script>alert('No data found for the logged-in user!');</script>";
        }
        $stmt->close();

        $userId = $row['USER_ID']; 
        $certSql = "SELECT * FROM certificate_information WHERE USER_ID = ?";
        $stmt = $dbConn->prepare($certSql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $certResult = $stmt->get_result();
        $certificates = $certResult->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/sidebar.css">
        <link rel="stylesheet" href="../css/profile.css">
        <link rel="stylesheet" href="../css/certificate.css">
        <script src="../Javascript/certificate.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    </head>

    <style>
        body {
            background-image: url('../image/User background.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0px;
        }

        @media print {
            body * {
                visibility: hidden; 
            }
            .certificate, .certificate * {
                visibility: visible; 
            }
            .certificate {
                position: absolute; 
                left: 0;
                top: 0;
            }
        }
    </style>

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

        <!-- side bar button -->
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>

        <!-- Profile Side bar -->
        <section id="side-bar">
            <div class="profile">
                <img src="../image/User profile.png" class="image" width="80px" alt="">
                <h3 class="name"><?php echo htmlspecialchars($row['USER_NAME']); ?></h3>
                <p class="role">User</p>
                <a href="user_profile.php" class="btn">View Profile</a>
            </div>

            <ul>
                <li><a href="user_profile.php"><i class="fas fa-user"></i>Profile</a></li>
                <li><a href="user_leaderboard.php"><i class="fas fa-trophy"></i>Leaderboard</a></li>
                <li><a href="user_certificate.php"><i class="fas fa-certificate"></i>Certificate</a></li>
                <li><a href="../login_register/logout.php"><i class="fas fa-door-open"></i>Log Out</a></li>
            </ul>        
        </section>

        <section id="profile">
            <?php if (count($certificates) > 0): ?>

                <?php foreach ($certificates as $certificate): ?>
                    <div class='certificate'>
                        <div id="main"> 
                            <div id="certs" class="certs">
                                <div class="certi">
                                    <img src="../image/Witchcraft.Code Logo (Without bg).png" alt="logo" class="img1"/>
                                    <div class="logo">Witchcraft.Code</div>

                                    <div class="marquee">Certificate of Completion</div>

                                    <div class="assignment">This certificate is proudly presented to</div>

                                    <div class="person">
                                        <?php echo htmlspecialchars($certificate['CERTIFICATE_NAME']); ?>
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
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="info">
                    <div class="boxes">
                        <div class="detail">
                            <br>
                            <h4>No certificate records found. <br>
                                You need to complete all the episode!.</h4>
                            <img src="../image/not found.png" class="image"/></a>
                        </div>
                      
                        <div class="button-container">
                            <a href="../user/homepage.php" class="btn">Back</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <br>
        <?php include "../header_footer/footer.php"; ?>

    </body>
</html>