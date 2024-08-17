<?php
    session_start();
?>

<DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>

        <!-- Google link font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="../css/header.css">
    </head>

    <body>
        <header class="active">
            <div class="container">
                <a href="../user/homepage.php"><img src="../image/Witchcraft.Code Logo.png"/></a>
            
                <ul class="header-action">
                    <li><a href="../user/user_leaderboard.php">Leaderboard</a></li>
                    <?php 
                        if (isset($_SESSION['name'])) { 
                    ?>
                        <li class="dropdown">
                            <a href="../user/homepage.php" class="dropbtn"><?php echo $_SESSION['name']; ?></a>
                            <div class="dropdown-content">
                                <a href="../user/user_profile.php">Profile</a>
                                <a href="../login_register/logout.php">Logout</a>
                            </div>
                        </li>
                    <?php 
                        } else { 
                    ?>
                        <li><a href="../login_register/login.php"><i class="fa fa-sign-in"></i>Login</a></li>
                    <?php 
                        }
                    ?>   
                </ul>
            </div>
        </header>
    </body>
</html>