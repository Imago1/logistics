<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_POST['userId'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $delete = isset($_POST['delete']);
    
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logistics";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update or insert user data based on whether userId is provided
    if ($userId) {
        if($delete){
            $sql = "DELETE FROM users WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();            
        }
        else{
            // Update existing user
            $sql = "UPDATE users SET email=?, role=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $email, $role, $userId);
            $stmt->execute();
        }
    } else {
        // Insert new user
        $sql = "INSERT INTO users (email, role) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $email, $role);
        $stmt->execute();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
    header("Location: users.php");
}
