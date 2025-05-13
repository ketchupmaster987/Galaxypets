<?php
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
        buyItem($item);
    } else {
        echo "Invalid item data.";
    }
}

function buyItem($item)
{
    $success = buy_item($link, $_SESSION['username'], $item['id'], $item['price']);

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