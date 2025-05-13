<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Snake</title>

    <link rel="stylesheet" href="../../Assets/css/snake.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<header>
    <?php
    session_start();

    if (!isset($_SESSION['username'])){
        //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
        header("location: /../login.php");
    }

    
    ?>

    <div id="navbar-container"></div>
     <h1>Welcome, <?php echo htmlspecialchars('username'); ?>!</h1>
    <p>Your current points: <strong><?php echo htmlspecialchars('points'); ?></strong></p>
</header>

<main>
    <div id="game-area">
        <div class="game-info">
            <h1>CYBER SNAKE!</h1>
            <p>Use the 'Arrow Keys' to move around and eat the planets</p>
        </div>
        <canvas width="400" height="400" id="game"></canvas>
    </div>
</main>

<script src="../../Assets/js/snake.js"></script>
<script src="../../Assets/js/navbar.js"></script>
</body>
</html>