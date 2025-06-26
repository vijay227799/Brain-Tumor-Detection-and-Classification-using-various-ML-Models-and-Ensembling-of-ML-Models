<?php
// Database connection settings
$servername = "localhost"; // Usually localhost
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "patient"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $new_password = $_POST['new_password']; // This should match the name attribute of the password input field

    // Validate form data
    if (empty($email) || empty($new_password)) {
        echo "All fields are required.";
    } else {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("UPDATE registration SET PASS_WORD=? WHERE EMAIL=?");
        $stmt->bind_param("ss", $new_password, $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Registration Successful");
            window.location.href = "index.php";
            </script>';
        } else {
            echo "Error updating password: ". $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

