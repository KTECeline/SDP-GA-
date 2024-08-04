<?php
    session_start(); 
    echo "<script>alert('You already logged out! Thank you.');</script>";
    
    session_destroy(); 
    echo "<script>window.location.href = 'login_register.php';</script>";
?>