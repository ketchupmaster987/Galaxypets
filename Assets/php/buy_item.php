<?php
session_start();

// Include config and function files
require '../../config.php';
require '../../functions.php';

if (!isset($_SESSION['username'])) {
    die("User not logged in");
}

// $item should be the json of the item
// {
//    "id": "hat-2",
//    "name": "Alien Antenna",
//    "price": 20,
//    "image": "sillyband-blue.PNG",
//    "type": "hat",
//    "color": "blue",
//    "fun_factor": "super-fun"
//  }
function buyItem($link, $item)
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