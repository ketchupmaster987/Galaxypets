<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./../../Assets/js/2048.js"></script>

    <title>2048</title>

    <link rel="stylesheet" href="../../Assets/css/2048Style.css">
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

    require_once './config.php';

    $points = $_SESSION['points'];
    $username = $_SESSION['username'];
    $stmt = $link->prepare("Update points set points = points + ? where username = ?");
    $stmt->bind_param("iis", $points, $username); // iis = int, int, string
    $stmt->execute(); // Execute the query
    ?>
    
    <div id="navbar-container"></div>
</header>

<main>
    <div class="main">
        <div class="game-info">
            <h1>2048</h1>
            <br>
            <h2>Score: <span id="score">0</span></h2>
        </div>

        <div id="board" class="container"></div>

        <div class="game-controls">
            <p>Use the 'Arrow Keys' to move<br> the planets from side to side</p>
        </div>
    </div>
    <button onclick="">
</main>

<script src="../../Assets/js/navbar.js"></script>
</body>
</html> 