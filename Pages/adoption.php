<?php
    
	session_start();
    
    require_once '../config.php';

    $username = $_SESSION['username'];
    $petname = $_GET['name'];
    $species = $_GET['species'];
    $color = $_GET['color'];
    $planet = $_GET['planet'];

    $sql = "INSERT INTO pets (username, petname, species, color, planet) VALUES ('$username', '$petname', '$species', '$color', '$planet')";

    mysqli_query($link, $sql);

    header("location: petprofile.php");
    
?>

