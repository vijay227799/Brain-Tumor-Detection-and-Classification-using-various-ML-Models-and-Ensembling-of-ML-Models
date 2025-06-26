<?php
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
  header("Location: patient.php");
  exit;
} else {
  // Login credentials are invalid, display an error message
  echo "Invalid email or password";
}

// Close the database connection
mysqli_close($conn);
?>