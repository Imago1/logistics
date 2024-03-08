<?php
// Start session
session_start();

$error = ""; // Initialize error variable

// Establish database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "logistics"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user from database
    $stmt = $conn->prepare("SELECT id, email, pass, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verify password
        if (password_verify($password, $user['pass'])) {
            // Password is correct, set session variables and redirect user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect user to a dashboard or another page
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $error = "Invalid email or password";
        }
    } else {
        // User not found
        $error = "Invalid email or password";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
