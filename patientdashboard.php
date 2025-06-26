<?php 
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patientstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    

    <title>Admin Dashboard Panel</title>
</head>
<body>
    
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" id="logo">
            </div>
            <span class="logo_name">BRAINSCAN AI</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="http://localhost:8501">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Testing</span>
                    </a></li>
            </ul>
            <ul class="logout-mode">
                <li><a href="index.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <img src="images/profile.jpg" alt="">
        </div>
       
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-user"></i>
                    <span class="text">Profile</span>
                </div>
                
                <div class="boxes" style="display: flex; flex-direction: column; align-items:left;">
                    <?php
                    // Database connection
                    $conn = mysqli_connect("localhost", "root", "", "patient");

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }


                    // Fetch patient data
                    $query = "SELECT * FROM registration WHERE EMAIL = '$email'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $patient_data = mysqli_fetch_assoc($result);
                    ?>
                   
                    <div style="align-items: left;">
                    <h3 style="font-size: 54px; font-style:italic;">Hello <span style="color: #00008B;">  <?php echo $patient_data['FULL_NAME']; ?> </span></h3><br>
                        <h2 style="color: #00008B; font-size: 18px; text-align:left;">
                            Patient ID:
                            <span style="color: #00008B;"><?php echo $patient_data['PATIENT_ID']; ?></span><br><br>
                            Full Name:
                            <span style="color: #00008B;"><?php echo $patient_data['FULL_NAME']; ?></span><br><br>
                            Date of Birth:
                            <span style="color: #00008B;"><?php echo $patient_data['DATE_OF_BIRTH']; ?></span><br><br>
                            Email:
                            <span style="color:#00008B;"><?php echo $patient_data['EMAIL']; ?></span><br><br>
                            Mobile Number:
                            <span style="color: #00008B;"><?php echo $patient_data['MOBILE_NUMBER']; ?></span><br><br>
                            Gender:
                            <span style="color:#00008B;"><?php echo $patient_data['Gender']; ?></span><br><br>
                            Blood Group:
                            <span style="color: #00008B;"><?php echo $patient_data['BLOOD_GROUP']; ?></span><br><br>
                            Occupation:
                            <span style="color: #00008B;"><?php echo $patient_data['OCCUPATION']; ?></span><br><br>
                        </h2>
                    </div>
                    <?php
                    } else {
                        echo "<h2 style='color: #ff4444; text-align: center;'>No patient data found</h2>";
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script src="patientscript.js"></script>
</body>
</html>
