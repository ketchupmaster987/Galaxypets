<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GalaxyPets - Your Space Adventure Begins!</title>
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="../Assets/css/gamesstyle.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
session_start();

?>
<header>
    <div id="navbar-container"></div>
     <h1>Welcome, <?php echo htmlspecialchars('username'); ?>!</h1>
    <p>Your current points: <strong><?php echo htmlspecialchars('points'); ?></strong></p>
</header>

<marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<main>
    <div class="grid-container">
        <section class="newspaper">
            <h2>2048</h2>
            <figure>
                <a href="Games/2048Game.php"><img src="../Assets/img/glorbus/lightpurple.png" alt="lilac glorbus"></a>
                <figcaption>featured: lilac glorbus</figcaption>
            </figure>
        </section>

        <section class="newspaper">
            <h2>Matching</h2>
            <figure>
                <a href="Games/matching.php"><img src="../Assets/img/jelly/sleepy/blue.png" alt="blue jelly"></a>
                <figcaption>featured: blue stardust jelly</figcaption>
            </figure>
        </section>

        <section class="newspaper">
            <h2>flappyalien</h2>
            <figure>
                <a href="Games/flappyalien.php"><img src="../Assets/img/jelly/ouch/pink.png" alt="pink jelly"></a>
                <figcaption>featured: pink stardust jelly</figcaption>
            </figure>
        </section>
        <section class="newspaper">
            <h2>snake</h2>
            <figure>
                <a href="Games/snake.php"><img src="../Assets/img/glorbus/sleepy/green.png" alt="green glorbus"></a>
                <figcaption>featured: green sleepy glorbus</figcaption>
            </figure>
        </section>
        <section class="newspaper">
            <h2>Connect 4</h2>
            <figure>
                <a href="Games/C4/index.html"><img src="../Assets/img/glorbus/darkpurple.png" alt="purple glorbus"></a>
                <figcaption>featured: purple glorbus</figcaption>
            </figure>
        </section>
    </div>
</main>

<marquee behavior=scroll direction="right" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<footer class="d-flex flex-wrap justify-content-between align-items-center border-top footer fixed-bottom">
    <p class="col-md-4 mb-0 text-body-secondary">&copy; 2025 GalaxyPets</p>
    <ul class="d-flex align-items-center list-unstyled m-0 ml-auto">
        <li>
            <a class="text-body-secondary"
               href="../README.md">About Us</a></li>
        <li>
            <a class="text-body-secondary"
               href="#">Official Site</a></li>
    </ul>
</footer>

<script src="../Assets/js/navbar.js"></script>

</body>
</html>
