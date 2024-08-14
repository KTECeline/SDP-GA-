<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episode</title>
    <link rel="stylesheet" href="cor.css">
    
</head>
<body>

    <div class="container">
        <div class="container-image">
            <img width="400px" src="Flying witch.gif" alt="Flying witch" class="rotate90">
        </div>
        <div class="container-right">
            <h1 class="question">1+1=?</h1>
            <div class="hint">HINT:1+1=2</div>
            <div class="next"><a href="Episode2.php">next</a></div>
        </div>
    <script>

    var next = document.querySelectorAll('.next');

    // anwser changer color
    next.forEach(function(next) {
        next.addEventListener('mouseover', function() {
            this.style.backgroundColor = 'lightgreen'; 
        });

        next.addEventListener('mouseout', function() {
            this.style.backgroundColor = ''; 
        });
    });
    </script>
</body>
</html>