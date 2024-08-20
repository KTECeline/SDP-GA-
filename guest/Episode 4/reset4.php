<?php
    if (isset($_GET['reset']) && $_GET['reset'] === 'true') {
        $_SESSION['currentQuestionIndex'] = 1;
        $_SESSION['unlocked_questions'] = [1 => true];
        $_SESSION['score'] = 0;
        $_SESSION['timer_start'] = time(); 
        header('Location: episode4.php');
        exit();
    }
?>