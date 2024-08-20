
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congratulation</title>
    <link href="https://fonts.cdnfonts.com/css/ocr-a-std" rel="stylesheet">
    <style>
        body {
            background: url('../image/ep3end.gif') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'OCR A Std', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container-congrats {
            background-color: rgba(0, 0, 0, 0.7); /* Slightly transparent black background */
            border-radius: 8px;
            padding: 20px;
            width: 1100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: white;
        }

        p {
            color: white;
        }

        .no{
            color:#6600ff ;
            border-radius: 8px;
        }

        .yes{
            color:#fb5cfe ;
            border-radius: 8px;
        }

        .witch {
            position: absolute;
            top: 55%;
            left: 77%;
            transform: translate(-50%, -50%);
           
        }

        .witch img {
            width: 150px;  /* Adjust width */
            height: 150px; /* Adjust height */
            object-fit: contain; /* Ensures the image maintains its aspect ratio */
        }
        header {
            background: #150849; /* Set header background color to black */
            width: 100%;
            height: 75px;
            position: fixed;
            z-index: 4;
            padding: 0.5vw 5vw;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.30);
            display: flex;
            justify-content: center;
            align-items: center; 

        }

        header.active {
            top: 0;
        }

        header .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        header img {
            width: 70px;
            cursor: pointer;
        }
        .header-title {
            color: white;
            font-size: 18px;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
<header class="active">

<div class="container">
    <a href="#"><img src="../image/Witchcraft.Code Logo.png"/></a>

    <div class="header-title">
            Episode 3: Data Structure
        </div>

</div>

</header>

    <div class="witch">
        <img src="../image/congrats witch.gif" />
    </div>
    <div class="container-congrats">
    <h1>Congratulations ! You have passed Episode 3 !<h1>
    <p>Continue explore Episode 4 ?<p>
    <a class="no" href ="../user/homepage.php">No</a> <a class="yes" href="../Episode4/briefing4.php">Yes</a>
    </div>
</body>
</html>