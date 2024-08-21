<?php
    include '../../conn/conn.php';

    if (isset($_POST['submit'])) { 
        $id = mysqli_real_escape_string($dbConn, $_POST['id']);
        $name = mysqli_real_escape_string($dbConn, $_POST['new_name']);
        $email = mysqli_real_escape_string($dbConn, $_POST['new_email']);
        $phone = mysqli_real_escape_string($dbConn, $_POST['new_phonenum']);
        $username = mysqli_real_escape_string($dbConn, $_POST['new_username']);
        $password =  mysqli_real_escape_string($dbConn, $_POST['new_password']);

        $emailCheck = mysqli_query($dbConn, "SELECT * FROM user_information WHERE USER_EMAIL = '$email' AND USER_ID != $id");

        $usernameCheck = mysqli_query($dbConn, "SELECT * FROM user_information WHERE USER_USERNAME = '$username' AND USER_ID != $id");

        if (mysqli_num_rows($emailCheck) > 0) { 
            echo "<script>alert('Email already exists. Please use another email.');</script>";
            echo "<script>window.location.href='../../admin/profile/profile.php';</script>";
            exit();
        } elseif (mysqli_num_rows($usernameCheck) > 0) { 
            echo "<script>alert('Username already exists. Please use another username.');</script>";
            echo "<script>window.location.href='../../admin/profile/profile.php';</script>";
            exit();
        } else {
            $sql = "UPDATE user_information SET " .
                    "USER_NAME = '$name', " .  
                    "USER_EMAIL = '$email', " .
                    "USER_PHONENUMBER= '$phone'," .
                    "USER_USERNAME = '$username', " .
                    "USER_PASSWORD = '$password' " .
                    "WHERE USER_ID = $id";

            mysqli_query($dbConn, $sql);

            if (mysqli_affected_rows($dbConn) > 0) { 
                echo "<script>alert('Successfully updated data!');</script>";
                echo "<script>window.location.href='../../admin/profile/profile.php';</script>";
                exit(); 
            } else {
                echo "<script>alert('Cannot update data!');</script>";
                echo "<script>window.location.href='../../admin/profile/profile.php';</script>";
                exit();
            }
        }
    } else {
        echo "<script>window.location.href='../../admin/profile/profile.php';</script>";
        exit();
    }
?>