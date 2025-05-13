<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - GalaxyPets</title>
    <link rel="stylesheet" href="../Assets/css/profilestyle.css">
</head>
<body>
<?php
session_start();
?>
<header>
    <?php
    if (!isset($_SESSION['username'])) {
        header("location: /../login.php");
    }
    
    ?>
    <div id="navbar-container"></div>
     <h1>Welcome, <?php echo htmlspecialchars('username'); ?>!</h1>
    <p>Your current points: <strong><?php echo htmlspecialchars('points'); ?></strong></p>
</header>

<main>
    <section class="pet-profiles">
        <?php
        require_once '../config.php';

        $sql = "SELECT username, petname, species, color, expression, planet, birthday FROM pets";

        $result = mysqli_query($link, $sql);

        if ($result->num_rows > 0) {
            echo "<h1>All GalaxyPets Profiles</h1>";

            while ($row = $result->fetch_assoc()) {


                $sql1 = "SELECT latestDate FROM latestLogin WHERE username = '" .$row['username']. "'";

                $result_date = mysqli_query($link, $sql1);

                if ($result_date->num_rows > 0) {


                    $time_away = (time() - strtotime($row_date['latestDate']))/86400;

                    //echo $time_away;

                    $sql2 = "UPDATE pets SET expression='regular' WHERE username='" . $row['username'] . "'";

                    if($time_away >= 3)
                    {
                        $sql2 = "UPDATE pets SET expression='sleepy' WHERE username='" . $row['username'] . "'";

                    }
                    if($time_away >= 7)
                    {
                        $sql2 = "UPDATE pets SET expression='asleep' WHERE username='" . $row['username'] . "'";

                    }
                    if($time_away >= 14)
                    {
                        $sql2 = "UPDATE pets SET expression='ouch' WHERE username='" . $row['username'] . "'";
                    }

                    $result2 = mysqli_query($link, $sql2);
                    

                    
                }


                echo '<div class="pet-profile">';
                echo '<h2>' . htmlspecialchars($row['username']) . "'s Pet</h2>";
                echo '<div class="pet-info">';
                echo '<div class="pet-image">';
                echo '<div class="alien-container">';
                echo '<img class="alien-image" src="../Assets/img/' . htmlspecialchars($row["species"]) . '/' . htmlspecialchars($row["expression"]) . '/' . htmlspecialchars($row["color"]) . '.png" alt="Image of ' . htmlspecialchars($row['petname']) . '">';
                echo '</div>';
                echo '</div>';
                echo '<div class="pet-details">';
                echo '<h3>' . htmlspecialchars($row['petname']) . '</h3>';
                echo '<ul>';
                echo '<li><strong>Species:</strong> ' . htmlspecialchars($row["species"]) . '</li>';
                echo '<li><strong>Color:</strong> ' . htmlspecialchars($row["color"]) . '</li>';
                echo '<li><strong>Home Planet:</strong> ' . htmlspecialchars($row["planet"]) . '</li>';
                echo '<li><strong>Birthday:</strong> ' . htmlspecialchars($row["birthday"]) . '</li>';
                echo '</ul>';
                echo '<blockquote>"I am starving for planet points!"</blockquote>';
                echo '</div>';
                echo '</div>'; // Close pet-info div
                echo '</div>'; // Close pet-profile div
            }
        } else {
            echo "<p>No pets found in the database. Adopt one <a href='adopt.php'>HERE</a>.</p>";
        }
        ?>
    </section>
</main>

<a href="/../logout.php">Logout</a>
<script src="../Assets/js/navbar.js"></script>


</body>
</html>
