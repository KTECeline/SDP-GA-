<?php
    session_start();
    include '../../conn/conn.php';
    if (isset($_SESSION['name'])) { 

        $sql = "SELECT u.USER_ID, u.USER_USERNAME, c.CERTIFICATE_ID, c.CERTIFICATE_FEEDBACK,u.USER_EMAIL
                FROM user_information u
                JOIN certificate_information c ON u.USER_ID = c.USER_ID
                ORDER BY c.CERTIFICATE_ID ASC"; 

        $result = $dbConn->query($sql);

        $feedbackData = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $feedbackData[] = array(
                    "certificate_id" => $row["CERTIFICATE_ID"],
                    "email" => $row["USER_EMAIL"],
                    "username" => $row["USER_USERNAME"],
                    "feedback" => $row["CERTIFICATE_FEEDBACK"]
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
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="../../css/admin/sidebar.css">
    <link rel="stylesheet" href="../../admin/feedback/feedback.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../admin/sidebar.php'; ?>
<div class="main-content">
    <div class="container">
    <center><h1>Feedback</h1></center>
    <div class="table"><table>
                <tr>
                <th class="select-column">Done</th>
                    <th>No</th>
                    <th>Username</th>
                    <th>UserEmail</th>
                    <th>Cert ID</th>
                    <th>Feedback</th>
                </tr>
                <?php
                foreach ($feedbackData as $index => $player) {
                    echo "<tr>
                    <td class='select-column'><input type='checkbox''></td>

                            <td>" . ($index + 1) .   "</td>
                            <td>" . htmlspecialchars($player['username']) . "</td>
                            <td>" . htmlspecialchars($player['email']) . "</td>
                            <td>" . htmlspecialchars($player['certificate_id']) . "</td>
                            <td>" . htmlspecialchars($player['feedback']) . "</td>
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>
    </div>        
    <script src="../../Javascript/sidebar.js"></script>
    <script>
          const feedbackData = <?php echo json_encode($feedbackData); ?>;
        
        
    </script>

    <script src="../../../Javascript/sidebar.js"></script>
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