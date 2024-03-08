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
    $packageId = $_POST['id'];
    $senderId = $_POST['senderId'];
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $address = $_POST['address'];
    $deliveryType = $_POST['delivery_type'];
    $weight = $_POST['weight'];

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logistics";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update or insert package data based on whether packageId is provided
    if ($packageId) {
        
        if(isset($_POST['delete'])){
            // Delete existing package
            $sql = "DELETE from packages WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $packageId);
            $stmt->execute();
        } else {
            // Update existing package
            $stmt = $conn->prepare("UPDATE packages SET sender_id=?, sender=?, receiver=?, address=?, delivery_type=?, weight=? WHERE id=?");
            $stmt->bind_param("issssdi", $senderId, $sender, $receiver, $address, $deliveryType, $weight, $packageId);
            $stmt->execute();
        }
    } else if ($senderId != "" && $sender != "" && $receiver != "" && $address != "" && $deliveryType != "" && $weight != "") {
        // Insert new package
        $sql = "INSERT INTO packages (sender_id, sender, receiver, address, delivery_type, weight) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssd", $senderId, $sender, $receiver, $address, $deliveryType, $weight);
        $stmt->execute();
    }

    // Close statement and connection
    $conn->close();

    // Redirect back to packages page
    header("Location: packages.php");
} else {
    // Redirect back to packages page if no form data received
    header("Location: packages.php");
}
?>
