<?php
    session_start();
    if (isset($_SESSION['name'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <link rel="stylesheet" href="../../css/admin/sidebar.css">
    <link rel="stylesheet" href="../../css/admin/playerList.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../admin/sidebar.php'; ?>

     
    <div class="main-content">
    <div class="top-part">
        <div class="view-toggle">
            <button id="toggleViewBtn">Switch to Card View</button>
        </div>
        <div class="title">
            <h1>Player List</h1>
        </div>
        <div class="playerlist-btn">
            <button id="editBtn">Edit</button>
            <button id="deleteBtn">Delete</button>
        </div>
    </div>
        <!-- Search Bar -->
        <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search for usernames or user IDs..">
    <button id="searchBtn"><i class="fa fa-search"></i></button>
    <button id="resetBtn">Reset</button>
</div>

    <!-- Table View -->
    <div id="tableView" class="user-table active-view">
   <div class="table-container">
        <table id="userTable">
            <thead>
            <tr bgcolor="purple">
                <th>User ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Ranking</th>
                <th>Score</th>
                
            </tr>
            </thead>
            <?php 
            include '../../admin/playerList/conn.php';

            $sql = "SELECT 
                        u.USER_ID, 
                        u.USER_USERNAME, 
                        u.USER_PASSWORD, 
                        COALESCE(s.EPISODE_TOTAL_SCORE, 0) AS EPISODE_TOTAL_SCORE,
                        COALESCE(RANK() OVER (ORDER BY s.EPISODE_TOTAL_SCORE DESC), 0) AS RANKING
                    FROM 
                        user_information u
                    LEFT JOIN (
                        SELECT 
                            USER_ID, 
                            MAX(EPISODE_TOTAL_SCORE) AS EPISODE_TOTAL_SCORE
                        FROM 
                            score_information
                        GROUP BY 
                            USER_ID
                    ) s ON u.USER_ID = s.USER_ID
                    WHERE
                        u.ROLES = 'user'
                    ORDER BY 
                        u.USER_ID ASC";

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
           
    </div></div>
  

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
  

    <script src="../../Javascript/player.js"></script>
    <script src="../../Javascript/sidebar.js"></script>
    
    <?php $dbConn->close(); ?>
    </div>
    <?php 
                        } else { }
                    ?>
</body>
</html>

<script>
    // JavaScript for filtering both table and card views
    document.getElementById("searchBtn").addEventListener("click", function() {
        // Get the search input value
        let searchValue = document.getElementById("searchInput").value.toLowerCase();

        // Filter Table Rows
        let table = document.getElementById("userTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let userId = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase();
            let username = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();

            if (userId.includes(searchValue) || username.includes(searchValue)) {
                rows[i].style.display = ""; // Show the row
            } else {
                rows[i].style.display = "none"; // Hide the row
            }
        }

        // Filter Card View
        let cards = document.getElementsByClassName("user-card");

        for (let i = 0; i < cards.length; i++) {
            let userId = cards[i].getElementsByTagName("h3")[0].textContent.toLowerCase();
            let username = cards[i].getElementsByTagName("p")[0].textContent.toLowerCase();

            if (userId.includes(searchValue) || username.includes(searchValue)) {
                cards[i].style.display = ""; // Show the card
            } else {
                cards[i].style.display = "none"; // Hide the card
            }
        }
    });

    // JavaScript for Reset Button
    document.getElementById("resetBtn").addEventListener("click", function() {
        // Clear the search input
        document.getElementById("searchInput").value = "";

        // Reset Table Rows to show all rows
        let table = document.getElementById("userTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            rows[i].style.display = ""; // Show all rows
        }

        // Reset Card View to show all cards
        let cards = document.getElementsByClassName("user-card");

        for (let i = 0; i < cards.length; i++) {
            cards[i].style.display = ""; // Show all cards
        }
    });

    </script>