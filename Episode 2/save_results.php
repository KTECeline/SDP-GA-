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

session_start();

if (isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID'];
} else {
    // Redirect to login if USER_ID is not set in session
    header("Location: ../login_register/login_register.php");
    exit;
}

// Get POST data
$time_taken = $_POST['time_taken'];
$score = $_POST['score'];

// Hard-code EPISODE_ID as 2
$episode_id = 2;

// Prepare and bind
<<<<<<< Updated upstream
$stmt = $conn->prepare("INSERT INTO episode_result ( SCORE, EPISODE_ID, USER_ID) VALUES ( ?, ?,?)");
$stmt->bind_param("iii", $score, $episode_id, $user_id);
=======
$stmt = $conn->prepare("INSERT INTO episode_result (SCORE, EPISODE_ID, USER_ID) VALUES (?, ?,?)");
$stmt->bind_param("siii", $score, $episode_id, $user_id);
>>>>>>> Stashed changes

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
