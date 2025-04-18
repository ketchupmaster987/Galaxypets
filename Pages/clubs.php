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
    <?php
        session_start();
    ?>
<header class="border-bottom sticky-top">
    <nav class="navbar navbar-expand-lg d-flex align-items-center">
        <div class="logo"><a href="../index.php" style="text-decoration: none;">GalaxyPets</a></div>
        <ul class="d-flex align-items-center list-unstyled m-0 ml-auto" style="margin-left: auto;">
            <li class="dropdown nav-item">
                <a href="petprofile.php">Your Pet/Profile</a>
                <div class="dropdown-content">
                    <a href="petprofile.php">My GalaxyPet</a>
                    <a href="#">Closet</a>
                    <a href="#">Settings</a>
                </div>
            </li>
            <li class="dropdown nav-item">
                <a href="clubs.php">Community</a>
                <div class="dropdown-content">
                    <a href="clubs.php">Clubs</a>
                    <a href="#">Users</a>
                </div>
            </li>
            <li class="nav-item"><a href="games.php">Games</a></li>
            <li class="nav-item"><a href="#">Shop</a></li>
        </ul>
    </nav>
</header>

<marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<main>
    <section class="planet-grid" aria-label="Club Planets">
        <!-- The js fills this in with the links to the planets,  the json is editable there -->
    </section>
</main>

<marquee  behavior=scroll direction="right" scrollamount="5" style="color: #17ffee;">
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</html>
