<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdp_ga";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$time_taken = $_POST['time_taken'];
$score = $_POST['score'];

// Hard-code EPISODE_ID as 2
$episode_id = 2;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO episode_result (time_taken, SCORE, EPISODE_ID) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $time_taken, $score, $episode_id);

// Execute
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
