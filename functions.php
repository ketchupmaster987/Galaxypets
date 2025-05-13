<?php

/**
 * Adds a user to a chatroom if they're not already in it.
 *
 * @param mysqli $link          The MySQLi connection object.
 * @param int    $userId        The ID of the user to add.
 * @param int    $chatroomId    The ID of the chatroom to join.
 * @return void
 */
function joinChatroom($link, $userId, $chatroomId)
{
    // 'INSERT IGNORE' prevents duplicate entries if user is already in the chatroom
    $stmt = $link->prepare("INSERT IGNORE INTO chatroom_members (user_id, chatroom_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $chatroomId); // Bind two integers
    $stmt->execute(); // Execute the statement
}

/**
 * Gets a user's ID based on their username.
 *
 * @param mysqli $link        The MySQLi connection object.
 * @param string $username    The username to search for.
 * @return int|null           Returns the user ID if found, or null otherwise.
 */
function getUserByUsername($link, $username)
{
    $stmt = $link->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind one string
    $stmt->execute();
    $stmt->bind_result($userId); // Store result in $userId
    if ($stmt->fetch()) {
        return $userId;
    }
    return null; // No user found
}

/**
 * Retrieves all messages from a specific chatroom, ordered by sent time.
 *
 * @param mysqli $link          The MySQLi connection object.
 * @param int    $chatroomId    The ID of the chatroom.
 * @return array                An array of associative arrays representing messages.
 */
function getMessages($link, $chatroomId)
{
    $stmt = $link->prepare("
        SELECT m.id, u.id AS user_id, u.username, m.content, m.sent_at
        FROM messages m
        JOIN users u ON m.user_id = u.id
        WHERE m.chatroom_id = ?
        ORDER BY m.sent_at ASC
    ");
    $stmt->bind_param("i", $chatroomId); // Bind one integer
    $stmt->execute();
    $result = $stmt->get_result(); // Get result set

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row; // Append each message as an associative array
    }

    return $messages;
}

/**
 * Inserts a new message into the database.
 *
 * @param mysqli $link          The MySQLi connection object.
 * @param int    $userId        The ID of the user sending the message.
 * @param int    $chatroomId    The ID of the chatroom.
 * @param string $content       The content of the message.
 * @return void
 */
function sendMessage($link, $userId, $chatroomId, $content)
{
    $stmt = $link->prepare("INSERT INTO messages (chatroom_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $chatroomId, $userId, $content); // Bind two ints and one string
    $stmt->execute();
}

/**
 * Gets the accessories associated with a specific username.
 *
 * @param mysqli $link        The MySQLi connection object.
 * @param string $username    The username to look up.
 * @return mysqli_result      A result set containing the accessories.
 */
function getAccessories($link, $username)
{
    $stmt = $link->prepare("SELECT accessory FROM closets WHERE user = ?");
    $stmt->bind_param("s", $username); // Bind one string
    $stmt->execute();
    return $stmt->get_result(); // Return the result set for further processing
}

function get_points($link, $username)
{
    $stmt = $link->prepare("SELECT points FROM points WHERE user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->bind_result($points);
}

function buy_item($link, $username, $itemCost, $itemName)
{
    // Assume $link is your mysqli connection
    $link->begin_transaction();

    try {
        // 1. Subtract points IF the user has enough
        $stmt = $link->prepare("
        UPDATE points 
        SET points = points - ? 
        WHERE user = ? AND points >= ?
    ");
        $stmt->bind_param("isi", $itemCost, $username, $itemCost);
        $stmt->execute();

        // Check if a row was updated (i.e., user had enough points)
        if ($stmt->affected_rows === 0) {
            // Not enough points — rollback and exit
            $link->rollback();
            echo json_encode(["success" => false, "message" => "Not enough points. {$itemCost} points required. {$username} "]);
            exit;
        }

        // 2. Add the accessory to the closet
        $stmt = $link->prepare("
        INSERT INTO closets (user, accessory) 
        VALUES (?, ?)
    ");
        $stmt->bind_param("ss", $username, $itemName);
        $stmt->execute();

        // 3. Everything succeeded — commit the transaction
        $link->commit();

        echo json_encode(["success" => true, "message" => "Accessory added successfully."]);

    } catch (Exception $e) {
        // On error, roll back
        $link->rollback();
        echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
    }
}