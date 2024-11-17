<?php
function validatePassword($password) {
    $min_length = 8;
    $max_length = 20;
    $has_lowercase = preg_match("/[a-z]/", $password);
    $has_uppercase = preg_match("/[A-Z]/", $password);
    $has_number = preg_match("/[0-9]/", $password);
    $has_special_char = preg_match("/[!@#$%^&*()-_=+{};:,<.>]/", $password);

    if (strlen($password) < $min_length || strlen($password) > $max_length ||
        !$has_lowercase || !$has_uppercase || !$has_number || !$has_special_char) {
        return false;
    }
    
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $pass = $_POST["password"]; 

    if (!validatePassword($pass)) {
        echo "<script>alert('Password must be between 8 and 20 characters long and include at least one lowercase letter, one uppercase letter, one number, and one special character.')</script>";
        header("Location: /Register/register.html");
        exit;
    }

    $servername = "localhost"; 
    $username = "root";
    $password = ""; 
    $dbname = "users";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $check_email_query = "SELECT * FROM userdetails WHERE email=?";
    $stmt_check_email = $conn->prepare($check_email_query);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result = $stmt_check_email->get_result();
    if ($result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
        header("Location: /Register/register.html");
        exit;
    }

    $sql = "INSERT INTO userdetails (fullname, email, pass) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fullname, $email, $pass); 

    if ($stmt->execute()) {
        header("Location: ../Login/login.html"); 
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
