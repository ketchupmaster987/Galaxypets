<?php
// Error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require '../../config.php';
require '../../functions.php';

if (!isset($_SESSION['username'])) {
    http_response_code(403);
    exit("User not logged in");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score'])) {
    $username = $_SESSION['username'];
    $points = intval($_POST['score']);

    // Check if the user already has points
    $checkStmt = $link->prepare("SELECT 1 FROM points WHERE user = ?");
    if (!$checkStmt) {
        http_response_code(500);
        exit("SQL prepare failed (check).");
    }
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Update existing score
        $stmt = $link->prepare("UPDATE points SET points = points + ? WHERE user = ?");
        if (!$stmt) {
            http_response_code(500);
            exit("SQL prepare failed (update).");
        }
        $stmt->bind_param("is", $points, $username);
    } else {
        // Insert new score row
        $stmt = $link->prepare("INSERT INTO points (user, points) VALUES (?, ?)");
        if (!$stmt) {
            http_response_code(500);
            exit("SQL prepare failed (insert).");
        }
        $stmt->bind_param("si", $username, $points);
    }

    if (!$stmt->execute()) {
        http_response_code(500);
        exit("Failed to save score.");
    }

    exit("Score saved successfully.");
} else {
    http_response_code(400);
    exit("Invalid score data.");
}
