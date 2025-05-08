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

// We return the Accessories as Json
echo json_encode($accessories);