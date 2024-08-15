<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QA</title>
    <link rel="stylesheet" href="../../css/admin/sidebar.css">
    <link rel="stylesheet" href="../../admin/QA/QA.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.min.css">
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
                <h4>Admin Name</h4>
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
            <a href="#" class="sidebar-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>

    <!--MAIN CONTENT-->
    <div class="main-content">
    <center><h1>Q & A lists</h1></center>
    <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true }'>
    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/5.png" alt="EP1">
            <div class="slide-title">EP1</div>
            <p>Basic Syntax</p>
            <a href="../../admin/QA/EP1/ep1.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>

    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/6.png" alt="EP2">
            <div class="slide-title">EP2</div>
            <p>Control Flow</p>
            <a href="../../admin/QA/ep2/ep2.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>

    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/7.png" alt="EP3">
            <div class="slide-title">EP3</div>
            <p>Data Structure</p>
            <a href="../../admin/QA/EP3/ep3.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>

    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/8.png" alt="EP4">
            <div class="slide-title">EP4</div>
            <p>File Handling</p>
            <a href="../../admin/QA/EP4/ep4.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>
</div>

    </div>

    <script src="../../Javascript/sidebar.js"></script>
    <script src="../../admin/QA/QA.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
</body>
</html>