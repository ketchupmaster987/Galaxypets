<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
require './config.php';
require './functions.php';

if (!isset($_SESSION['username'])) {
    //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
    header("location: /../login.php");
}

// Look up user info from username
$user = getUserByUsername($link, $_SESSION['username']);

$chatroomId = intval($_POST['chatroom_id']);
$content = trim($_POST['message']);

echo '<pre>';
var_dump($user, $chatroomId, $content);
echo '</pre>';

if (!empty($content)) {
    sendMessage($link, $user, $chatroomId, $content);
}

header("Location: Pages/clubs/chatroom.php?room=$chatroomId");
exit;