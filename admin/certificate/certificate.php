<?php
    session_start();
    include '../../conn/conn.php';
    if (isset($_SESSION['name'])) {
        

        // SQL query
        $sql = "SELECT u.USER_ID, u.USER_USERNAME, c.CERTIFICATE_ID, c.CERTIFICATE_NAME
                FROM user_information u
                JOIN certificate_information c ON u.USER_ID = c.USER_ID";  
        $result = $dbConn->query($sql);

        $certData = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $certData[] = array(
                    "userid" => $row["USER_ID"],
                    "username" => $row["USER_USERNAME"],
                    "certname" => $row["CERTIFICATE_NAME"],
                    "certid" => $row["CERTIFICATE_ID"]
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
    <title>Certificate</title>
    <link rel="stylesheet" href="../../css/admin/sidebar.css">
    <link rel="stylesheet" href="../../admin/certificate/cert.css">
    <link rel="stylesheet" href="../../css/certificate.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.min.css">
</head>
<body>
    <!--SIDEBAR-->
    <?php include '../../admin/sidebar.php'; ?>

    <!--MAIN CONTENT-->
    <div class="main-content">
    <div class="container">
            <h1><center>Certificate</center></h1>
            <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Name on Cert</th>
                    <th class="viewCert">View</th>
                    <th class="select-column" style="display: none;">Select</th>
                </tr>
    </thead>
    <tbody>
                <?php
                foreach ($certData as $index => $player) {
                    echo "<tr>
                            <td>" . ($index + 1) . "</td>
                            <td>" . htmlspecialchars($player['username']) . "</td>
                            <td>" . htmlspecialchars($player['certname']) . "</td>
                            <td><button class='viewCert' onclick='openCertModal(" . json_encode($player) . ")'>View Certificate</button></td>
                            <td class='select-column' style='display: none;'><input type='checkbox' name='editName[]' value='" . htmlspecialchars($player['certid']) . "'></td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
            <div class="button-container">
            <button type="button" class="editbutton" id="editButton">Edit Name on Cert!</button>
            <center><button type="submit" class="editbutton confirm-edit" id="confirmEditButton" style="display:none;">Confirm Edit</button></center>
            <center><button type="submit" class="editbutton cancel-edit" id="cancelButton" style="display:none;">Cancel</button></center>
        </div></div>
<!-- Certificate Modal -->
        <div id="certModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="certContainer"></div>
            </div>
        </div>

    </div>
<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Certificate Name</h2>
        <form id="editForm" method="post" action="../../admin/certificate/edit.php">
            <input type="hidden" name="certid" id="editCertId">
            <label for="certname">Certificate Name:</label>
            <input type="text" name="certname" id="editCertName" required>
            <button type="submit" class="editbutton">Save Changes</button>
        </form>
    </div>
</div>


    </div>
    <script src="../../Javascript/sidebar.js"></script>
    <script>
        const certData = <?php echo json_encode($certData); ?>;
        
        
        // Toggle the visibility of checkboxes and buttons
        const editButton = document.getElementById('editButton');
const confirmEditButton = document.getElementById('confirmEditButton');
const cancelButton = document.getElementById('cancelButton');
const selectColumns = document.querySelectorAll('.select-column'); // Select the column

editButton.addEventListener('click', () => {
    selectColumns.forEach(column => {
        column.style.display = 'table-cell'; // Show the select column (header and checkboxes)
    });
    confirmEditButton.style.display = 'inline-block';
    cancelButton.style.display = 'inline-block'; // Show the confirm button
    editButton.style.display = 'none'; // Hide the reset button
});

cancelButton.addEventListener('click', () => {
    selectColumns.forEach(column => {
        column.style.display = 'none'; // Hide the select column (header and checkboxes)
    });
    confirmEditButton.style.display = 'none'; // Hide the confirm button
    cancelButton.style.display = 'none'; // Hide the cancel button
    editButton.style.display = 'inline-block'; // Show the reset button
});

// Get modal element
const modal = document.getElementById('editModal');
// Get close button
const closeBtn = document.querySelector('.close');

// Function to open modal and populate with data
function openEditModal(certid, certname) {
    modal.style.display = 'block';
    document.getElementById('editCertId').value = certid;
    document.getElementById('editCertName').value = certname;
}

// Close modal when user clicks on the close button
closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Close modal when user clicks outside of the modal
window.addEventListener('click', (event) => {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

// Add event listeners to edit buttons
confirmEditButton.addEventListener('click', () => {
    const selectedCheckbox = document.querySelector('input[name="editName[]"]:checked');
    
    if (selectedCheckbox) {
        const certid = selectedCheckbox.value;
        const certDataItem = certData.find(item => item.certid == certid);

        if (certDataItem) {
            openEditModal(certid, certDataItem.certname);
        }
    } else {
        alert('Please select a certificate to edit.');
    }
});

    </script>
    <script>
    // Get the modal element
    const certModal = document.getElementById('certModal');
    const certContainer = document.getElementById('certContainer');
    const closeCertBtn = certModal.querySelector('.close');

    // Function to open the certificate modal and populate with data
    function openCertModal(player) {
        certContainer.innerHTML = `
        <div class='certificate'>
            <div id="main"> 
                <div id="certs" class="certs">
                    <div class="certi">
                        <img src="../../image/Witchcraft.Code Logo (Without bg).png" alt="logo" class="img1"/>
                        <div class="logo">Witchcraft.Code</div>

                        <div class="marquee">Certificate of Completion</div>

                        <div class="assignment">This certificate is proudly presented to</div>

                        <div class="person">
                            ${player.certname}
                        </div>

                        <div class="reason">
                            For successfully completing the <br>
                            Witchcraft.Code Python E-learning Game.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    const certModal = document.getElementById('certModal');
    certModal.style.display = 'block';
}

    // Close modal when user clicks on the close button
    closeCertBtn.addEventListener('click', () => {
        certModal.style.display = 'none';
    });

    // Close modal when user clicks outside of the modal
    window.addEventListener('click', (event) => {
        if (event.target == certModal) {
            certModal.style.display = 'none';
        }
    });

    // Function to download the certificate (dummy function, needs implementation)
    function downloadCertificate() {
        alert("Download certificate functionality needs to be implemented.");
    }
</script>


    <script src="../../../Javascript/sidebar.js"></script>
    
</body>
</html>
<?php
    } else {
        // Redirect or show an error if the user is not logged in
        header("Location: ../../login_register/login_register.php");
        exit();
    }
?>