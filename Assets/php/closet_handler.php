<?php
session_start();

// Include config and function files
require '../../config.php';
require '../../functions.php';

if (!isset($_SESSION['username'])) {
    die("User not logged in");
}

header('Content-Type: application/json');

$accessories = getAccessories($link, "AliceFakeAcc");

// We return the Accessories as Json
echo json_encode($accessories);