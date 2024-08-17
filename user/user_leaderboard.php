<?php
    session_start();
    include '../conn/conn.php';
    if (isset($_SESSION['name'])) {
        

        // SQL query
        $sql = "SELECT u.USER_ID, u.USER_USERNAME, e.EPISODE_TOTAL_SCORE
                FROM user_information u
                JOIN score_information e ON u.USER_ID = e.USER_ID
                WHERE u.ROLES = 'user'
                ORDER BY e.EPISODE_TOTAL_SCORE DESC
                LIMIT 10"; 
        $result = $dbConn->query($sql);

        $leaderboardData = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $leaderboardData[] = array(
                    "USER_ID" => $row["USER_ID"],
                    "username" => $row["USER_USERNAME"],
                    "score" => $row["EPISODE_TOTAL_SCORE"]
                );
            }
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
    <form id="resetForm" method="post" action="../../admin/leaderboard/reset.php">
            <table>
                <tr>
                <th class="select-column" style="display: none;">Select</th>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                </tr>
                <?php
                foreach ($leaderboardData as $index => $player) {
                    echo "<tr>
                    <td class='select-column' style='display: none;'><input type='checkbox' name='reset_users[]' value='" . htmlspecialchars($player['USER_ID']) . "'></td>

                            <td>" . ($index + 1) . "</td>
                            <td>" . htmlspecialchars($player['username']) . "</td>
                            <td>" . htmlspecialchars($player['score']) . "</td>
                          </tr>";
                }
                ?>
            </table>
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
        
        // Toggle the visibility of checkboxes and buttons
        const resetToggleButton = document.getElementById('resetToggleButton');
const confirmResetButton = document.getElementById('confirmResetButton');
const confirmCancelButton = document.getElementById('cancelButton');
const selectColumns = document.querySelectorAll('.select-column'); // Select the column

resetToggleButton.addEventListener('click', () => {
    selectColumns.forEach(column => {
        column.style.display = 'table-cell'; // Show the select column (header and checkboxes)
    });
    confirmResetButton.style.display = 'inline-block';
    confirmCancelButton.style.display = 'inline-block'; // Show the confirm button
    resetToggleButton.style.display = 'none'; // Hide the reset button
});

cancelButton.addEventListener('click', () => {
    confirmResetButton.style.display = 'none'; // Hide the confirm button
    cancelButton.style.display = 'none'; // Hide the cancel button
    resetToggleButton.style.display = 'inline-block'; // Show the reset button
});

    </script>

    <script src="../../../Javascript/sidebar.js"></script>
    
</body>
</html>
<?php
    } else {
        // Redirect or show an error if the user is not logged in
        header("Location: ../../login_register/login_register.php");
        exit();
    }
?>