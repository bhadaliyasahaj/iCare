<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    // Redirect to login page or show a message
    header("Location: login.php");
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
$old_password = $_POST["oldpassword"];
$new_email = $_POST["newemail"];
$new_password = $_POST["newpassword"];

// Check if the old password matches the one stored in the database
$sql = "SELECT * FROM userdetails WHERE email = ? AND pass = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $old_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Old password matches, proceed with updating email and password
    // Prepare SQL statement to update user email and password
    $update_sql = "UPDATE userdetails SET email=?, pass=? WHERE email=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sss", $new_email, $new_password, $email);

    // Execute the prepared statement to update email and password
    if ($update_stmt->execute()) {
        // Redirect to profile page or show a success message
        header("Location: /Login/login.html");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $update_stmt->close();
} else {
    // Old password doesn't match, show error message or redirect back to form with error
    echo "Old password does not match.";
}

$stmt->close();
$conn->close();
?>
