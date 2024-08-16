<?php
    session_start();
    if (isset($_SESSION['name'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="../css/admin/sidebar.css">
    <link rel="stylesheet" href="../css/admin/admin-main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
        <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <a href='../admin/homepage.php' class="sidebar-title">Witchcraft.code</a>
        </div>

        <div class="profile-section">
            <img src="../image/witchghost.png" alt="Admin" class="profile-pic">
            <div class="profile-info">
                <h4><?php echo $_SESSION['name']; ?></h4>
                <p>Administrator</p>
            </div>
        </div>
        <div class="sidebar-content">
            <a href="../admin/profile/profile.php" class="sidebar-item">
            <i class="fa-solid fa-id-badge"></i>
                <span>Profile</span>
            </a>
            <a href="../admin/playerList/playerList.php" class="sidebar-item">
            <i class="fa-solid fa-user-group"></i>
                <span>Player List</span>
            </a>
            <a href="../admin/QA/QA.php" class="sidebar-item">
                <i class="fas fa-question"></i>
                <span>Q&A List</span>
            </a>
            <a href="../admin/leaderboard/leaderboard.php" class="sidebar-item active">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
            </a>
            <a href="../admin/certificate/certificate.php" class="sidebar-item">
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
        <div class="main-content-items">
            <div class="main-title">
                <h2>Player list</h2>
            </div>
            <div class="alteration">
                <ul>
                    <li><a href="../admin/playerList/playerList.php">Check player list</li>
                    <li><a href="#">Edit player</li>
                    <li><a href="#">Delete player</li>
                </ul>
            </div>
            <div class="main-title">
                <h2>Question and Answer alteration</h2>
            </div>
            <div class="alteration">
                <ul>
                    <li><a href="../admin/QA/EP1/ep1.php">EP1</li>
                    <li><a href="../admin/QA/ep2/ep2.php">EP2</li>
                    <li><a href="../admin/QA/EP3/ep3.php">EP3</li>
                    <li><a href="../admin/QA/EP4/ep4.php">EP4</li>
                </ul>
            </div>
            <div class="main-title">
                <h2>Leaderboard</h2>
            </div>
            <div class="alteration">
                <ul>
                    <li><a href="../admin/leaderboard/leaderboard.php">View leaderboard</li>
                    <li><a href="#">Edit leaderboard</li>
                </ul>
            </div>
            <div class="main-title">
                <h2>Certificate</h2>
            </div>
            <div class="alteration">
                <ul>
                    <li><a href="#">Edit certificate</li>
                    <li><a href="../admin/certificate/certificate.php">Certificate list</li>    
                </ul>
            </div>
        </div>
    </div>
    <?php 
                        } else { }
                    ?>
                        
                    
    <script src="../Javascript/sidebar.js"></script>
</body>
</html>