<?php
    session_start();
    include '../../conn/conn.php';
    include 'question_option_hint4.php';
    include 'logic4.php';
    include 'reset4.php';
    include 'timer4.php';

    if (!isset($_SESSION['currentQuestionIndex'])) {
        $_SESSION['currentQuestionIndex'] = 5;
    }
    
    $witchCoordinates = [
        1 => ['x' => 310, 'y' => 120],
        2 => ['x' => 310, 'y' => 120],  
        3 => ['x' => 130, 'y' => 70], 
        4 => ['x' => 640, 'y' => 95],  
        5 => ['x' => 470, 'y' => 260],  
    ];
    
    $witchCoordinatesJson = json_encode($witchCoordinates);
    $currentSection = $_SESSION['currentQuestionIndex'];

    $currentQuestionIndex = isset($_SESSION['currentQuestionIndex']) ? $_SESSION['currentQuestionIndex'] : 0;
    $questionAnswered = isset($_SESSION['questionAnswered']) ? $_SESSION['questionAnswered'] : false;
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    $nextButton = isset($_SESSION['nextButton']) ? $_SESSION['nextButton'] : '';
    unset($_SESSION['message']); 
    unset($_SESSION['nextButton']);
    unset($_SESSION['questionAnswered']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Episode 4</title>
        <link rel="stylesheet" href="../../css/Episode4.css">
        <script src="../../Javascript/episode4.js"></script>
        <script>
            var witchCoordinates = <?php echo $witchCoordinatesJson; ?>;
            var currentSection = <?php echo $currentSection; ?>;
        </script>
    </head>

    <body>
          <header class="active">
            <div class="container">
                <a href="episode4.php?reset=true" class="reset-button" onclick="replayGame()"><img src="../../image/Witchcraft.Code Logo.png" alt="Logo"/></a>
    
                <div class="header-title">
                     Episode 4: File Handling and Library
                </div>
            </div>
        </header> 

        <main class="episode-container">
            <div class="top-bar">
                <h3>Section <span id="currentSection"><?php echo $currentQuestionIndex; ?></span></h3>
                <div class="timer-menu">
                    <span class="timer-icon">⏳</span>
                    <span class="timer" id="timer"><?php echo floor($_SESSION['remaining_time'] / 60) . ":" . str_pad($_SESSION['remaining_time'] % 60, 2, '0', STR_PAD_LEFT); ?></span>
                </div>
            </div>

            <div class="box">
                <div class="maze-container">
                    <canvas id="mazeCanvas" class="mazeCanvas" width="800" height="333"></canvas>
                    <div class="locked"></div>

                    <div class="sidebar">
                        <p class="side">Progress: <span id="progress"><?php echo $currentQuestionIndex; ?></span>/5</p>
                        <p class="side">Score: <span id="score"><?php echo $_SESSION['score']; ?></span> score</p>
                        <br>
                        <button onclick="showModal(event)" class="run">Stop</button>
                    </div>

                    <div id="question-container" class="question-container">
                        <?php if ($message): ?>
                            <p class='message'><?php echo $message; ?></p>
                        <?php endif; ?>
    
                        <?php if (!$questionAnswered): ?>
                            <p class='question'>Question <?php echo $currentQuestionIndex; ?>: <?php echo htmlspecialchars($question); ?></p>
                            <form method='POST'>
                                <div class='options'>
                                    <?php foreach ($options as $key => $value): ?>
                                        <button type='submit' name='answer' value='<?php echo htmlspecialchars($key); ?>' class='option'>
                                            <?php echo htmlspecialchars($key); ?>.
                                            <?php echo htmlspecialchars($value); ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </form>
                        <?php endif; ?>
                        
                        <?php if (!$message): ?>  
                            <button onclick="fetchHint()" class="hint-button">💡</button>
                        <?php endif; ?>
                        
                        <p id="hintText<?= $_SESSION['currentQuestionIndex'] ?>" class="hintText" style="display: none;"></p>
                        
                        <div class="options-container">
                            <div id="hintOkButton<?= $_SESSION['currentQuestionIndex'] ?>" class="hintOkButton" style="display: none;">
                                <a href='?section=<?= $_SESSION['currentQuestionIndex'] ?>' class='next-button'>OK</a>
                            </div>
                            
                            <?php if ($nextButton): ?>
                                <?php echo $nextButton; ?>
                            <?php endif; ?>
                        </div>
                    </div>
        
                    <div id="messageModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" onclick="closeMessageModal()">&times;</span>
                            <p id="messageText" class="Text"></p>
                        </div>
                    </div>

                    <div id="timeoutModal" class="modal">
                        <div class="modal-content">
                            <p id="messageText" class="Text">Time is up! What would you like to do?</p><br>
                            <button onclick="replayGame()" class='next-button'>Replay</button>
                            <button onclick="endGame()" class='next-button'>End Game</button>
                        </div>
                    </div>

                    <div id="stop-modal" class="modal">
                        <div class="modal-content">
                            <p class="Text">Your timer has been stopped. What would you like to do?</p><br>
                            <button onclick="hideModal()" class='next-button'>Continue</button>
                            <button onclick="endGame()" class='next-button'>End Game</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="../../Javascript/episode4.js"></script>
        <script>
            var witchX = 310;
            var witchY = 120;
            var timer;
            var totalTime = <?php echo $_SESSION['remaining_time']; ?>;
            var timeLeft = totalTime;
            var currentQuestionIndex = <?php echo $currentQuestionIndex; ?>;
            var chestMessageShown = <?php echo json_encode($_SESSION['chestMessageShown']); ?>;

        </script>
    </body>
</html>