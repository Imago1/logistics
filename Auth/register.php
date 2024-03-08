<?php

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
    // Validate form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // You may add more validation here such as checking if email is valid or if password meets certain criteria

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Set default role
    $role = 1;

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO users (email, pass, role) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $email, $hashed_password, $role);

    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful!";
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
