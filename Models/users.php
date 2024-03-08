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

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });
    </script>
</head>
<body>
    <h1>Users</h1>
    <table id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php if ($role != 1): ?>
        <h2>Edit User</h2>
        <form action="update_users.php" id="userForm" method="POST">
            <input type="hidden" id="userId" name="userId">
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email"><br>
            <label for="role">Role:</label><br>
            <input type="text" id="role" name="role"><br>
            <button type="submit">Save</button>
            <button id="clear">Clear</button>
            <button id="delete" name="delete">Delete</button>
        </form>
    <?php endif; ?>

</body>
</html>
