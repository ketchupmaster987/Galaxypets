<?php
session_start();

if (!isset($_SESSION['username'])) {
    //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
    header("location: /../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GalaxyPets - Your Space Adventure Begins!</title>
    <link rel="stylesheet" href="../Assets/css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<header class="border-bottom sticky-top">
    <div id="navbar-container"></div>
    <h1>Welcome, <?php echo htmlspecialchars('username'); ?>!</h1>
    <p>Your current points: <strong><?php echo htmlspecialchars('points'); ?></strong></p>
</header>

<marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<main>
    <section class="planet-grid" aria-label="Club Planets">
        <!-- The js fills this in with the links to the planets,  the json is editable there -->
    </section>
</main>

<marquee behavior=scroll direction="right" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<footer class="d-flex flex-wrap justify-content-between align-items-center border-top footer fixed-bottom">
    <p class="col-md-4 mb-0 text-body-secondary">&copy; 2025 GalaxyPets</p>
    <ul class="d-flex align-items-center list-unstyled m-0 ml-auto">
        <li>
            <a class="text-body-secondary"
               href="../about.php">About Us</a></li>
        <li>
            <a class="text-body-secondary"
               href="../index.php">Official Site</a></li>
    </ul>
</footer>
</body>

<script src="../Assets/js/clubpage.js"></script>
<script src="../Assets/js/navbar.js"></script>
</html>
