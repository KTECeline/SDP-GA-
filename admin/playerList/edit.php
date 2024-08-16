<?php
// Connect to the database
include '../playerList/conn.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Retrieve the selected user's information
    $sql = "SELECT USER_NAME, USER_EMAIL, USER_PHONENUMBER, USER_USERNAME, USER_PASSWORD 
            FROM user_information 
            WHERE USER_ID = ?";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No user found.";
        exit;
    }
} else {
    echo "No user selected.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateUser'])) {
    // Process form submission to update user information
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update query
    $sql = "UPDATE user_information 
            SET USER_NAME = ?, USER_EMAIL = ?, USER_PHONENUMBER = ?, USER_USERNAME = ?, USER_PASSWORD = ? 
            WHERE USER_ID = ?";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $phone, $username, $password, $userId);
    
    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully.'); window.location.href = '../playerList/playerList.php';</script>";
    } else {
        echo "Error updating record: " . $dbConn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../css/admin/playerEdit.css">

</head>
<body>
<div class="wholeform">
    <center><h1>Edit User</h1></center>
    
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['USER_NAME']); ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['USER_EMAIL']); ?>" required><br>
        
        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($row['USER_PHONENUMBER']); ?>" required><br>
        
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($row['USER_USERNAME']); ?>" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($row['USER_PASSWORD']); ?>" required><br>

        <!-- Include the user ID in a hidden input field -->
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">

        <div class="editpage-btn">
        <button type="submit" name="updateUser" onclick="window.location.href='../playerList/playerList.php'">Update</button>
        <button type="button" name="cancelUser" onclick="window.location.href='../playerList/playerList.php'">Cancel</button>
        </div>
        </div>
    </form>
</body>
</html>

<?php
$stmt->close();
$dbConn->close();
?>
