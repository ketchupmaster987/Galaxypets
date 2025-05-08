<?php
session_start();

// Include config and function files
require '../../config.php';
require '../../functions.php';

if (!isset($_SESSION['username'])) {
    die("User not logged in");
}

$accessories = getAccessories($link, "AliceFakeAcc");
$myData = [];

if ($accessories && $accessories->num_rows > 0) {
    while ($row = $accessories->fetch_assoc()) {
        $myData[] = $row; // $row will be: ['accessory' => 'Hat'], etc.
    }
}

// We return the Accessories as Json
header('Content-Type: application/json');
echo json_encode($myData);