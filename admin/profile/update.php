<?php
    include '../../conn/conn.php';

    if (isset($_POST['submit'])) { 
        $id = $_POST['id'];
        $name = $_POST['new_name'];
        $email = $_POST['new_email'];
        $phone = $_POST['new_phonenum'];
        $username = $_POST['new_username'];
        $password = $_POST['new_password'];

        $sql = "UPDATE user_information SET " .
                "USER_NAME = '$name', " .  
                "USER_EMAIL = '$email', " .
                "USER_PHONENUMBER= '$phone', " .
                "USER_USERNAME = '$username', " .
                "USER_PASSWORD = '$password' " .
                "WHERE USER_ID = $id";

        mysqli_query($dbConn, $sql);

        if (mysqli_affected_rows($dbConn) > 0) { 
            echo "<script>alert('Successfully update data!');</script>";
            echo "<script>window.location.href='../../admin/profile/profile.php';</script>";
            exit(); 
        } else {
            echo "<script>alert('Cannot update data!');</script>";
            echo "<script>window.location.href='../../admin/profile/editprofile.php';</script>";
            exit();
        }
    } else {
        echo "<script>window.location.href='../../admin/profile/profile.php';</script>";
        exit();
    }
?>