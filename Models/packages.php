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
if($role == 1){
    // Fetch all packages from the database
    $sql = "SELECT * FROM packages where sender_id = $userId";    
}
else{
    // Fetch all packages from the database
    $sql = "SELECT * FROM packages";
}
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
         $(document).ready(function() {
            $('#packagesTable').DataTable();
        });
    </script>
</head>
<body>
    <h1>Packages</h1>
    <table id="packagesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sender ID</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Address</th>
                <th>Delivery Type</th>
                <th>Weight</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["sender_id"] . "</td>";
                    echo "<td>" . $row["sender"] . "</td>";
                    echo "<td>" . $row["receiver"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["delivery_type"] . "</td>";
                    echo "<td>" . $row["weight"] . "</td>";
                    echo "<td>" . $row["timestamp"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No packages found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php if ($role != 1): ?>
        <h2>Edit Package</h2>
    <form action="update_package.php" id="packageForm" method="POST">

        <input type="hidden" id="id" name="id">    
        <label for="senderId">Sender ID:</label><br>
        <input type="text" id="senderId" name="senderId"><br>
        <label for="sender">Sender:</label><br>
        <input type="text" id="sender" name="sender"><br>
        <label for="receiver">Receiver:</label><br>
        <input type="text" id="receiver" name="receiver"><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br>
        <label for="delivery_type">Delivery Type:</label><br>
        <input type="text" id="delivery_type" name="delivery_type"><br>
        <label for="weight">Weight:</label><br>
        <input type="text" id="weight" name="weight"><br>
        <button type="submit" id="save">Save</button>
        <button id="clear">Clear</button>
        <button id="delete" name="delete">Delete</button>
    </form>
       
        <?php endif; ?>
    
</body>
</html>
