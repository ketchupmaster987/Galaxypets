<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Flappy Alien</title>
    <link rel="stylesheet" href="../../Assets/css/flappyalien.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<header>
    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
        //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
        header("location: /../login.php");
    }
    
    ?>

    <div id="navbar-container"></div>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Your current points: <strong><?php echo $user_points; ?></strong></p>
</header>

<main>
    <div class="game-area">
        <canvas id="gameCanvas"></canvas>
        <div class="game-info">
            <p>Use the ACCELERATE button to push your rocket into space</p>
            <p>How long can you stay alive?</p>
            <button onmousedown="accelerate(-0.2)" onmouseup="accelerate(0.05)">ACCELERATE</button>
        </div>
    </div>
    <div id="gameOver">
        <h2>Game Over!</h2>
        <p>Score: <span id="finalScore">0</span></p>
        <button onclick="resetGame()">Play Again</button>
    </div>
</main>

<script src="../../Assets/js/flappyalien.js"></script>
<script src="../../Assets/js/navbar.js"></script>
</body>
</html>
