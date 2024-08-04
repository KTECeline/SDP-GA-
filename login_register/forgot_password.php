<?php
    session_start();
    include '../conn/conn.php';

    if(isset($_POST['submit'])){ 
        $username = $_POST['username']; 

        $user_query = "SELECT * FROM USER_INFORMATION WHERE USER_USERNAME = '$username' OR USER_EMAIL = '$username'";
        $user_result = mysqli_query($dbConn, $user_query);

        if($row = mysqli_fetch_array($user_result)) { 
            $_SESSION['username'] = $row['USER_USERNAME'];
            echo "<script>window.location.href = 'reset_password.php';</script>";
            exit(); 
        } else {
            echo "<script>alert('No user found with this username or email!');</script>";
        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" href="../css/login_register.css"/>
        <title>Forgot Password</title>
        <style>
            body {
                background-image: url('../image/Forgot password background.png');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>

    <body>
        <div class="logo-header">
            <a href="login_register.php" class="logo">
                <img src="../image/Witchcraft.Code Logo (White).png" alt="logo" width="150px">
            </a>   
        </div>

        <form class="reset-form" action="" method="post">
            <h2 class="form-title">Reset Your Password</h2>
            <div class="form-group">
                <label>Username or email address:</label>
                <input type="text" name="username" placeholder="Enter your username or email address" required="required">
            </div>
            
            <div class="form-group">
                <div class="button-container">
                    <button class="submit-btn" onclick="window.location.href='login_register.php'">Back</button>
                    <button type="submit" name="submit" class="submit-btn">Next</button> 
                </div>
            </div>
        </form>
    </body>
</html>