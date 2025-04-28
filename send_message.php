<?php
session_start();
require './config.php';
require './functions.php';

if (!isset($_SESSION['username'])) {
    //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
    header("location: /../login.php");
}

$userId = $_SESSION['user_id'];
$chatroomId = intval($_POST['chatroom_id']);
$content = trim($_POST['message']);

if (!empty($content)) {
    sendMessage($link, $userId, $chatroomId, $content);
}

header("Location: chatroom.php?room=$chatroomId");
exit;