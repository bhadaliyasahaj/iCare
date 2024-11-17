<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    // Redirect to login page or show a message
    header("Location: /Login/login.html");
    exit;
}

// Fetch user's email from session
$email = $_SESSION["email"];

// Database connection
$servername = "localhost"; // Change this to your MySQL server address
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "users"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST["full-name"];
$dob = $_POST["dob"];
$mobile = $_POST["mobile"];
$age = $_POST["age"];

// Prepare SQL statement to update user profile data
$sql = "UPDATE userdetails SET fullname=?, dob=?, mobile=?, age=? WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $full_name, $dob, $mobile, $age, $email);

// Execute the prepared statement
if ($stmt->execute()) {
    // Redirect to profile page or show a success message
    header("Location: profile.php");
    exit;
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
