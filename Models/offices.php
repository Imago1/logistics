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
$role = $_SESSION['role'];
$userId = $_SESSION['user_id'];
// Fetch all employees from the database
$sql = "SELECT * FROM offices";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offices</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#officesTable').DataTable();
        });
    </script>
</head>
<body>
    <h1>Offices</h1>
    <table id="officesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "<td>" . $row["country"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No offices found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    
    
    <?php if ($role != 1): ?>
        <h2>Edit Office</h2>
    <form action="update_office.php" id="officeForm" method="POST">
        <input type="hidden" id="officeId" name="officeId">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br>

        <label for="city">City:</label><br>
        <input type="text" id="city" name="city"><br>
        <label for="country">Country:</label><br>
        <input type="country" id="country" name="country"><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <button type="submit">Save</button>
        <button id="clear">Clear</button>
        <button id="delete" name="delete">Delete</button>

    </form>
       
        <?php endif; ?>
    



</body>
</html>
