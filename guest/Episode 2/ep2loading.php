<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episode 2 Loading</title>
    <link rel="stylesheet" href="css/loading.css">

<!-- Google link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">


</head>

<style>

body {
  height: 100vh;
  width: 100%;
  background: var(--dark-violet) url('image/flying-witch.gif') no-repeat center center/cover;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
}

.fade-out {
        animation: fadeOut 1s forwards; 
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

</style>

<body>

<script>

setTimeout(function() {

    document.body.innerHTML = '<img id="welcome-image" src="image/Welcome.png" alt="Welcome to Episode 2!" />';

    setTimeout(function() {
        document.body.classList.add('fade-out');  
        
        setTimeout(function() {
            window.location.href = 'episode2.php';  
        }, 1000);  
    }, 1000);  

}, 3000);



</script>

<header class="active">
    <div class="container">
        <a href="../../index.html"><img src="image/Witchcraft.Code Logo.png"/></a>
    </div>
</header>

<div class="loading-container">
    <div class="loading-text">Loading to Episode 2 ...</div>
    <div class="spinner"></div>
</div>


</body>
</html>