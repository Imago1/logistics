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
    $officeId = $_POST['officeId'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $companyId = 1;
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

    // Update or insert office data based on whether officeId is provided
    if ($officeId) {
        if($delete){
            $sql = "DELETE from offices WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $officeId);
            $stmt->execute();            
        }
        else{

        // Update existing office
        $stmt = $conn->prepare("UPDATE offices SET name=?, address=?, city=?, country=?, phone=?, email=? WHERE id=?");
        $stmt->bind_param("ssssssi", $name, $address, $city, $country, $phone, $email, $officeId);
        $stmt->execute();
        }

    } else if ($companyId != "" && $name != "" && $address != "" && $city != "" && $country != "" && $phone != "" && $email != "") {
        // Insert new office
        $sql = "INSERT INTO offices (company_id, name, address, city, country, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $companyId, $name, $address, $city, $country, $phone, $email);
        $stmt->execute();
    }
    
    else{
        $conn->close();
        header("Location: offices.php");
    }


    // Close statement and connection
    $stmt->close();
    $conn->close();
    header("Location: offices.php");
}
