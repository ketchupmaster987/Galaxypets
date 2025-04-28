<?php
session_start();
require './config.php';
require './functions.php';

// Protect if user not logged in
if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to send messages.');
}

$userId = $_SESSION['user_id'];
$chatroomId = intval($_POST['chatroom_id']);
$content = trim($_POST['message']);

if (!empty($content)) {
    sendMessage($conn, $userId, $chatroomId, $content);
}

header("Location: chatroom.php?room=$chatroomId");
exit;