<?php
    include '../conn/conn.php';

    if (!isset($_SESSION['currentQuestionIndex'])) {
        $_SESSION['currentQuestionIndex'] = 5; 
    }

    $currentQuestionIndex = intval($_SESSION['currentQuestionIndex']);

    if (isset($_GET['getHint']) && $_GET['getHint'] === 'true' && isset($_GET['section'])) {
        $section = intval($_GET['section']);
        $query = "SELECT EPISODE_HINT FROM game_episode WHERE EPISODE_ID = 4 LIMIT 1 OFFSET ?";
        $stmt = mysqli_prepare($dbConn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $section);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row['EPISODE_HINT'];
        } else {
            echo "No hint available.";
        }
        mysqli_close($dbConn);
        exit;
    }
    
    $query = "SELECT EPISODE_QUESTION, OPTION_A, OPTION_B, OPTION_C, OPTION_D, 
                    CORRECT_ANSWER, OPTION_A_EXPLANATION, OPTION_B_EXPLANATION, 
                    OPTION_C_EXPLANATION, OPTION_D_EXPLANATION, EPISODE_HINT 
            FROM game_episode 
            WHERE EPISODE_ID = 4 
            LIMIT 1 OFFSET ?";
    $stmt = mysqli_prepare($dbConn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $currentQuestionIndex);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query failed: " . mysqli_error($dbConn));
    }

    $questions = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = [
            'question' => $row['EPISODE_QUESTION'],
            'options' => [
                'A' => $row['OPTION_A'],
                'B' => $row['OPTION_B'],
                'C' => $row['OPTION_C'],
                'D' => $row['OPTION_D']
            ],
            'correct_answer' => $row['CORRECT_ANSWER'],
            'explanations' => [
                'A' => $row['OPTION_A_EXPLANATION'],
                'B' => $row['OPTION_B_EXPLANATION'],
                'C' => $row['OPTION_C_EXPLANATION'],
                'D' => $row['OPTION_D_EXPLANATION']
            ],
            'hint' => $row['EPISODE_HINT']
        ];
    }

    mysqli_close($dbConn);

    if (!empty($questions)) {
        $currentQuestion = $questions[0]; 

        $question = $currentQuestion['question'];
        $options = $currentQuestion['options'];
        $correctAnswer = $currentQuestion['correct_answer'];
        $explanations = $currentQuestion['explanations'];
        $hint = $currentQuestion['hint'];

    } else {
        echo json_encode(['error' => 'No questions found.']);
    }
?>