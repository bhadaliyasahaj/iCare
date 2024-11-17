<?php
// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $pass = $_POST["pass"]; // Changed variable name

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

    // Prepare SQL statement to check if email and password match
    $sql = "SELECT * FROM userdetails WHERE email = ? AND pass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $pass); // Changed variable name

    // Execute the prepared statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if there is a matching user
    if ($result->num_rows > 0) {
        $_SESSION["email"] = $email;
        http_response_code(200);
        exit;
    } else {
        http_response_code(401); 
        exit("Invalid email or password."); // This message will be displayed in the alert
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
