<?php 
include '../playerList/conn.php';

if (!$dbConn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT 
    u.USER_ID, 
    u.USER_USERNAME, 
    u.USER_PASSWORD,
    RANK() OVER (ORDER BY s.EPISODE_TOTAL_SCORE DESC) AS RANKING,
    s.EPISODE_TOTAL_SCORE
FROM 
    user_information u
JOIN 
    score_information s ON u.USER_ID = s.USER_ID";

$result = mysqli_query($dbConn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($dbConn));
}

if (mysqli_num_rows($result) > 0) {
    while($rows = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$rows['USER_ID']."</td>";
        echo "<td>".$rows['USER_USERNAME']."</td>";
        echo "<td>".$rows['USER_PASSWORD']."</td>";
        echo "<td>".$rows['RANKING']."</td>";
        echo "<td>".$rows['EPISODE_TOTAL_SCORE']."</td>";
        echo "</tr>";
    }
} else {
    echo "<script>alert('No data found!');</script>";
}
?>

