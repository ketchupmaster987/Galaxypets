<?php

// Include config file
require_once './config.php';



$points = $_SESSION['points'];
    $username = $_SESSION['username'];
    $stmt = $link->prepare("Update points set points = points + ? where username = ?");
    $stmt->bind_param("iis", $points, $username); // iis = int, int, string
    $stmt->execute(); // Execute the query

?>
