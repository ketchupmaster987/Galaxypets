<?php

// Adds a user to a chatroom if they're not already in it
function joinChatroom($link, $userId, $chatroomId)
{
    // Prepare an SQL statement to insert a user and chatroom ID
    // 'INSERT IGNORE' prevents error if the entry already exists
    $stmt = $link->prepare("INSERT IGNORE INTO chatroom_members (user_id, chatroom_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $chatroomId); // 'ii' means two integers
    $stmt->execute(); // Run the query
}

// Gets a user's ID based on their username
function getUserByUsername($link, $username)
{
    $stmt = $link->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId);
    if ($stmt->fetch()) {
        return $userId;
    }
    return null;
}

// Retrieves all messages from a specific chatroom, ordered by the time they were sent
function getMessages($link, $chatroomId)
{
    $stmt = $link->prepare("
        SELECT m.id, u.id AS user_id, u.username, m.content, m.sent_at
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


// Sends (inserts) a new message into the database
function sendMessage($link, $userId, $chatroomId, $content)
{
    echo '<pre>';
    print_r("$userId, $chatroomId, $content");
    echo '</pre>';
    // Prepare an SQL query to insert a new message
    $stmt = $link->prepare("INSERT INTO messages (chatroom_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $chatroomId, $userId, $content); // iis = int, int, string
    $stmt->execute(); // Execute the query
}
