<?php
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

if (!empty($content)) {
    sendMessage($link, $user, $chatroomId, $content);
}

header("Location: Pages/clubs/chatroom.php?room=$chatroomId");
exit;