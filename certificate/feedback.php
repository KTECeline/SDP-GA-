<?php
session_start();
include '../conn/conn.php';

if (isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID'];

    if (isset($_GET['certificate_id'])) {
        $certificate_id = $_GET['certificate_id'];

        $stmt = $dbConn->prepare("SELECT CERTIFICATE_NAME FROM certificate_information WHERE CERTIFICATE_ID = ? AND USER_ID = ?");
        $stmt->bind_param("ii", $certificate_id, $user_id);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();

        $stmt->close();
    } else {
        echo "<script>alert('Certificate ID not found.'); window.location.href = 'certificate_details.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('User not logged in.'); window.location.href = '../login_register/login_register.php';</script>";
    exit();
}
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Feedback Form</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/certificate.css">
        <script src="../Javascript/certificate.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    </head>
    
    <body>
        <?php include "../header_footer/header.php"; ?>

        <section id="certificate">
            <form class="cer" action="certificate_save.php" method="post">
                <div class="details">
                    <span class="close-button" onclick="closeLogin()">🗙</span>
                    <h1>Feedback Form</h1>
                    <h4>Thanks for playing Witchcraft.code! <br>
                        Please share your feedback about our e-learning game.</h4>
                    <div class="form">
                        <label>Your feedback:</label>
                        <input type="text" name="feedback" required placeholder="Enter your feedback">
                    </div>
                    <input type="hidden" name="certificate_id" value="<?php echo htmlspecialchars($certificate_id); ?>">
                    <div class="form">
                        <div class="button-container">
                            <button id="submitfeedback" class="submit-btn" type="submit" name="feedback">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <?php include "../header_footer/footer.php"; ?>
    </body>
</html><script>
document.getElementById('submitfeedback').addEventListener('click', function(event) {
    event.preventDefault();
    var feedback = document.querySelector('input[name="feedback"]').value;
    var certificateId = document.querySelector('input[name="certificate_id"]').value;


    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'certificate_save.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            
            var xhrScore = new XMLHttpRequest();
            xhrScore.open('POST', 'score.php', true);
            xhrScore.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhrScore.onreadystatechange = function() {
                if (xhrScore.readyState === 4 && xhrScore.status === 200) {
                    var userId = <?php echo json_encode($user_id); ?>;
                    window.location.href = 'thankyou.php?user_id=' + encodeURIComponent(userId);
                }
            };

            xhrScore.send();
        }
    };

    // Send the request with the feedback and certificate ID
    xhr.send('feedback=' + encodeURIComponent(feedback) + '&certificate_id=' + encodeURIComponent(certificateId));
});
</script>