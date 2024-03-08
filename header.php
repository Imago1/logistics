<?php
// Start session
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
    $isLoggedIn = true;
    $client = $_SESSION['role'] == 1;
    $admin = $_SESSION['role'] == 99;
} else {
    // User is not logged in
    $isLoggedIn = false;
}

// Check if logout action is requested
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to index.php to refresh the page
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<link href="assets/dist/css/style.css" rel="stylesheet">
<script src="assets/dist/js/script.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logistics</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
    </li>
    <?php if ($isLoggedIn): ?>
        <?php if (!$client): ?>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="company.php">Company</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="employees.php">Employees</a>
            </li>
            <?php if ($admin): ?>

            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="users.php">Users</a>
            </li>
            <?php endif; ?>
        <?php endif; ?>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="offices.php">Offices</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="packages.php">Packages</a>
    </li>
    <?php endif; ?>
</ul>

      <?php if ($isLoggedIn): ?>
            <p class="greeting">Welcome, <?php echo explode('@', $_SESSION['email'])[0]; ?>!</p>
            <a href="profile.php" class="btn btn-outline-success" id="profile">Profile</a>
            <a href="logout.php" class="btn btn-outline-success" id="logout">Logout</a>
        <?php else: ?>
            <p>You are not logged in.</p>
            <a href="loginpage.php" class="btn btn-outline-success" id="login">Login</a>
            <a href="register.html" class="btn btn-outline-success" id="register">Register</a>
        <?php endif; ?>
     
    </div>
  </div>
</nav>