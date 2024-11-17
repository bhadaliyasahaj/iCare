<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    // Redirect the user to the login page if not logged in
    // http_response_code(405);
    header("Location: /Login/login.html");
    // echo"<script>alert('enter email')</script>";

    exit;
}

// Retrieve email from session
$email = $_SESSION["email"];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set timezone
date_default_timezone_set('Asia/Kolkata');

$selectedPlan = $_POST['selectedPlan'];
$paymentAmount = $_POST['paymentAmount'];
$planValidity = $_POST['planValidity'];
$planInsert = $_POST['planInsert'];
// Get current date and time
$currentDateTime = date("Y-m-d H:i:s");
$expiry = date("Y-m-d",strtotime($planInsert));
// Retrieve plan and payment information from the POST parameters

// Prepare and bind SQL statement
$sql = "UPDATE userdetails SET plan_name=?, payment_amount=?, payment_validity=?, payment_date=? WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $selectedPlan, $paymentAmount, $planValidity, $currentDateTime, $email);

// Execute the prepared statement
if ($stmt->execute()) {
    // Redirect to profile page or show a success message
    header("Location: ../TypesofYoga/typeof.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
