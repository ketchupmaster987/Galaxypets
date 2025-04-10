<?php
    
    require_once '../config.php';

    $username = $_SESSION['username'];
    $species = $_GET['species'];
    $color = $_GET['color'];
    $planet = $_GET['planet'];

    echo $username;
    echo "<br>";
    echo $species;
    echo "<br>";
    echo $color;
    echo "<br>";
    echo $planet;


    
    
?>

