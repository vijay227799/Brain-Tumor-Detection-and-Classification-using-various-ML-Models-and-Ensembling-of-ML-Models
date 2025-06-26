<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Animated Login Form - Bedimcode</title>
    <link rel="stylesheet" href="login-form/assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <div class="login">
        <img src="login-form/assets/img/login-bg.png" alt="login image" class="login__img">

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="login__form">
            <h1 class="login__title">Login</h1>

            <div class="login__content">
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="email" required class="login__input" id="login-email" name="email" placeholder=" ">
                        <label for="login-email" class="login__label">Email</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="password" required class="login__input" id="login-pass" name="password" placeholder=" ">
                        <label for="login-pass" class="login__label">Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                    </div>
                </div>
            </div>

            <div class="login__check">
                <div class="login__check-group">
                    <input type="checkbox" class="login__check-input" id="login-check">
                    <label for="login-check" class="login__check-label">Remember me</label>
                </div>

                <a href="forgot_password.html" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" class="login__button">Login</button>

            <p class="login__register">
                Don't have an account? <a href="login.html">Register</a>
            </p>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "patient");

        // Check connection
        if (!$conn) {
            die("Connection failed: ". mysqli_connect_error());
        }

        // Retrieve the posted values
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query the registration table to verify the login credentials
        $query = "SELECT * FROM registration WHERE EMAIL = '$email' AND PASS_WORD = '$password'";
        $result = mysqli_query($conn, $query);

        // Check if the query returned a result
        if (mysqli_num_rows($result) > 0) {
            // Login credentials are valid, redirect to patientdashboard.php
            $_SESSION['email'] = $email;//to send this varaible as session variable to patientdshboard.php file
            $_SESSION['message'] = 'Login successful!';
            echo '<script>alert("Login Successful");
            window.location.href = "patientdashboard.php";
            </script>';;#This is how you embedd javascript in php
           
            exit;
        } else {
            // Login credentials are invalid, display an error message
            $_SESSION['message'] = 'Invalid email or password';
        }

        // Close the database connection
        mysqli_close($conn);
    }
   ?>
</body>
</html>