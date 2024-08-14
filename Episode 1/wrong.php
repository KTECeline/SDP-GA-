<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/wrong.css/">
</head>
<body>
    <div class="container">
        <h1>You answer is wrong !!</h1>
        <h1>Please try again!</h1>
        <a href="Episode1.php" class="retry">RETRY</a>
        <img width="400px" src="wrong image.gif" alt="wrong image" class="wrongimage">

    <script>
        var retry = document.querySelectorAll('.retry');

        retry.forEach(function(retry) {
        retry.addEventListener('mouseover', function() {
            this.style.backgroundColor = 'lightgreen'; 
            this.style.color= 'black';
        });

        retry.addEventListener('mouseout', function() {
            this.style.backgroundColor = ''; 
            this.style.color='';
        });
    });
    </script>    
</body>
</html>