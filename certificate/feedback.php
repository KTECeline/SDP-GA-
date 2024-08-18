<?php
session_start();
include '../conn/conn.php';

// Check if the user is logged in
if (isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID']; 

    // Get certificate ID from URL parameters
    if (isset($_GET['certificate_id'])) {
        $certificate_id = $_GET['certificate_id'];

        // Fetch certificate name or other details if needed
        $stmt = $dbConn->prepare("SELECT CERTIFICATE_NAME FROM certificate_information WHERE CERTIFICATE_ID = ? AND USER_ID = ?");
        $stmt->bind_param("ii", $certificate_id, $user_id);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();

        if (!$name) {
            echo "<script>alert('No certificate found for this ID.'); window.location.href = 'certificate_details.php';</script>";
            exit();
        }

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
                            <button id="feedback" class="submit-btn" type="submit" name="feedback">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <?php include "../header_footer/footer.php"; ?>
    </body>
</html><script>
document.getElementById('feedback').addEventListener('click', function(event) {
    // Prevent form submission to allow AJAX request
    event.preventDefault();

    // Get feedback value
    var feedback = document.querySelector('input[name="feedback"]').value;

    // Get certificate ID from the hidden input field
    var certificateId = document.querySelector('input[name="certificate_id"]').value;

    // Log the feedback and certificate ID to the console
    console.log('Feedback submitted:', feedback);
    console.log('Certificate ID submitted:', certificateId);

    // Create an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'certificate_save.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Server response:', xhr.responseText);  // Log the server response
            alert('Feedback updated successfully!');
        }
    };

    // Send the request with the feedback and certificate ID
    xhr.send('feedback=' + encodeURIComponent(feedback) + '&certificate_id=' + encodeURIComponent(certificateId));
});
</script>
