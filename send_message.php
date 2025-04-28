<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require './config.php';
require './functions.php';

if (!isset($_SESSION['username'])) {
    //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
    header("location: /../login.php");
}

$userId = $_SESSION['id'];
$chatroomId = intval($_POST['chatroom_id']);
$content = trim($_POST['message']);

if (!empty($content)) {
    sendMessage($link, $userId, $chatroomId, $content);
}

header("Location: chatroom.php?room=$chatroomId");
exit;