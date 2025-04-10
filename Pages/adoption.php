<?php
    
    require_once '../config.php';

    $username = $_SESSION['username'];
    $species = $_POST['species'];
    $color = $_POST['color'];
    $planet = $_POST['planet']

    echo $username;
    echo "<br>";
    echo $species;
    echo "<br>";
    echo $color;
    echo "<br>";
    echo $planet;


    
    
?>

