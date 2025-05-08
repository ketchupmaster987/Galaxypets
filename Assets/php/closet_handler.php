<?php
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

// We return the Accessories as Json
echo json_encode($accessories);