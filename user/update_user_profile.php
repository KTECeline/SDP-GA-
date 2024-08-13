<?php
    include '../conn/conn.php';

    if (isset($_POST['submit'])) { 
        $id = $_POST['id'];
        $name = $_POST['new_name'];
        $email = $_POST['new_email'];
        $phone = $_POST['new_phonenum'];

        $sql = "UPDATE user_information SET " .
                "USER_NAME = '$name', " .  
                "USER_EMAIL = '$email', " .
                "USER_PHONENUMBER= '$phone' " .
                "WHERE USER_ID = $id";

        mysqli_query($dbConn, $sql);

        if (mysqli_affected_rows($dbConn) > 0) { 
            echo "<script>alert('Successfully update data!');</script>";
            echo "<script>window.location.href='user_profile.php';</script>";
            exit(); 
        } else {
            echo "<script>alert('Cannot update data!');</script>";
            echo "<script>window.location.href='edit_user_profile.php';</script>";
            exit();
        }
    } else {
        echo "<script>window.location.href='user_profile.php';</script>";
        exit();
    }
?>