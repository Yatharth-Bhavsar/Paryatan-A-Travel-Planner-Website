<?php
$localhost = "localhost";
$user = "root";
$password = "Pr@12444";
$dbname = "SL_project";

$conn = new mysqli($localhost, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['myname1'];
    $email = $_POST['myemail'];
    $phoneNo = $_POST['myphone'];
    $age = $_POST['myage'];
    $gender = $_POST['mygender'];
    $package = $_POST['locations'];
    $planning_for = $_POST['planning_for'];
    $terms_accepted = isset($_POST['t&c']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO  registrationform (name, email, phoneNo, age, gender, package, planning_for, t_and_c_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiisssi", $name, $email, $phoneNo, $age, $gender, $package, $planning_for, $terms_accepted);

    if ($stmt->execute()) {
        echo "<script>alert('You\'ve registered successfully');</script>";
        echo "<script>window.location.replace('http://127.0.0.1:5500//firstflight-travels-main/index.html');</script>";
        exit;
    } else {
        echo "Error occurred while registering";
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
