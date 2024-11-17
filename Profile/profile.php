<?php
// Start a session
session_start();

// Check if the user is logged in
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

// Fetch user profile data from database based on email
$sql = "SELECT * FROM userdetails WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of the user profile details
    $row = $result->fetch_assoc();
    $full_name = $row["fullname"];
    $dob = $row["dob"];
    $mobile = $row["mobile"];
    $age = $row["age"];
    $plan_name = $row["plan_name"];
    $plan_validity = $row["payment_validity"];
    $plan_expiry = $row["payment_date"];
} else {
    // echo "0 results";
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iCare - Profile</title>
    <link rel="stylesheet" href="SASS/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
    <header>
        <nav>
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="yogalogo.png" alt="Web Logo">
                </div>
                <div class="alltabs" id="navmenu">
                    <ul>
                        <a href="../Home/index.html">
                            <li>HOME</li>
                        </a>
                        <a href="../TypesofYoga/typeof.html">
                            <li>CLASSES</li>
                        </a>
                        <a href="/Blogs/blog.html">
                            <li>BLOG</li>
                        </a>
                        <a href="../Contact/contact.html">
                            <li>CONTACT US</li>
                        </a>
                    </ul>
                    <div class="loginwithtrial">
                        <div class="loginandtrialbtn" id="logintrialBtn">
                            <a href="../Login/login.html">
                                <li>LOG IN</li>
                            </a>
                            <a href="../Register/register.html">
                                <li>REGISTER</li>
                            </a>
                        </div>
                        <i class="fa-regular fa-user" id="profileBtn"></i>
                    </div>
                </div>
                <div class="nav-hamburger">
                    <li id="burger"><i class="fa-solid fa-bars"></i></li>
                </div>
            </div>
        </nav>
    </header>
    <div class="mainContainer">
        <div class="firstContainer">
            <div class="centerFirst">
                <h2>Your Information</h2>
                <p><strong>Full Name:</strong>
                    <?php echo isset($full_name) ? $full_name : '--'; ?>
                </p>
                <p><strong>Email :</strong>
                    <?php echo isset($email) ? $email : '--'; ?>
                </p>
                <p><strong>Mobile :</strong>
                    <?php echo isset($mobile) ? $mobile : '--'; ?>
                </p>
                <p><strong>Date of Birth :</strong>
                    <?php echo isset($dob) ? $dob : '--'; ?>
                </p>
                <p><strong>Age :</strong>
                    <?php echo isset($age) ? $age : '--'; ?>
                </p>
                <p><strong>Plan Name :</strong>
                    <?php echo isset($plan_name) ? $plan_name : '--'; ?>
                </p>
                <p><strong>Plan Validity :</strong>
                    <?php echo isset($plan_validity) ? $plan_validity : '--'; ?>
                </p>
                <p><strong>Plan Expires On :</strong>
                    <?php echo isset($plan_expiry) ? $plan_expiry : '--'; ?>
                </p>
                <form action="logout.php">
                    <button type="submit" id="logout">LOG OUT</button>
                </form>
            </div>
        </div>
        <div class="secondContainer" id="secondContainer">
            <div class="profile-form">
                <h2>Update Your Profile</h2>
                <form action="updateprofile.php" method="post" id="updateProfile">
                    <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="tel" id="mobile" name="mobile" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" required>
                    </div>
                    <button type="submit">UPDATE PROFILE</button>
                </form>
                <button id="changeMail">CHANGE EMAIL AND PASSWORD</button>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="profile.js"></script>
</body>
</html>