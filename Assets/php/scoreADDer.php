<?php
// Error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once './config.php';

if (!isset($_SESSION['username'])) {
    http_response_code(403);
    exit("User not logged in");
}

$username = $_SESSION['username'];
$points = isset($_POST['score']) ? (int)$_POST['score'] : 0;

if ($points > 0) {
    $stmt = $link->prepare("UPDATE points SET points = points + ? WHERE username = ?");
    $stmt->bind_param("is", $points, $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "failed";
    }
} else {
    echo "No points to add";
}
