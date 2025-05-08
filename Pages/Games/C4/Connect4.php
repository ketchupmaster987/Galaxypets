/////this was mt before, idk if i need this it just lookd repeated in the other php files


<HTML lang="en">


<Head>
    <meta charset="utf-8">
    <title>Memory game</title>

    <link rel="stylesheet" href="../../../Assets/css/matching.css">
    <link rel="stylesheet" href="../../../Assets/css/style.css">

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
    ?>

    <div id="navbar-container"></div>
</header>
</body>
<script src="../../../Assets/js/navbar.js"></script>
</HTML>