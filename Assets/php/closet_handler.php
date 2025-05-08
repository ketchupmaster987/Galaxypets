<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Include config and function files
require '../../config.php';
require '../../functions.php';

if (!isset($_SESSION['username'])) {
    die("User not logged in");
}

header('Content-Type: application/json');

$accessories = getAccessories($link, $_SESSION['username']);

$myData = [];

if ($accessories && $accessories->num_rows > 0) {
    while ($row = $accessories->fetch_assoc()) {
        unset($row['accessory']);
        $myData[] = $row;
    }
}

// We return the Accessories as Json
echo json_encode($myData);