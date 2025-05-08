<?php
session_start();

// Include config and function files
require '../../config.php';
require '../../functions.php';

if (!isset($_SESSION['username'])) {
    die("User not logged in");
}

$allItems = json_decode(file_get_contents("../json/items.json"), true);

$accessories = getAccessories($link, "AliceFakeAcc");
$accessoryNames = [];

if ($accessories && $accessories->num_rows > 0) {
    while ($row = $accessories->fetch_assoc()) {
        $accessoryNames[] = $row; // $row will be: ['accessory' => 'Hat'], etc.
    }
}

// Filter items to only those that match accessories
$matchedItems = array_filter($allItems, function ($item) use ($accessoryNames) {
    return in_array($item['name'], $accessoryNames);
});

// We return the Accessories as Json
header('Content-Type: application/json');
echo json_encode($matchedItems);