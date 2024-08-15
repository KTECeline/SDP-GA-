<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/admin-main.css">
    <link rel="stylesheet" href="../css/admin/playerList.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
        <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <h3 class="sidebar-title">Witchcraft.code</h3>
        </div>

        <div class="profile-section">
            <img src="../image/witchghost.png" alt="Admin" class="profile-pic">
            <div class="profile-info">
                <h4>Admin Name</h4>
                <p>Administrator</p>
            </div>
        </div>
        <div class="sidebar-content">
            <a href="#" class="sidebar-item">
            <i class="fa-solid fa-id-badge"></i>
                <span>Profile</span>
            </a>
            <a href="#" class="sidebar-item">
            <i class="fa-solid fa-user-group"></i>
                <span>Player List</span>
            </a>
            <a href="#" class="sidebar-item">
                <i class="fas fa-question"></i>
                <span>Q&A List</span>
            </a>
            <a href="#" class="sidebar-item active">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
            </a>
            <a href="#" class="sidebar-item">
                <i class="fas fa-certificate"></i>
                <span>Certificate</span>
            </a>
            <a href="#" class="sidebar-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>

     
    <div class="main-content">
    <div class="top-part">
        <div class="view-toggle">
            <button id="toggleViewBtn">Switch to Card View</button>
        </div>
        <div class="title">
            <h1>Player List</h1>
        </div>
        <div class="btn">
            <button id="editBtn">Edit</button>
            <button id="deleteBtn">Delete</button>
        </div>
    </div>

    <!-- Table View -->
    <div id="tableView" class="user-table active-view">
   
        <table id="userTable">
            <tr bgcolor="purple">
                <th>User ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Ranking</th>
                <th>Score</th>
                
            </tr>
            <?php 
            include '../admin/playerList/conn.php';

            $sql = "SELECT 
                        u.USER_ID, 
                        u.USER_USERNAME, 
                        u.USER_PASSWORD,
                        RANK() OVER (ORDER BY s.EPISODE_TOTAL_SCORE DESC) AS RANKING,
                        s.EPISODE_TOTAL_SCORE
                    FROM 
                        user_information u
                    LEFT JOIN 
                        score_information s ON u.USER_ID = s.USER_ID";

            $result = mysqli_query($dbConn, $sql);

            if (!$result) {
                die("Query Error: " . mysqli_error($dbConn));
            }

            if (mysqli_num_rows($result) > 0) {
                while($rows = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$rows['USER_ID']."</td>";
                    echo "<td>".$rows['USER_USERNAME']."</td>";
                    echo "<td>".$rows['USER_PASSWORD']."</td>";
                    echo "<td>".($rows['RANKING'] !== null ? $rows['RANKING'] : 'N/A')."</td>";
                    echo "<td>".($rows['EPISODE_TOTAL_SCORE'] !== null ? $rows['EPISODE_TOTAL_SCORE'] : 'N/A')."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<script>alert('No data found!');</script>";
            }
            ?>
        </table>
           
    </div>
  

    <!-- Card View -->
    <div id="cardView" class="user-cards">
        <?php
        if ($result->num_rows > 0) {
            $result->data_seek(0); // Reset pointer for re-use in card view
            while($row = $result->fetch_assoc()) {
                echo "<div class='user-card'>";
                echo "<h3>User ID: " . $row["USER_ID"] . "</h3>";
                echo "<p>Username: " . $row["USER_USERNAME"] . "</p>";
                echo "<p>Password: " . $row["USER_PASSWORD"] . "</p>";
                echo "<p>Ranking: " . ($row["RANKING"] !== null ? $row["RANKING"] : 'N/A') . "</p>";
                echo "<p>Score: " . ($row["EPISODE_TOTAL_SCORE"] !== null ? $row["EPISODE_TOTAL_SCORE"] : 'N/A') . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No users found.</p>";
        }
        ?>
    </div>
    
    <script src="../../js/player.js"></script>
    <script src="../js/sidebar.js"></script>
    
    <?php $dbConn->close(); ?>
    </div>
</body>
</html>