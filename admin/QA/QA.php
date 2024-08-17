<?php
    session_start();
    if (isset($_SESSION['name'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QA</title>
    <link rel="stylesheet" href="../../css/admin/sidebar.css">
    <link rel="stylesheet" href="../../admin/QA/QA.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.min.css">
</head>
<body>
    <!--SIDEBAR-->
    <?php include '../../admin/sidebar.php'; ?>

    <!--MAIN CONTENT-->
    <div class="main-content">
    <center><h1>Q & A lists</h1></center>
    <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true }'>
    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/5.png" alt="EP1">
            <div class="slide-title">EP1</div>
            <p>Basic Syntax</p>
            <a href="../../admin/QA/EP1/ep1.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>

    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/6.png" alt="EP2">
            <div class="slide-title">EP2</div>
            <p>Control Flow</p>
            <a href="../../admin/QA/ep2/ep2.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>

    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/7.png" alt="EP3">
            <div class="slide-title">EP3</div>
            <p>Data Structure</p>
            <a href="../../admin/QA/EP3/ep3.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>

    <div class="gallery-cell">
        <div class="sidepart">
            <img src="../../image/8.png" alt="EP4">
            <div class="slide-title">EP4</div>
            <p>File Handling</p>
            <a href="../../admin/QA/EP4/ep4.php"><button class="editbtn">Edit</button></a>
        </div>
    </div>
</div>

    </div>

    <script src="../../Javascript/sidebar.js"></script>
    <script src="../../admin/QA/QA.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
    <?php 
                        } else { }
                    ?>
</body>
</html>