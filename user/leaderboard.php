<?php
    session_start();
    include '../conn/conn.php';
    if (isset($_SESSION['name']) && isset($_SESSION['USER_ID'])) {
        $current_user_id = $_SESSION['USER_ID'];
        

        // SQL query
        $sql_top10 = "SELECT e.USER_ID, u.USER_USERNAME, MAX(e.EPISODE_TOTAL_SCORE) AS MAX_SCORE,
                RANK() OVER (ORDER BY MAX(e.EPISODE_TOTAL_SCORE) DESC) AS RANK
                FROM user_information u
                JOIN score_information e ON u.USER_ID = e.USER_ID
                WHERE u.ROLES = 'user'
                GROUP BY u.USER_ID
                ORDER BY MAX_SCORE DESC
                LIMIT 10"; 
        $result_top10 = $dbConn->query($sql_top10);

        $sql_user_rank = "SELECT USER_ID, USER_USERNAME, MAX_SCORE, RANK FROM (
            SELECT e.USER_ID, u.USER_USERNAME, MAX(e.EPISODE_TOTAL_SCORE) AS MAX_SCORE,
            RANK() OVER (ORDER BY MAX(e.EPISODE_TOTAL_SCORE) DESC) AS RANK
            FROM user_information u
            JOIN score_information e ON u.USER_ID = e.USER_ID
            WHERE u.ROLES = 'user'
            GROUP BY u.USER_ID
          ) ranked_users
          WHERE USER_ID = ?";

$stmt = $dbConn->prepare($sql_user_rank);
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result_user_rank = $stmt->get_result();

$leaderboardData = array();
$userRankData = null;

if ($result_top10->num_rows > 0) {
    while($row = $result_top10->fetch_assoc()) {
        $leaderboardData[] = array(
            "USER_ID" => $row["USER_ID"],
            "username" => $row["USER_USERNAME"],
            "score" => $row["MAX_SCORE"],
            "rank" => $row["RANK"]
        );
    }
}

if ($result_user_rank->num_rows > 0) {
    $userRankData = $result_user_rank->fetch_assoc();
}

$dbConn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../css/leaderboard.css">
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.min.css">
</head>
<body>
<header class="active">
            <div class="container">
                <a href="../user/homepage.php"><img src="../image/Witchcraft.Code Logo.png"/></a>
            
                <ul class="header-action">
                    <li><a href="user_leaderboard.php">Leaderboard</a></li>
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
    <!--MAIN CONTENT-->
    <div class="main-content">
    <center><h1>TOP 10 Leaderboard</h1></center>
    <div class="podium">
            <div class="podium-item podium-2">
                <div class="podium-rank">2</div>
                <div class="podium-username"></div>
                <div class="podium-bar">
                    <div class="podium-score"></div>
                </div>
            </div>
            <div class="podium-item podium-1">
                <div class="podium-rank">1</div>
                <div class="podium-username"></div>
                <div class="podium-bar">
                    <div class="podium-score"></div>
                </div>
            </div>
            <div class="podium-item podium-3">
                <div class="podium-rank">3</div>
                <div class="podium-username"></div>
                
                <div class="podium-bar">
                    <div class="podium-score"></div>
                </div>
            </div>
        </div>
    <div class="table-container">
    
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                </tr>
                <?php
                foreach ($leaderboardData as $player) {
                    $highlightClass = ($player['USER_ID'] == $current_user_id) ? 'highlighted-row' : '';
                    echo "<tr class='{$highlightClass}'>
                            <td>" . htmlspecialchars($player['rank']) . "</td>
                            <td>" . htmlspecialchars($player['username']) . "</td>
                            <td>" . htmlspecialchars($player['score']) . "</td>
                          </tr>";
                }
                ?>
            </table>
            <?php if ($userRankData && $userRankData['RANK'] > 10): ?>
        <div class="user-rank">
            Your Rank: <?php echo htmlspecialchars($userRankData['RANK']); ?> | 
            Score: <?php echo htmlspecialchars($userRankData['MAX_SCORE']); ?>
        </div>
        <?php endif; ?>
        </div>
       
    </div>
    
     <script>
        const leaderboardData = <?php echo json_encode($leaderboardData); ?>;
        
        function populatePodium(data) {
            const podiumItems = document.querySelectorAll('.podium-item');
            const podiumOrder = [1, 0, 2]; // Reorder for 2nd, 1st, 3rd place
            podiumItems.forEach((item, index) => {
                const playerIndex = podiumOrder[index];
                if (data[playerIndex]) {
                    item.querySelector('.podium-username').textContent = data[playerIndex].username;
                    item.querySelector('.podium-score').textContent = `${data[playerIndex].score} pts`;
                }
            });
        }

        populatePodium(leaderboardData);
    </script>
    
</body>
</html>
<?php
    } else {
        // Redirect or show an error if the user is not logged in
        header("Location: ../../login_register/login_register.php");
        exit();
    }
?>