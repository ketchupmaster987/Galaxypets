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
                    <a href="clubs.php">Clubs</a>
                    <a href="petprofile.php">Users</a>
                </div>
            </li>
            <li><a href="games.php">Games</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="/../logout.php">Log Out</a></li>
        </ul>
    </nav>
     <h1>Welcome, <?php echo htmlspecialchars('username'); ?>!</h1>
    <p>Your current points: <strong><?php echo htmlspecialchars('points'); ?></strong></p>
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

                /* setInterval (function showPreview() {

                    var species = document.getElementById('species').value;
                    
                    var color = document.getElementById('color').value;
                    
                    document.getElementById('pet').innerHTML = '<img src="../Assets/img/' + species + '/regular/' + color + '.png" width="300px" height="300px">';
                }, 0.01 * 1000 );*/
                setInterval(function showPreview() {
                var species = document.getElementById('species').value;
                var color = document.getElementById('color').value;

                // Set pet image
            document.getElementById('pet').innerHTML = '<img src="../Assets/img/' + species + '/regular/' + color + '.png" width="300px" height="300px">';

                // Set description
                var descriptionText = "";
                if (species === "glorbus") {
                    descriptionText = "Glorbus: A cheerful space blob that feeds on cosmic dust.";
                } else if (species === "jelly") {
                    descriptionText = "Jelly: A translucent jellyfish-like creature that floats through galaxies.";
                }

    document.getElementById('description').innerText = descriptionText;

}, 100); // Still updates every 0.1 second
//says i need to make a html? w this info on it >:///
            </script>
            <div id="pet"></div>
            <div id="description" style="margin-top: 1em; font-style: italic;"></div>


            <form action="adoption.php" method="GET">
                <fieldset>
                    <legend>Create Your Pet</legend>
                    <br>
                    
                    Name:<br>
                        <input type='text' value="name" id="name" name="name">
                        <br>
                        <br>
                    Species:<br>
                        <select name="species" id="species">
                            <option value="glorbus">Glorbus</option>
                            <option value="jelly">Jelly</option>
                        </select>
                        <br>

                        

                    Color:<br>
                        <select name="color" id="color">
                            
                            <option value="green">Green</option>
                            <option value="blue">Blue</option>
                            <option value="lightpurple">Light Purple</option>
                            <option value="darkpurple">Dark Purple</option>
                            <option value="pink">Pink</option>
                            
                        </select>
                        <br>
                        <br>
                    Planet:<br>
                        <input type='text' value="planet" id="planet" name="planet">
                        <br>
                        <br>
                </fieldset>
                <br>
                <?php 
                if (isset($_SESSION['username'])){
                    echo '<input type="submit" value="Adopt!">';
                    echo ' ';
                    echo '<input type="reset" value="Reset Form">';
                } else {
                    echo '<a href="../login.php">';
                        echo '<div id="login-message">';
                            echo "Log in to adopt a pet";
                        echo '</div>';
                    echo '</a>';
                }
                ?>
            </form>
        </div>
			<br>
            <!--Or, if zcdscdscszccdyou want to order for someone else <br> but don't know how they want their dragon, <br>why not get a <a href="orderGiftCard.php">gift card</a>?-->
	</div>
</main>
</div>



</body>
</html>