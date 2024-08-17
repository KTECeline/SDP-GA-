<?php
include '../../conn/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $certid = $_POST['certid'];
    $certname = $_POST['certname'];

    // Update the certificate name in the database
    $sql = "UPDATE certificate_information SET CERTIFICATE_NAME = ? WHERE CERTIFICATE_ID = ?";
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param('si', $certname, $certid);

    if ($stmt->execute()) {
        // Redirect back to the certificate page after successful update
        header('Location: certificate.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $dbConn->close();
}
?>
