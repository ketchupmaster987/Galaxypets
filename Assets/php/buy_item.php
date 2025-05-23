<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require '../../config.php';
require '../../functions.php';

if (!isset($_SESSION['username'])) {
    die("User not logged in");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the item data from the AJAX request
    $item = json_decode($_POST['item'], true);  // Decode the JSON data

    if (isset($item['id'], $item['price'])) {
        buyItem($link, $item);
    } else {
        echo "Invalid item data.";
    }
}

function buyItem($link, $item)
{
    $success = buy_item($link, $_SESSION['username'], $item['price'], $item['id']);

    if ($success) {
        echo "<script type='text/javascript'>
        alert('Purchase Successful!');
        location.reload();  // Reload the page after the alert
    </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('Purchase Failed');  // Simple pop-up
    </script>";
    }
}