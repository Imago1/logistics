<?php 
include('header.php');

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

// Fetch company data from the database
$sql = "SELECT * FROM companies WHERE id = 1";
$stmt = $conn->prepare($sql);
//$stmt->bind_param("i", $_GET['company_id']); // Assuming you're passing the company ID via URL parameter
//$stmt->bind_param("i", 1); // Assuming you're passing the company ID via URL parameter
$stmt->execute();
$result = $stmt->get_result();
$company = $result->fetch_assoc();

// Check if company exists
if (!$company) {
    echo "Company not found.";
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $industry = $_POST['industry'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $description = $_POST['description'];
    $founded_date = $_POST['founded_date'];
    $logo = $_POST['logo']; // You may want to handle file upload for the logo

    // Update company data in the database
    $sql = "UPDATE companies SET name=?, industry=?, address=?, city=?, country=?, email=?, phone=?, website=?, description=?, founded_date=?, logo=? WHERE id=1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $name, $industry, $address, $city, $country, $email, $phone, $website, $description, $founded_date, $logo);
    $stmt->execute();

    // Redirect to company details page after updating
    header("Location: company.php");
    exit();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>
</head>
<body class="p-3 m-0 border-0 bd-example">
    <h1>Edit Company</h1>
    <form method="post">
        <div class="mb-3">

        <label class="form-label" for="name">Name:</label><br>
        <input class="form-control" type="text" id="name" name="name" value="<?php echo $company['name']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="industry">Industry:</label><br>
        <input class="form-control" type="text" id="industry" name="industry" value="<?php echo $company['industry']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="address">Address:</label><br>
        <input class="form-control" type="text" id="address" name="address" value="<?php echo $company['address']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="city">City:</label><br>
        <input class="form-control" type="text" id="city" name="city" value="<?php echo $company['city']; ?>"><br>
        </div>
        <div class="mb-3">


        <label class="form-label" for="country">Country:</label><br>
        <input class="form-control" type="text" id="country" name="country" value="<?php echo $company['country']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="email">Email:</label><br>
        <input class="form-control" type="email" id="email" name="email" value="<?php echo $company['email']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="phone">Phone:</label><br>
        <input class="form-control" type="text" id="phone" name="phone" value="<?php echo $company['phone']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="website">Website:</label><br>
        <input class="form-control" type="text" id="website" name="website" value="<?php echo $company['website']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $company['description']; ?></textarea><br>
        </div><div class="mb-3">


        <label class="form-label" for="founded_date">Founded Date:</label><br>
        <input class="form-control" type="date" id="founded_date" name="founded_date" value="<?php echo $company['founded_date']; ?>"><br>
        </div><div class="mb-3">


        <label class="form-label" for="logo">Logo:</label><br>
        <input class="form-control" type="text" id="logo" name="logo" value="<?php echo $company['logo']; ?>"><br>
        </div><div class="mb-3">


        <input class="btn btn-primary" type="submit" value="Save">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
