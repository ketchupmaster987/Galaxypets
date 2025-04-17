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


    if (!isset($_SESSION['username'])) {
        //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
        header("location: /../login.php");
    }
    ?>
    <div id="navbar-container"></div>
</header>

<main>
    <section class="pet-profile">
        <?php

        require_once '../config.php';

        $sql1 = "SELECT latestDate, prevDate FROM latestLogin WHERE username='" . $_SESSION['username'] . "'";

        $result_date = mysqli_query($link, $sql1);

        if ($result_date->num_rows > 0) {

            $row_date = $result_date->fetch_assoc();

            //echo $row_date['prevDate'];

            $time_away = ($row_date['prevDate'] -$row_date['date'])/86400;
            
            echo $time_away;

            $sql2 = "UPDATE pets SET expression='regular' WHERE username='" . $_SESSION['username'] . "'";

            if($time_away >= 3)
            {
                $sql2 = "UPDATE pets SET expression='sleepy' WHERE username='" . $_SESSION['username'] . "'";

            }
            if($time_away >= 7)
            {
                $sql2 = "UPDATE pets SET expression='asleep' WHERE username='" . $_SESSION['username'] . "'";

            }
            if($time_away >= 14)
            {
                $sql2 = "UPDATE pets SET expression='ouch' WHERE username='" . $_SESSION['username'] . "'";
            }

            $result2 = mysqli_query($link, $sql2);

        }

        $sql3 = "SELECT petname, species, color, expression, planet, birthday FROM pets WHERE username='" . $_SESSION['username'] . "'";

        $result = mysqli_query($link, $sql3);

        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();

            echo "<h1>" . $_SESSION['username'] . "'s MyGalaxyPet Profile</h1>";
            echo '<div class="pet-info">
                                <div class="pet-image">
                                    <div class="alien-container">
                                        <img id="alienImage" class="alien-image" src="../Assets/img/' . $row["species"] . '/' . $row["expression"] . '/' . $row["color"] . '.png" alt="Image of your Pet">
                                    </div>';


            echo "<script>
                                        const alienImage = document.getElementById('alienImage');
                                        const colorCircles = document.querySelectorAll('.color-circle');

                                        colorCircles.forEach(circle => {
                                            circle.addEventListener('click', () => {
                                                const selectedColor = circle.getAttribute('data-color');
                                                alienImage.src = `/Assets/img/jelly/" . $row["expression"] . "/" . $row["color"] . ".png`;
                                            });
                                        });
                                    </script>
                                </div>";
            echo '<div class="pet-details">';


            echo "<h2>" . $row['petname'] . "</h2>";
            echo '<ul>
                            <li><strong>Species:</strong>' . $row["species"] . '</li>
                            <li><strong>Color:</strong>' . $row["color"] . '</li>
                            <li><strong>Home Planet:</strong>' . $row["planet"] . '</li>
                            <li><strong>Birthday:</strong>' . $row["birthday"] . '</li>
                        </ul>';
            echo '<blockquote>
                            "i ammm starvinggg for planet pointsss"
                        </blockquote>';
            echo '</div>';

            $result = mysqli_next_result($link);
        } else {
            echo "You have no pets. Adopt one <a href = 'adopt.php'>HERE</a>";
        }


        ?>
    </section>
</main>

<a href="/../logout.php">Logout</a>
<script src="../Assets/js/navbar.js"></script>
</body>
</html>
