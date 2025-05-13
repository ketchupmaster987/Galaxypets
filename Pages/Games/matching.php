<!DOCTYPE HTML>
<HTML lang="en">
<Head>
    <meta charset="utf-8">
    <title>Memory game</title>

    <link rel="stylesheet" href="../../Assets/css/matching.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</Head>
<body>
<header>
    <?php
        session_start();

        if (!isset($_SESSION['username'])){
            //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
            header("location: /../login.php");
        }
        $username = $_SESSION['username'];

// Fetch the user's points
$stmt = $link->prepare("SELECT points FROM points WHERE user = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($user_points);
$stmt->fetch();
$stmt->close();
    ?>

    <div id="navbar-container"></div>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Your current points: <strong><?php echo $user_points; ?></strong></p>
</header>

<main>
    <div id="game-area">
        <div id='grid'></div>
        <div class="game-info">
            <h1>Matching Game</h1>
            <h2>Score: <span id='score'>0</span></h2>
            <p>Match all the cards to gain planet points!</p>
        </div>
    </div>
</main>

<script src="../../Assets/js/matching.js"></script>
<script src="../../Assets/js/navbar.js"></script>
</body>
</HTML>