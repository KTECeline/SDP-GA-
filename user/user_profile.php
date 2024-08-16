<?php
    session_start();
    
    include '../conn/conn.php';
    
    if(isset($_SESSION['name'])) {
        $username = $_SESSION['name'];;
        $sql = "SELECT * FROM user_information WHERE USER_USERNAME = '$username'";
        $result = mysqli_query($dbConn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
        } else {
            echo "<script>alert('No data found for the logged-in user!');</script>";
        }
    } else {
        echo "<script>window.location.href = 'update_user_profile.php';</script>";
        exit();
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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/sidebar.css">
        <link rel="stylesheet" href="../css/profile.css">
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
    </style>

    <body>

        <?php include "../header_footer/header.php" ?>

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
                <h3 class="name"><?php echo $row['USER_NAME'] ?></h1></h3>
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
            <div class="info">
                <div class="box">
                    <div class="box-content">
                        <div class="left">
                            <img src="../image/User profile.png" class="image" alt="">
                            <h3 class="name"><?php echo $row['USER_NAME'] ?></h3>
                            <p class="role">User</p>
                        </div>

                        <div class="divider"></div> 
                            <div class="right">
                                <h3>Your Profile Details</h3>
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <div class="label">Full Name :</div>
                                        <div class="value"><?php echo $row['USER_NAME'] ?></div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="label">Email Address :</div>
                                        <div class="value"><?php echo $row['USER_EMAIL'] ?></div>
                                    </div>
                                    <div class="detail-item"> 
                                        <div class="label">Phone Number :</div>
                                        <div class="value"><?php echo $row['USER_PHONENUMBER'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="update">
                            <div class="button-container">
                                <a href="homepage.php" class="btn">Back</a>
                                <a href="edit_user_profile.php" class="btn">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include "../header_footer/footer.php" ?>

    </body>
</html>