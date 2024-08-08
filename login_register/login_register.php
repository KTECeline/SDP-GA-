<?php
    session_start();

    include '../conn/conn.php';

    if (isset($_POST['register'])) { 

        $name = $_POST['name']; 
        $email = $_POST['email'];
        $phone = $_POST['phonenumber'];
        $username = $_POST['username'];
        $password = $_POST['password']; 
        $role = 'user';

        $emailCheck = mysqli_query($dbConn, "SELECT * FROM user_information WHERE USER_EMAIL = '$email'"); 
        $usernameCheck = mysqli_query($dbConn, "SELECT * FROM user_information WHERE USER_USERNAME = '$username'"); 

        if (mysqli_num_rows($emailCheck) > 0) { 
            echo "<script>alert('Email already exists. Please use another email.');</script>";
        } elseif (mysqli_num_rows($usernameCheck) > 0) { 
            echo "<script>alert('Username already exists. Please use another username.');</script>";
        } else {
            $sql = "INSERT INTO user_information (USER_NAME, USER_EMAIL, USER_PHONENUMBER, USER_USERNAME, USER_PASSWORD, ROLES) 
                    VALUES ('$name', '$email', '$phone', '$username', '$password', '$role');"; 
            mysqli_query($dbConn, $sql);

            if (mysqli_affected_rows($dbConn) <= 0) { 
                echo "<script>alert('Error: Unable to register. Please try again!');</script>";
            } else {
                echo "<script>alert('Successfully registered!');</script>";
                echo "<script>window.location.href = 'homepage.php';</script>";
                exit();
            }
        }
    }

    if (isset($_POST['login'])) {

        $username_email = $_POST['username-email'];
        $password = $_POST['password'];

        $user_query = "SELECT * FROM user_information WHERE (USER_USERNAME = '$username_email' OR USER_EMAIL = '$username_email') AND USER_PASSWORD = '$password'";
        $user_result = mysqli_query($dbConn, $user_query);

        if (mysqli_num_rows($user_result) > 0) {
            $row = mysqli_fetch_array($user_result);
            $_SESSION['name'] = $row['USER_USERNAME']; 
            echo "<script>alert('Successfully logged in!');</script>";
            echo "<script>window.location.href = 'homepage.php';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect username/email!');</script>";
        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" href="../css/swiper.css"/>
        <link rel="stylesheet" href="../css/login_register.css"/>
        <script src="../Javascript/swiper.js"></script>
        <script src="../Javascript/login_register.js" defer></script>
        <title>Login & Register</title>
    </head>

    <body>
        <div class="app purple">
            <div class="app__slider swiper">
                <div class="app__slider-wrapper swiper-wrapper">
                    <div class="app__slider-slide swiper-slide">
                        <img src="../image/Purple.png" alt="Purple" />
                    </div>
                    <div class="app__slider-slide swiper-slide">
                        <img src="../image/Green.png" alt="Green" />
                    </div>
                    <div class="app__slider-slide swiper-slide">
                        <img src="../image/Brown.png" alt="Brown" />
                    </div>
                </div>
            </div>

            <div class="login">
                <div class="login__form d-flex align-center">
                    
                    <form class="form login-form d-flex f-column show" method="post" action="">
                        <div class="form_header">
                            <span class="close-button" onclick="closeLogin()">×</span>
                            <p class="form__title">Log In Account</p>
                            <p class="form__subtitle">Welcome Back</p>
                        </div>

                        <div class="form__group d-flex f-column r-gap-1">
                            <div class="form__field">
                                <label for="username-email">Username / Email:</label>
                                <input type="text" name="username-email" class="form__input" placeholder="Enter your username / email" required />
                            </div>

                            <div class="form__field">
                                <label for="password">Password:</label>  
                                <input type="password" name="password" class="form__input" placeholder="Enter your password" required />
                                <span class="password-toggle-icon" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <a href="forgot_password.php" class="form__link">Forgot password?</a>
                        </div>

                        <div class="form__group d-flex f-column r-gap-2">
                            <button class="form__button filled d-flex align-center justify-center" type="submit" name="login">
                                <div class="form__button-bg d-flex align-center justify-center"><p>Log In</p></div>
                                <div class="form__button-border"></div>
                            </button>
                            <button class="form__button outlined d-flex align-center justify-center" id="signup-btn" type="button">
                                <div class="form__button-bg d-flex align-center justify-center"><p>Sign Up</p></div>
                                <div class="form__button-border"></div>
                            </button>
                        </div>
                    </form>

                    <form class="form signup-form d-flex f-column" method="post" action="">
                        <div class="form__header">
                            <span class="close-button" onclick="closeLogin()">×</span>
                            <p class="form__title">Sign Up Account</p>
                            <p class="form__subtitle">Welcome To WitchCraft.Code E-learning Game</p>
                        </div>

                        <div class="form__group d-flex f-column r-gap-1">
                            <div class="form__field">
                                <label for="name">Full Name:</label>
                                <input type="text" name="name" class="form__input" placeholder="Enter your full name" required />
                            </div>

                            <div class="form__field">
                                <label for="email">Email Address:</label>
                                <input type="email" name="email" class="form__input" placeholder="Enter your email address" required />
                            </div>

                            <div class="form__field">
                                <label for="phonenumber">Phone Number:</label>
                                <input type="text" name="phonenumber" class="form__input" placeholder="Enter your phone number" required />
                            </div>

                            <div class="form__field">
                                <label for="username">Username:</label>
                                <input type="text" name="username" class="form__input" placeholder="Enter your username" required />
                            </div>

                            <div class="form__field">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form__input" placeholder="Enter your password" required />
                                <span class="password-toggle-icon" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form__group d-flex f-column r-gap-2">
                            <button class="form__button filled d-flex align-center justify-center" type="submit" name="register">
                                <div class="form__button-bg d-flex align-center justify-center"><p>Sign Up</p></div>
                                <div class="form__button-border"></div>
                            </button>
                            
                            <button class="form__button outlined d-flex align-center justify-center" id="login-btn" type="button">
                                <div class="form__button-bg d-flex align-center justify-center"><p>Log In</p></div>
                                <div class="form__button-border"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
