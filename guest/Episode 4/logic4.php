<?php
    include '../../conn/conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userAnswer = $_POST['answer'];
        $currentQuestionIndex = $_SESSION['currentQuestionIndex'];

        $query = "SELECT CORRECT_ANSWER, OPTION_A_EXPLANATION, OPTION_B_EXPLANATION, 
                        OPTION_C_EXPLANATION, OPTION_D_EXPLANATION 
                FROM game_episode 
                WHERE EPISODE_ID = 4 
                LIMIT 1 OFFSET ?";
        $stmt = mysqli_prepare($dbConn, $query);

        if (!$stmt) {
            die('Failed to prepare statement: ' . mysqli_error($dbConn));
        }

        mysqli_stmt_bind_param($stmt, 'i', $currentQuestionIndex);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $questionData = mysqli_fetch_assoc($result);
            $correctAnswer = $questionData['CORRECT_ANSWER'];
            $explanations = [
                'A' => $questionData['OPTION_A_EXPLANATION'],
                'B' => $questionData['OPTION_B_EXPLANATION'],
                'C' => $questionData['OPTION_C_EXPLANATION'],
                'D' => $questionData['OPTION_D_EXPLANATION']
            ];

            if (!isset($_SESSION['score'])) {
                $_SESSION['score'] = 0;
            }
            if ($userAnswer === $correctAnswer) {
                $_SESSION['score'] += 100;
                $scoreDisplay = "<span style='color: #7DFF5C;'>100</span>";

                $nextQuestionIndex = $currentQuestionIndex + 1;

                if ($nextQuestionIndex > 5) {
                    $message = "<span style='color: #7DFF5C;'><strong>Congratulations!</strong></span> You've completed all sections.🎉";
                    $nextButton = "<a href='../certificate/certificate_details.php' class='next-button'>Finish</a>";
                    include 'save_result4.php';
                    unset($_SESSION['currentQuestionIndex']);
                } else {
                    $_SESSION['currentQuestionIndex'] = $nextQuestionIndex;
                    $message = "Well done! Your answer is correct. You earned $scoreDisplay points.<br>";
                    $message .= "<span style='color: #7DFF5C;'><strong>Answer $userAnswer is correct.✅</strong></span><br>";
                    $message .= "Explanation: " . $explanations[$userAnswer];
                    $nextButton = "<a href='?section=$nextQuestionIndex' class='next-button'>Next Section</a>";
                }
            } else {
                $message = "Oh no! Your answer is incorrect. Please retry the question.<br>";
                $message .= "<span style='color: #FF3F3F;'><strong>Answer $userAnswer is wrong.❌</strong></span><br>";
                $message .= "Explanation: " . $explanations[$userAnswer];
                $nextButton = "<a href='?section=$currentQuestionIndex' class='next-button'>Retry</a>";
            }
            
            $_SESSION['message'] = $message;
            $_SESSION['nextButton'] = $nextButton;
            $_SESSION['questionAnswered'] = true;
            
            if ($userAnswer === $correctAnswer) {
                $_SESSION['currentQuestionIndex']+1;
            }

            header("Location: episode4.php");
            exit();
        } else {
            die("No question data found.");
        }
    }
?>