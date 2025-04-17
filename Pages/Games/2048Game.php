<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../../../Assets/js/2048.js"></script>

    <title>2048</title>

    <link rel="stylesheet" href="../../../Assets/css/2048Style.css">
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
    <nav>
        <div class="logo"><a href="/../index.php" style="text-decoration: none;">GalaxyPets</a></div>
        <ul>
            <li><a href="/../index.php">Back to Home</a></li>
            <li class="dropdown">
                Community
                <div class="dropdown-content">
                    <a href="/../Pages/clubs.php">Clubs</a>
                    <a href="/../Pages/activeusers.php">Users</a>
                </div>
            </li>
            <li><a href="/../Pages/games.php">Games</a></li>
            <li><a href="/../Pages/shop.php">Shop</a></li>
            <li><a href="/../logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>
<div id="container">

    <h1>2048</h1>
    <hr>
    <h2>Score: <span id="score">0</span></h2>
    <div id="board">
    </div>
</div>

</body>
</html> 