<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from MySQL table for the current user
$sql = "SELECT * FROM registration WHERE email = '".$_SESSION['email']."'"; // assuming you have a session variable for the current user's email
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = $row;
}

// Close connection
$conn->close();

// Output data in JSON format
echo json_encode($data);
?>