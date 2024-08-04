<?php
    session_start();
    include '../conn/conn.php';

    if(isset($_POST['submit'])){
        $username = $_SESSION['username'];
        $new_password = $_POST['new_pass'];
        $confirm_password = $_POST['new_pass_c'];

        $update_result_user = false;
        $user_query = "SELECT USER_PASSWORD FROM USER_INFORMATION WHERE USER_USERNAME = '$username'";
        $user_result = mysqli_query($dbConn, $user_query);
        $user_row = mysqli_fetch_assoc($user_result);
       
        if($user_row) { 
            $original_password = $user_row['USER_PASSWORD'];
        } else {
            echo "<script>alert('User not found!');</script>";
            exit();
        }

        if ($new_password === $original_password) { 
            echo "<script>alert('New password cannot be the same as the original password!');</script>";
        } elseif ($new_password !== $confirm_password) {
            echo "<script>alert('Password and confirm password do not match!');</script>";
        } else {

            if($user_row) {
                $update_query_user = "UPDATE USER_INFORMATION SET USER_PASSWORD = '$new_password' WHERE USER_USERNAME = '$username'";
                $update_result_user = mysqli_query($dbConn, $update_query_user);
                if (!$update_result_user) {
                    echo "<script>alert('Failed to update user password.');</script>";
                }
            }

            if ($update_result_user) {
                echo "<script>alert('Password updated successfully!');</script>";
                unset($_SESSION['username']);
                echo "<script>window.location.href = 'login_register.php';</script>";
                exit();
            }            
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
        <script src="../Javascript/login_register.js"></script>
        <title>Reset Password</title>
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
                <label>New password:</label>
                <input type="password" name="new_pass" placeholder="Enter your new password" required>
                <span class="password-icon" onclick="PasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <div class="form-group">
                <label>Confirm new password:</label>
                <input type="password" name="new_pass_c" placeholder="Enter again the new password" required>
                <span class="password-icon" onclick="PasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            
            <div class="form-group">
                <div class="button-container">
                    <button class="submit-btn" onclick="window.location.href='forgot_password.php'">Back</button>
                    <button type="submit" name="submit" class="submit-btn">Submit</button>
                </div>
            </div>
        </form>
    </body>
</html>