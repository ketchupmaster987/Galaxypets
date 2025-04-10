<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGalaxyPet Profile - GalaxyPets</title>
    <link rel="stylesheet" href="../Assets/css/profilestyle.css">
</head>

<?php 
session_start();
?>


<body>

<div>
<header>
    <?php

    
    if (!isset($_SESSION['username'])){
        //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
        header("location: /../login.php");
    }
    ?>
    <nav>
        <div class="logo"><a href="../index.php" style="text-decoration: none;">GalaxyPets</a></div>
        <ul>
            <li><a href="../index.php">Back to Home</a></li>
            <li class="dropdown">
                Community
                <div class="dropdown-content">
                    <a href="clubs.html">Clubs</a>
                    <a href="#">Users</a>
                </div>
            </li>
            <li><a href="games.html">Games</a></li>
            <li><a href="shop.html">Shop</a></li>
            <li><a href="/../logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>
<main>
	<br>
	<div>
		<h2> Adopt a Pet </h2>
        <div id="petPreview">
            <div id="PreviewHeader">
            Pet Preview:
            </div>
            <script type="text/javascript">

                setInterval (function showPreview() {

                    var species = document.getElementById('species').value;
                    
                    var color = document.getElementById('color').value;
                    
                    document.getElementById('pet').innerHTML = '<img src="../Assets/img/' + species + '/regular/' + color + '.png">';
                    
                    
                }, 0.01 * 1000 );
            </script>
            <div id="pet">
            </div>
            
        </div>
			<br>
            <!--Or, if you want to order for someone else <br> but don't know how they want their dragon, <br>why not get a <a href="orderGiftCard.php">gift card</a>?-->
	</div>
</main>
</div>

<?php
	
	require_once '../config.php';

	$username = $_SESSION['username'];
	$species = $_POST['species'];
	$color = $_POST['color'];
	$planet = $_POST['planet']


	$sql = "INSERT INTO pets (username, species, color, planet) VALUES ('$username', '$species', '$color', '$planet')";

	mysqli_query($link,$sql);

	
?>

</body>
</html>