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
                'avg_score' => floatval($row['avg_score'])
            );
        }
    }
    
    return $data;
}

function getPercentileDistribution() {
    global $dbConn;
    
    // Calculate total number of users
    $sql = "SELECT COUNT(DISTINCT USER_ID) as total_users FROM episode_result";
    $result = $dbConn->query($sql);
    $total_users = $result->fetch_assoc()['total_users'];
    
    // Get the score distribution
    $sql = "SELECT SCORE FROM episode_result";
    $result = $dbConn->query($sql);
    
    $scores = array();
    while ($row = $result->fetch_assoc()) {
        $scores[] = $row['SCORE'];
    }
    
    sort($scores); // Sort scores in ascending order
    
    // Calculate percentiles
    $percentiles = array(
        '0-10%' => 0,
        '11-20%' => 0,
        '21-30%' => 0,
        '31-40%' => 0,
        '41-50%' => 0,
        '51-60%' => 0,
        '61-70%' => 0,
        '71-80%' => 0,
        '81-90%' => 0,
        '91-100%' => 0
    );
    
    $total_scores = count($scores);
    
    foreach ($scores as $score) {
        $percentile_index = intval((array_search($score, $scores) / $total_scores) * 100);
        if ($percentile_index <= 10) $percentiles['0-10%']++;
        else if ($percentile_index <= 20) $percentiles['11-20%']++;
        else if ($percentile_index <= 30) $percentiles['21-30%']++;
        else if ($percentile_index <= 40) $percentiles['31-40%']++;
        else if ($percentile_index <= 50) $percentiles['41-50%']++;
        else if ($percentile_index <= 60) $percentiles['51-60%']++;
        else if ($percentile_index <= 70) $percentiles['61-70%']++;
        else if ($percentile_index <= 80) $percentiles['71-80%']++;
        else if ($percentile_index <= 90) $percentiles['81-90%']++;
        else $percentiles['91-100%']++;
    }
    
    $data = array();
    foreach ($percentiles as $range => $count) {
        $data[] = array(
            'percentile' => $range,
            'count' => $count
        );
    }
    
    return $data;
}


$data = array(
    
    'topPerformers' => getTopPerformers(),
    'episodeProgress' => getEpisodeProgress(),
    'episodeMetrics' => getEpisodeMetrics(),
    'percentileDistribution' => getPercentileDistribution()
);

echo json_encode($data);

$dbConn->close();
?>
