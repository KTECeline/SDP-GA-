<?php
// Database connection
$localhost = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'sdp_ga';

$conn = new mysqli($localhost, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from database
$sql = "SELECT 
  EPISODE_QUESTION_ID,
  EPISODE_QUESTION,
  EPISODE_HINT,
  OPTION_A,
  OPTION_A_EXPLANATION,
  OPTION_B,
  OPTION_B_EXPLANATION,
  OPTION_C,
  OPTION_C_EXPLANATION,
  OPTION_D,
  OPTION_D_EXPLANATION,
  CORRECT_ANSWER,
  EPISODE_ID
FROM 
  game_episode
WHERE 
  EPISODE_ID = 3;";
$result = $conn->query($sql);

$questions = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EP3</title>
    <link rel="stylesheet" href="../../../css/admin/sidebar.css">
    <link rel="stylesheet" href="../../../admin/QA/EP1/ep1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!--SIDEBAR-->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
        <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <a href='../../../admin/homepage.php' class="sidebar-title">Witchcraft.code</a>
        </div>

        <div class="profile-section">
            <img src="../../../image/witchghost.png" alt="Admin" class="profile-pic">
            <div class="profile-info">
                <h4>Admin Name</h4>
                <p>Administrator</p>
            </div>
        </div>
        <div class="sidebar-content">
            <a href="../../../admin/profile/profile.php" class="sidebar-item">
            <i class="fa-solid fa-id-badge"></i>
                <span>Profile</span>
            </a>
            <a href="../../../admin/playerList/playerList.php" class="sidebar-item">
            <i class="fa-solid fa-user-group"></i>
                <span>Player List</span>
            </a>
            <a href="../../../admin/QA/QA.php" class="sidebar-item">
                <i class="fas fa-question"></i>
                <span>Q&A List</span>
            </a>
            <a href="../../../admin/leaderboard/leaderboard.php" class="sidebar-item active">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
            </a>
            <a href="../../../admin/certificate/certificate.php" class="sidebar-item">
                <i class="fas fa-certificate"></i>
                <span>Certificate</span>
            </a>
            <a href="../../../admin/feedback/feedback.php" class="sidebar-item">
            <i class="fa-solid fa-comments"></i>
                <span>Feedback</span>
            </a>
            <a href="../../../login_register/logout.php" class="sidebar-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>

    <!--MAIN CONTENT-->
    <div class="main-content">
        <div class="back">
            <a href="../../../admin/QA/QA.php" button><i class="fas fa-arrow-left"></i> Back</a>
            <a href="../../../admin/homepage.php" button><i class="fas fa-home"></i> Home</a>
            <a href="../../../admin/QA/ep3/create.php" button><i class="fa-solid fa-plus"></i> Create Question</a>
        </div>
        <div class="ep1-container">
        <h1 class="ep1-title">EP3</h1>
        <?php foreach ($questions as $index => $question): ?>
        <div class="question-card" id="question-<?php echo $index + 1; ?>" style="display: <?php echo $index === 0 ? 'flex' : 'none'; ?>;">
            
            <div class="question-content">
                <p class="question-text">Question <?php echo $index + 1; ?>: <?php echo htmlspecialchars($question['EPISODE_QUESTION']); ?></p>
                <div class="options">
                    <div class="option">A. <?php echo htmlspecialchars($question['OPTION_A']); ?></div>
                    <p class="explanation">Explanation: <?php echo htmlspecialchars($question['OPTION_A_EXPLANATION']); ?></p>

                    <div class="option">B. <?php echo htmlspecialchars($question['OPTION_B']); ?></div>
                    <p class="explanation">Explanation: <?php echo htmlspecialchars($question['OPTION_B_EXPLANATION']); ?></p>

                    <div class="option">C. <?php echo htmlspecialchars($question['OPTION_C']); ?></div>
                    <p class="explanation">Explanation: <?php echo htmlspecialchars($question['OPTION_C_EXPLANATION']); ?></p>

                    <div class="option">D. <?php echo htmlspecialchars($question['OPTION_D']); ?></div>
                    <p class="explanation">Explanation: <?php echo htmlspecialchars($question['OPTION_D_EXPLANATION']); ?></p>
                </div>
                <p class="correct-answer">Correct Answer: <?php echo htmlspecialchars($question['CORRECT_ANSWER']); ?></p>
            </div>
            <div class="action-buttons">
                <i class="fas fa-trash" onclick="deleteQuestion(<?php echo $question['EPISODE_QUESTION_ID']; ?>)"></i>
                <i class="fas fa-edit" onclick="editQuestion(<?php echo $question['EPISODE_QUESTION_ID']; ?>)"></i>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="navigation">
            <span class="nav-arrow" onclick="changeQuestion(-1)">&#8249;</span>
            <div class="question-dots">
                <?php for ($i = 1; $i <= count($questions); $i++): ?>
                <div class="dot <?php echo $i === 1 ? 'active' : ''; ?>" onclick="showQuestion(<?php echo $i; ?>)"><?php echo $i; ?></div>
                <?php endfor; ?>
            </div>
            <span class="nav-arrow" onclick="changeQuestion(1)">&#8250;</span>
        </div>
    </div>


    <!-- Add a modal container to your HTML -->
<div class="modal" id="edit-modal">
  <div class="modal-content">
    <h2>Edit Question</h2>
    <form id="edit-form">
      <input type="hidden" name="EPISODE_QUESTION_ID" id="EPISODE_QUESTION_ID">
      <label for="EPISODE_QUESTION">Question:</label>
      <textarea name="EPISODE_QUESTION" id="EPISODE_QUESTION"></textarea>
      <label for="OPTION_A">Option A:</label>
      <input type="text" name="OPTION_A" id="OPTION_A">
      <label for="OPTION_A_EXPLANATION">Explanation A:</label>
      <textarea name="OPTION_A_EXPLANATION" id="OPTION_A_EXPLANATION"></textarea>
      <label for="OPTION_B">Option B:</label>
      <input type="text" name="OPTION_B" id="OPTION_B">
      <label for="OPTION_B_EXPLANATION">Explanation B:</label>
      <textarea name="OPTION_B_EXPLANATION" id="OPTION_B_EXPLANATION"></textarea>
      <label for="OPTION_C">Option C:</label>
      <input type="text" name="OPTION_C" id="OPTION_C">
      <label for="OPTION_C_EXPLANATION">Explanation C:</label>
      <textarea name="OPTION_C_EXPLANATION" id="OPTION_C_EXPLANATION"></textarea>
      <label for="OPTION_D">Option D:</label>
      <input type="text" name="OPTION_D" id="OPTION_D">
      <label for="OPTION_D_EXPLANATION">Explanation D:</label>
      <textarea name="OPTION_D_EXPLANATION" id="OPTION_D_EXPLANATION"></textarea>
      <label for="CORRECT_ANSWER">Correct Answer:</label>
      <select name="CORRECT_ANSWER" id="CORRECT_ANSWER">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
      </select>
      <button type="submit">Save Changes</button>
      <button type="button" onclick="cancelEdit()">Cancel</button>
    </form>
  </div>
</div>



    </div>
    <script src="../../../admin/QA/EP1/ep1.js"></script>
    <script src="../../../Javascript/sidebar.js"></script>
    <script>
    let currentQuestion = 1;
    const totalQuestions = <?php echo count($questions); ?>;

    function showQuestion(num) {
        document.getElementById(`question-${currentQuestion}`).style.display = 'none';
        document.querySelector(`.dot:nth-child(${currentQuestion})`).classList.remove('active');
        
        currentQuestion = num;
        document.getElementById(`question-${currentQuestion}`).style.display = 'flex';
        document.querySelector(`.dot:nth-child(${currentQuestion})`).classList.add('active');
    }

    function changeQuestion(delta) {
        let newQuestion = currentQuestion + delta;
        if (newQuestion > 0 && newQuestion <= totalQuestions) {
            showQuestion(newQuestion);
        }
    }

    function deleteQuestion(EPISODE_QUESTION_ID) {
        if (confirm('Are you sure you want to delete this question?')) {
            var xhr = new XMLHttpRequest();
        xhr.open('POST', '../../../admin/QA/EP1/delete1.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                // Reload the page or update the UI after successful deletion
                location.reload();
            }
        };

        xhr.send('EPISODE_QUESTION_ID=' + EPISODE_QUESTION_ID);
    }
}

