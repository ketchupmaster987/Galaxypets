<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGalaxyPet Profile - GalaxyPets</title>
    <link rel="stylesheet" href="../Assets/css/profilestyle.css">
</head>
<body>
    <?php 
session_start();
?>
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
    <section class="pet-profile">
            <?php

                require_once '../config.php';

                $sql = "SELECT petname, species, color, expression, planet, birthday FROM pets WHERE username='".$_SESSION['username']."'";
            
                $result = mysqli_query($link, $sql);

                if ($result->num_rows > 0) {
                  // output data of each row
                    $row = $result->fetch_assoc();

                    echo "<h1>".$_SESSION['username']."'s MyGalaxyPet Profile</h1>";
                        echo '<div class="pet-info">
                                <div class="pet-image">
                                    <div class="alien-container">
                                        <img id="alienImage" class="alien-image" src="../Assets/img/'.$row["species"].'/'.$row["expression"].'/'.$row["color"].'.png" alt="Image of your Pet">
                                    </div>';
                                    

                            echo "<script>
                                        const alienImage = document.getElementById('alienImage');
                                        const colorCircles = document.querySelectorAll('.color-circle');

                                        colorCircles.forEach(circle => {
                                            circle.addEventListener('click', () => {
                                                const selectedColor = circle.getAttribute('data-color');
                                                alienImage.src = `/Assets/img/jelly/".$row["expression"]."/".$row["color"].".png`;
                                            });
                                        });
                                    </script>
                                </div>";
                    echo '<div class="pet-details">';


                        echo "<h2>".$row['petname']."</h2>";
                        echo'<ul>
                            <li><strong>Species:</strong>'.$row["species"].'</li>
                            <li><strong>Color:</strong>'.$row["color"].'</li>
                            <li><strong>Home Planet:</strong>'.$row["planet"].'</li>
                            <li><strong>Birthday:</strong>'.$row["birthday"].'</li>
                        </ul>';
                        echo '<blockquote>
                            "i ammm starvinggg for planet pointsss"
                        </blockquote>';
                    echo '</div>';
                } else {
                  echo "You have no pets. Adopt one <a href = 'adopt.php'>HERE</a>";
                }

            
            ?>
        </div>


    </section>
</main>

<a href="/../logout.php">Logout</a>

</body>
</html>
