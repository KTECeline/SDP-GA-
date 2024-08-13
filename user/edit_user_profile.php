<?php
    session_start();

    include '../conn/conn.php';

    if(isset($_SESSION['name'])) {
        $username = $_SESSION['name'];
        $sql = "SELECT * FROM user_information WHERE USER_USERNAME = '$username'";
        $result = mysqli_query($dbConn, $sql); 

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result); 
            $name = $row['USER_NAME'];
            $email = $row['USER_EMAIL'];
            $phone = $row['USER_PHONENUMBER'];
            
        } else { 
            echo "<script>alert('No data found for the logged-in user!');</script>";
            exit();
        }
    } else { 
        echo "<script>window.location.href = 'user_profile.php';</script>";
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
    
        <?php include "header.php"?>

        <!-- side bar button -->
        <input type="checkbox" id="check">
            <label for="check">
                <i class="fas fa-bars" id="btn"></i>
                <i class="fas fa-times" id="cancel"></i>
            </label>

        <!-- Profile Side bar -->
        <section id="side-bar">
            <div class="profile">
                <img src="../image/User profile.png" class="image" width="50px" alt="">
                <h3 class="name"><?php echo $row['USER_NAME'] ?></h1></h3>
                <p class="role">User</p>
                <a href="user_profile.php" class="btn">View Profile</a>
            </div>

            <ul>
                <li><a href="user_profile.php"><i class="fas fa-book-open"></i>Profile</a></li>
                <li><a href="leaderboard.php"><i class="fas fa-landmark"></i>Leaderboard</a></li>
                <li><a href="certificate.php"><i class="fas fa-landmark"></i>Certificate</a></li>
                <li><a href="../login_register/logout.php"><i class="fas fa-door-open"></i>Log Out</a></li>
            </ul>        
        </section>

        <section id="profile">
            <form class="edit-profile" action="update_user_profile.php" method="post">
                <div class="details">
                    <h3>Edit Your Details</h3>
                    <div class="edit-form" style="display:none">
                        <label>Id:</label>
                        <input type="hidden" name="id" value="<?php echo $row['USER_ID'] ?>" required="required">
                    </div>
                    <div class="edit-form">
                        <label>Full Name:</label>
                        <input type="text" name="new_name" value="<?php echo $row['USER_NAME'] ?>" required="required">
                    </div>
                    <div class="edit-form">
                        <label>Email Address:</label>
                        <input type="email" name="new_email" value="<?php echo $row['USER_EMAIL'] ?>" required="required">
                    </div>
                    <div class="edit-form">
                        <label>Phone Number:</label>
                        <input type="text" name="new_phonenum" value="<?php echo $row['USER_PHONENUMBER'] ?>" required="required">
                    </div>
                    <div class="edit-form">
                        <div class="button-container">
                            <button class="submit-btn" onclick="window.location.href='user_profile.php'">Back</button>
                            <button type="submit" name="submit" class="submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <?php include "footer.php" ?>

    </body>
</html>