function editQuestion(EPISODE_QUESTION_ID) {
     // Show the modal
     document.getElementById('edit-modal').style.display = 'block';
  // Get the question data from the database using AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../../../admin/QA/EP1/get_question.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhr.onload = function() {
    if (xhr.status === 200) {
      var questionData = JSON.parse(xhr.responseText);
      // Populate the modal form with the question data
      document.getElementById('EPISODE_QUESTION_ID').value = EPISODE_QUESTION_ID;
      document.getElementById('EPISODE_QUESTION').value = questionData.EPISODE_QUESTION;
      document.getElementById('OPTION_A').value = questionData.OPTION_A;
      document.getElementById('OPTION_A_EXPLANATION').value = questionData.OPTION_A_EXPLANATION;
      document.getElementById('OPTION_B').value = questionData.OPTION_B;
      document.getElementById('OPTION_B_EXPLANATION').value = questionData.OPTION_B_EXPLANATION;
      document.getElementById('OPTION_C').value = questionData.OPTION_C;
      document.getElementById('OPTION_C_EXPLANATION').value = questionData.OPTION_C_EXPLANATION;
      document.getElementById('OPTION_D').value = questionData.OPTION_D;
      document.getElementById('OPTION_D_EXPLANATION').value = questionData.OPTION_D_EXPLANATION;
      document.getElementById('CORRECT_ANSWER').value = questionData.CORRECT_ANSWER;
     
    }
  };

  xhr.send('EPISODE_QUESTION_ID=' + EPISODE_QUESTION_ID);
}

<!-- Add a script to handle the form submission -->
document.getElementById('edit-form').addEventListener('submit', function(event) {
  event.preventDefault();
  var formData = new FormData(this);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../../../admin/QA/EP1/update_question.php', true);
  xhr.send(formData);
  xhr.onload = function() {
    if (xhr.status === 200) {
      alert(xhr.responseText);
      // Close the modal and reload the page
      document.getElementById('edit-modal').style.display = 'none';
      location.reload();
    }
  };
});

function cancelEdit() {
  // Hide the modal
  document.getElementById('edit-modal').style.display = 'none';
}
    </script>
</body>
</html>
