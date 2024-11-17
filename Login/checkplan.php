<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email from the POST request
    $email = $_POST["email"];

    // Connect to MySQL database
    $servername = "localhost"; // Change this if your MySQL server is running on a different host
    $username = "root"; // Default username for MySQL in XAMPP is "root"
    $dbpassword = ""; // Default password for MySQL in XAMPP is empty
    $dbname = "users"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to check if the plan is not null for the user
    $sql = "SELECT plan_name FROM userdetails WHERE email = ? AND plan_name IS NOT NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    // Execute the prepared statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if there is a matching user with a non-null plan
    if ($result->num_rows > 0) {
        // User has purchased a plan
        echo json_encode(array("hasPlan" => true));
    } else {
        // User has not purchased a plan
        echo json_encode(array("hasPlan" => false));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
