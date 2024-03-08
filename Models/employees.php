<?php include('header.php');
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logistics";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all employees from the database
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#employeesTable').DataTable();
        });
    </script>
</head>
<body>
    <h1>Employees</h1>
    <table id="employeesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Office</th>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["office"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["position"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No employees found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Edit Employee</h2>
    <form action="update_employee.php" id="employeeForm" method="POST">
        <input type="hidden" id="employeeId" name="employeeId">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="office">Office:</label><br>
        <input type="text" id="office" name="office"><br>
        <label for="position">Position:</label><br>
        <input type="text" id="position" name="position"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <button type="submit">Save</button>
        <button id="clear">Clear</button>
        <button id="delete" name="delete">Delete</button>

    </form>
</body>
</html>
