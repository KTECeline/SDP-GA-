<?php
    session_start();
    
    include '../../admin/profile/conn.php';
    
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
        echo "<script>window.location.href = '../../admin/profile/update.php';</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../css/admin/sidebar.css">
    <link rel="stylesheet" href="../../admin/profile/profile.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!--SIDEBAR-->
    <?php include '../../admin/sidebar.php'; ?>

    <!--MAIN CONTENT-->
    <div class="main-content">
    <section id="profile">
            <div class="info">
                <div class="box">
                    <div class="box-content">
                        <div class="left">
                            <img src="../../image/blackcat.png" class="propic" alt="">
                            <h3 class="name"><?php echo $row['USER_NAME'] ?></h3>
                            <p class="role">Admin</p>
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
                                        <div class="label">Username :</div>
                                        <div class="value"><?php echo $row['USER_USERNAME'] ?></div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="label">Email Address :</div>
                                        <div class="value"><?php echo $row['USER_EMAIL'] ?></div>
                                    </div>
                                    <div class="detail-item"> 
                                        <div class="label">Phone Number :</div>
                                        <div class="value"><?php echo $row['USER_PHONENUMBER'] ?></div>
                                    </div>
                                    <div class="detail-item"> 
                                        <div class="label">Password :</div>
                                        <div class="value"><?php echo $row['USER_PASSWORD'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="update">
                            <div class="button-container">
                            <a href="../homepage.php" class="btn">Back</a>
                            <a href="../../admin/profile/editprofile.php" class="btn">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="../../Javascript/sidebar.js"></script>
</body>
</html>