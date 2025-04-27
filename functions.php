<?php

function joinChatroom($conn, $userId, $chatroomId)
{
    $stmt = $conn->prepare("INSERT IGNORE INTO chatroom_members (user_id, chatroom_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $chatroomId);
    $stmt->execute();
}

function getOrCreateUser($conn, $username, $email)
{
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId);
    if ($stmt->fetch()) {
        return $userId;
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    return $stmt->insert_id;
}


function getMessages($conn, $chatroomId)
{
    $stmt = $conn->prepare("
        SELECT m.id, u.username, m.content, m.sent_at
        FROM messages m
        JOIN users u ON m.user_id = u.id
        WHERE m.chatroom_id = ?
        ORDER BY m.sent_at ASC
    ");
    $stmt->bind_param("i", $chatroomId);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    return $messages;
}

function sendMessage($conn, $userId, $chatroomId, $content)
{
    $stmt = $conn->prepare("INSERT INTO messages (chatroom_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $chatroomId, $userId, $content);
    $stmt->execute();
}

