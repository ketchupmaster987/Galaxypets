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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score'])) {
    $username = $_SESSION['username'];
    $points = intval($_POST['score']); // Get score from JS

    $stmt = $link->prepare("UPDATE points SET points = points + ? WHERE user = ?");
    if (!$stmt) {
        file_put_contents("beacon_log.txt", "Prepare failed: " . $link->error . "\n", FILE_APPEND);
        http_response_code(500);
        exit("SQL prepare failed.");
    }
    $stmt->bind_param("is", $points, $username);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo "Failed to update score.";
    }
    // Optionally return a response, though Beacon doesn't wait for one
    exit("Score updated successfully.");
} else {
    http_response_code(400); // Bad request
    exit("Invalid score data.");
}
