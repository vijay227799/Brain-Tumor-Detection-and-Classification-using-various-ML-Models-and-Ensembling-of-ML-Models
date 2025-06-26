<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<script>alert("'. $_SESSION['message']. '");</script>';
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="style1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
      </div>
      <div class="form-container">
        <div class="form-inner">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login">
            <div class="field">
              <input type="text" name="email" placeholder="Email Address" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="pass-link"><a href="login.html">New User? REGISTER</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login">
            </div>
          </form>
        </div>
      </div>
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
        // Login credentials are valid, redirect to patient.html
        $_SESSION['message'] = 'Login successful!';
        $_SESSION['email'] = $email;//to send this varaible as session variable to patientdshboard.php file.
        header("Location: patientdashboard.php");
        exit;
      } else {
        // Login credentials are invalid, display an error message
        $_SESSION['message'] = 'Invalid email or password';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
      }

      // Close the database connection
      mysqli_close($conn);
    }
    ?>
  </body>
</html>