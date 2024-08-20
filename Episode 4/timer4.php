<?php
    if (!isset($_SESSION['timer_start'])) {
        $_SESSION['timer_start'] = time();
    }

    if (isset($_GET['reset']) && $_GET['reset'] === 'true') {
        $_SESSION['timer_start'] = time();
        $_SESSION['currentQuestionIndex'] = 1;
        $_SESSION['unlocked_questions'] = [1 => true];
        $_SESSION['score'] = 0;
        exit();
    }

    $elapsed = time() - $_SESSION['timer_start'];
    $remaining = max(0, 10 * 60 - $elapsed);
    $_SESSION['remaining_time'] = $remaining;
?>
