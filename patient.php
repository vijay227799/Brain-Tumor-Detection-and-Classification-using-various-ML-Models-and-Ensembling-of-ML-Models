<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = $_POST['full_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $occupation = $_POST['occupation'];

    // Hash the password
    

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO registration (FULL_NAME, DATE_OF_BIRTH, EMAIL, MOBILE_NUMBER, PASS_WORD, GENDER, BLOOD_GROUP, OCCUPATION) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    if (!$stmt->bind_param("ssssssss", $full_name, $date_of_birth, $email, $mobile_number, $password, $gender, $blood_group, $occupation)) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>
        alert("Registration Successful");
        window.location.href = "index.php";
      </script>';
    } else {
        
        echo "Error executing statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
