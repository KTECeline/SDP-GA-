<?php
// Create a new question
$localhost = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'sdp_ga';

$conn = new mysqli($localhost, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a new question
if (isset($_POST['submit'])) {
  $question = $_POST['EPISODE_QUESTION'];
  $hint = $_POST['EPISODE_HINT'];
  $option_a = $_POST['OPTION_A'];
  $option_a_explanation = $_POST['OPTION_A_EXPLANATION'];
  $option_b = $_POST['OPTION_B'];
  $option_b_explanation = $_POST['OPTION_B_EXPLANATION'];
  $option_c = $_POST['OPTION_C'];
  $option_c_explanation = $_POST['OPTION_C_EXPLANATION'];
  $option_d = $_POST['OPTION_D'];
  $option_d_explanation = $_POST['OPTION_D_EXPLANATION'];
  $correct_answer = $_POST['CORRECT_ANSWER'];
  $episode_id = $_POST['EPISODE_ID'];

  if ($episode_id == 2) {
    $query = "INSERT INTO game_episode (EPISODE_QUESTION, EPISODE_HINT, OPTION_A, 
    OPTION_A_EXPLANATION, OPTION_B, OPTION_B_EXPLANATION, OPTION_C, OPTION_C_EXPLANATION, 
    OPTION_D, OPTION_D_EXPLANATION, CORRECT_ANSWER, EPISODE_ID) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssi", $question, $hint, $option_a, $option_a_explanation, 
    $option_b, $option_b_explanation, $option_c, $option_c_explanation, 
    $option_d, $option_d_explanation, $correct_answer, $episode_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
        alert('New question created successfully!');
        window.location.href = '../../../admin/QA/ep2/ep2.php';
      </script>";
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "Episode ID is not 2. Cannot create question.";
  }
}

// Close the database connection
$conn->close();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../../../admin/QA/EP1/ep1.css">
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #3d2b5f;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #8c7bad;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    width: 80%;
    max-width: 800px;
    margin: auto;
    margin-top: 5%;
   align-items: center;
}

h2 {
    text-align: center;
    color: white;
    margin-top: 100px;
    margin-bottom:-20px;
}

label {
    font-weight: bold;
    color: white;
}

textarea, input, select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    background-color: #5c4b7d;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 75%;
    margin-top: 15px;
    margin-left: 12.5%;
}

button:hover {
    background-color: #6d5a8d;
}

.form-column {
    float: left;
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 10px;
}

@media (min-width: 768px) {
    .form-column {
        width: 32%;
    }
    .form-column:nth-child(3n) {
        margin-right: 0;
    }
}

/* Add these styles */
.form-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}

.form-row .form-column {
    width: 48%;
}

.form-row .form-column.full-width {
    width: 100%;
}

@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
    }

    .form-row .form-column {
        width: 100%;
    }
}

input[type="submit"] {
    background-color: white;
    color: #5c4b7d;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 75%;
    margin-top: 15px;
    margin-left: 12.5%;
}
</style>
<!-- Create question form -->
<div class="qform">
    <center><h2>Create a New Question in EP2</h2></center>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Question and Hint on the same line -->
        <div class="form-row">
            <div class="form-column">
                <label for="EPISODE_QUESTION">Question:</label>
                <textarea name="EPISODE_QUESTION" id="EPISODE_QUESTION"></textarea>
            </div>
            <div class="form-column">
                <label for="EPISODE_HINT">Hint:</label>
                <input type="text" name="EPISODE_HINT" id="EPISODE_HINT">
            </div>
        </div>
        
        <!-- Options and Explanations -->
        <div class="form-row">
            <div class="form-column">
                <label for="OPTION_A">Option A:</label>
                <input type="text" name="OPTION_A" id="OPTION_A">
                <label for="OPTION_A_EXPLANATION">Option A Explanation:</label>
                <input type="text" name="OPTION_A_EXPLANATION" id="OPTION_A_EXPLANATION">
            </div>
            <div class="form-column">
                <label for="OPTION_B">Option B:</label>
                <input type="text" name="OPTION_B" id="OPTION_B">
                <label for="OPTION_B_EXPLANATION">Option B Explanation:</label>
                <input type="text" name="OPTION_B_EXPLANATION" id="OPTION_B_EXPLANATION">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-column">
                <label for="OPTION_C">Option C:</label>
                <input type="text" name="OPTION_C" id="OPTION_C">
                <label for="OPTION_C_EXPLANATION">Option C Explanation:</label>
                <input type="text" name="OPTION_C_EXPLANATION" id="OPTION_C_EXPLANATION">
            </div>
            <div class="form-column">
                <label for="OPTION_D">Option D:</label>
                <input type="text" name="OPTION_D" id="OPTION_D">
                <label for="OPTION_D_EXPLANATION">Option D Explanation:</label>
                <input type="text" name="OPTION_D_EXPLANATION" id="OPTION_D_EXPLANATION">
            </div>
        </div>

        <!-- Correct Answer and submit button -->
        <div class="form-row">
            <div class="form-column">
                <label for="CORRECT_ANSWER">Correct Answer:</label>
                <select name="CORRECT_ANSWER" id="CORRECT_ANSWER">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            <div class="form-column full-width">
                <input type="hidden" name="EPISODE_ID" value="2">
                <input type="submit" name="submit" value="Create Question">
                <button type="button" onclick="window.history.back()">Cancel</button>
            </div>
        </div>
    </form>
</div>
