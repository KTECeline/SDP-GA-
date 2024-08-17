<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../conn/conn.php';

header('Content-Type: application/json');

function getEpisodeProgress() {
    global $dbConn;
    $sql = "SELECT EPISODE_ID, COUNT(DISTINCT USER_ID) as user_count 
            FROM episode_result 
            GROUP BY EPISODE_ID";
    $result = $dbConn->query($sql);
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            "episodeId" => $row["EPISODE_ID"],
            "userCount" => $row["user_count"]
        );
    }
    return $data;
}

function getAverageScores() {
    global $dbConn;
    $sql = "SELECT EPISODE_ID, AVG(SCORE) as average_score 
            FROM episode_result 
            GROUP BY EPISODE_ID";
    $result = $dbConn->query($sql);
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            "episodeId" => $row["EPISODE_ID"],
            "averageScore" => $row["average_score"]
        );
    }
    return $data;
}

function getTopPerformers() {
    global $dbConn;
    $sql = "SELECT USER_ID, EPISODE_TOTAL_SCORE as total_score 
            FROM score_information 
            ORDER BY EPISODE_TOTAL_SCORE DESC 
            LIMIT 5";
    $result = $dbConn->query($sql);
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            "userId" => $row["USER_ID"],
            "totalScore" => $row["total_score"]
        );
    }
    return $data;
}


function getEpisodeMetrics() {
    global $dbConn;
    $sql = "SELECT 
                e.EPISODE_ID,
                AVG(s.EPISODE_TOTAL_SCORE) as avg_total_score_per_episode,
                AVG(TIME_TO_SEC(e.TIME_TAKEN)) as avg_time_spent_seconds,
                AVG(e.SCORE) as avg_score
            FROM episode_result e
            JOIN score_information s ON e.USER_ID = s.USER_ID
            GROUP BY e.EPISODE_ID";
    
    $result = $dbConn->query($sql);
    $data = array();
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'EPISODE_ID' => $row['EPISODE_ID'],
                'avg_total_score_per_episode' => floatval($row['avg_total_score_per_episode']),
                'avg_time_spent' => round(floatval($row['avg_time_spent_seconds'])), // Round to nearest second
                'avg_score' => floatval($row['avg_score'])
            );
        }
    }
    
    return $data;
}

$data = array(
    'averageScores' => getAverageScores(),
    'topPerformers' => getTopPerformers(),
    'episodeProgress' => getEpisodeProgress(),
    'episodeMetrics' => getEpisodeMetrics()
);

echo json_encode($data);

$dbConn->close();
?>
