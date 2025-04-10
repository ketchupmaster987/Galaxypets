<?php
    
    require_once '../config.php';

    $username = $_SESSION['username'];
    $species = $_POST['species'];
    $color = $_POST['color'];
    $planet = $_POST['planet']


    $sql = "INSERT INTO pets (username, species, color, planet) VALUES ('$username', '$species', '$color', '$planet')";

    mysqli_query($link,$sql);

    header("location: petprofile.php");
    
?>