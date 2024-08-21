<?php
    session_start(); // Starts the session to share data, such as user login information, across multiple pages.

    include '../conn/conn.php'; // Includes the database connection file, which typically contains the code necessary to connect to the database.

    // Retrieve USER_ID from session
    $id = $_SESSION['USER_ID']; // Retrieves the current logged-in user's ID from the session. This ID will be used in subsequent database queries.

    // Fetch current user details from the database
    $currentDetails = mysqli_query($dbConn, "SELECT USER_NAME, USER_EMAIL FROM user_information WHERE USER_ID = $id");
    // Executes an SQL query to retrieve the current user's username and email from the database.

    $userData = mysqli_fetch_assoc($currentDetails);
    // Stores the query result in an associative array $userData, which includes the current user's username and email.

    $currentEmail = $userData['USER_EMAIL'];
    $currentName = $userData['USER_NAME'];
    // Assigns the current user's email and username to the variables $currentEmail and $currentName for later use.

    if (isset($_POST['submit'])) { 
        // Checks if the form has been submitted.
        $name = $_POST['new_name'];
        $email = $_POST['new_email'];
        $phone = $_POST['new_phonenum'];
        // Retrieves the new username, email, and phone number from the form submission.

        // Check if the email already exists for a different user
        $emailCheck = mysqli_query($dbConn, "SELECT * FROM user_information WHERE USER_EMAIL = '$email' AND USER_ID != $id");
        // Executes an SQL query to check if any other user (different from the current user) is using the same email.
        
        // Check if the username already exists for a different user
        $usernameCheck = mysqli_query($dbConn, "SELECT * FROM user_information WHERE USER_NAME = '$name' AND USER_ID != $id");
        // Executes an SQL query to check if any other user (different from the current user) is using the same username.

        // Debugging output
        if ($email == $currentEmail) {
            echo "<script>console.log('User is trying to update with the same email');</script>";
        }
        if ($name == $currentName) {
            echo "<script>console.log('User is trying to update with the same username');</script>";
        }
        // Outputs a console log for debugging if the user is trying to update with the same email or username they currently have.

        if (mysqli_num_rows($emailCheck) > 0 && $email != $currentEmail) { 
            echo "<script>alert('Email already exists. Please use another email.');</script>";
            echo "<script>window.location.href='edit_user_profile.php';</script>";
            exit();
        } elseif (mysqli_num_rows($usernameCheck) > 0 && $name != $currentName) { 
            echo "<script>alert('Username already exists. Please use another username.');</script>";
            echo "<script>window.location.href='edit_user_profile.php';</script>";
            exit();
        } 
        // If the email or username already exists for another user and the user is not trying to update with the same email/username, 
        // an alert is shown, and the user is redirected back to the profile edit page. The script then exits.

        else {
            // Update the user's information
            $sql = "UPDATE user_information SET 
                    USER_NAME = '$name',  
                    USER_EMAIL = '$email', 
                    USER_PHONENUMBER= '$phone' 
                    WHERE USER_ID = $id";
            mysqli_query($dbConn, $sql);
            // If no conflicts are found, an SQL query is executed to update the user's information with the new values.

            if (mysqli_affected_rows($dbConn) > 0) { 
                echo "<script>alert('Successfully updated data!');</script>";
                echo "<script>window.location.href='user_profile.php';</script>";
                exit(); 
            } 
            // If the update was successful (affected rows are greater than 0), an alert is shown, and the user is redirected to the profile page. The script then exits.

            else {
                echo "<script>alert('Cannot update data!');</script>";
                echo "<script>window.location.href='edit_user_profile.php';</script>";
                exit();
            }
            // If the update failed (no rows were affected), an alert is shown, and the user is redirected back to the profile edit page. The script then exits.
        }
    } else {
        echo "<script>window.location.href='user_profile.php';</script>";
        exit();
    }
    // If the form was not submitted, the user is redirected to the profile page, and the script exits.
?>