<?php
    session_start();
    
    include '../../conn/conn.php';
    
    if(isset($_SESSION['name'])) {
        $username = $_SESSION['name'];
        $sql = "SELECT * FROM user_information WHERE USER_USERNAME = '$username'";
        $result = mysqli_query($dbConn, $sql); 
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result); 
            $name = $row['USER_NAME'];
            $email = $row['USER_EMAIL'];
            $phone = $row['USER_PHONENUMBER'];
            $username= $row['USER_USERNAME'];
            $password = $row['USER_PASSWORD'];
            
        } else { 
            echo "<script>alert('No data found for the logged-in user!');</script>";
            exit();
        }
    } else { 
        echo "<script>window.location.href = '../admin/profile/profile.php';</script>";
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
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
        <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <a href='../homepage.php' class="sidebar-title">Witchcraft.code</a>
        </div>

        <div class="profile-section">
            <img src="../../image/witchghost.png" alt="Admin" class="profile-pic">
            <div class="profile-info">
                <h4><?php echo $row['USER_NAME'] ?></h4>
                <p>Administrator</p>
            </div>
        </div>
        <div class="sidebar-content">
            <a href="../profile/profile.php" class="sidebar-item">
            <i class="fa-solid fa-id-badge"></i>
                <span>Profile</span>
            </a>
            <a href="../playerList/playerList.php" class="sidebar-item">
            <i class="fa-solid fa-user-group"></i>
                <span>Player List</span>
            </a>
            <a href="../QA/QA.php" class="sidebar-item">
                <i class="fas fa-question"></i>
                <span>Q&A List</span>
            </a>
            <a href="../leaderboard/leaderboard.php" class="sidebar-item active">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
            </a>
            <a href="../certificate/certificate.php" class="sidebar-item">
                <i class="fas fa-certificate"></i>
                <span>Certificate</span>
            </a>
            <a href="../../login_register/logout.php" class="sidebar-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <section id="profile">
            <form class="edit-profile" action="../profile/update.php" method="post">
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
                        <label>Username:</label>
                        <input type="text" name="new_username" value="<?php echo $row['USER_USERNAME'] ?>" required="required">
                    </div>
                    <div class="edit-form">
                        <label>Password:</label>
                        <input type="password" name="new_password" value="<?php echo $row['USER_PASSWORD'] ?>" required="required">
                    </div>
                    <div class="edit-form">
                        <div class="button-container">
                            <button class="submit-btn" onclick="window.location.href='../../admin/profile/profile.php'">Back</button>
                            <button type="submit" name="submit" class="submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        </div>


    <script src="../../Javascript/sidebar.js"></script>
</body>
</html>