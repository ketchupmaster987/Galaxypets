<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Redirect if already logged in
if (isset($_SESSION['username'])) {
    header("location: ../../Pages/petprofile.php");
    exit;
}

// Include config and function files
require_once './config.php';
require './functions.php';

$accessories = getAccessories($link, $_SESSION['username']);

$myData = [];
if ($accessories->num_rows > 0) {
    while($row = $accessories->fetch_assoc()) {
        unset($row['accessory']);
        array_push($myData, $row); // push rows to array $myData
    }
}

// We return the Accessories as Json
header('Content-Type: application/json');
echo json_encode($myData);