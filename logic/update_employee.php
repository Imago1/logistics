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
    $employeeId = $_POST['employeeId'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $office = $_POST['office'];
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

    // Update or insert employee data based on whether employeeId is provided
    if ($employeeId) {
        if($delete){
            $sql = "DELETE from employees WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $employeeId);
            $stmt->execute();            
        }
        else{
        // Update existing employee
        $sql = "UPDATE employees SET name=?, position=?, email=?, phone=?, office=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $position, $email, $phone, $office, $employeeId);
        $stmt->execute();
        }

    } else if($companyId != "" && $office != "" && $name != "" && $position != "" && $email != "" && $phone != ""){
        // Insert new employee
        $sql = "INSERT INTO employees (company_id, office, name, position, email, phone) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $companyId, $office, $name, $position, $email, $phone);
        $stmt->execute();
        }
    else{
        $conn->close();
        header("Location: employees.php");
    }


    // Close statement and connection
    $stmt->close();
    $conn->close();
    header("Location: employees.php");
}
