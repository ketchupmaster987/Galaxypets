<?php
// Load JSON
$jsonData = file_get_contents('../../../Assets/json/planets.json');
$chatrooms = json_decode($jsonData, true);

// Get the room ID from URL
$roomId = isset($_GET['room']) ? (int)$_GET['room'] : 0;

// Select the specific chatroom (remember arrays are 0-indexed)
$selectedChatroom = $chatrooms[$roomId - 1] ?? null;

// Optionally: debug
// echo '<pre>'; print_r($selectedChatroom); echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GalaxyPets - Your Space Adventure Begins!</title>
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/club.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<header class="border-bottom sticky-top">
    <div id="navbar-container"></div>
</header>

<marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<main role="main" class="container-md">
    <section class="club-chatroom-grid">
        <section class="left-column">
            <!-- Loop through each chatroom and display its information -->
            <?php foreach ($chatrooms as $chatroom): ?>
                <figure>
                    <figcaption>
                        <h2><?= htmlspecialchars($chatroom['name']) ?></h2>
                    </figcaption>
                    <img src="../<?= htmlspecialchars($chatroom['imgSrc']) ?>" alt="<?= htmlspecialchars($chatroom['altText']) ?>">
                </figure>
                <section class="club-chatroom-info">
                    <div><p><?= htmlspecialchars($chatroom['name']) ?> Description</p></div>
                    <div><p>Population: <?= htmlspecialchars($chatroom['population']) ?></p></div>
                    <div><p>Online: <?= htmlspecialchars($chatroom['online']) ?></p></div>
                </section>
            <?php endforeach; ?>
        </section>

        <section class="chat-area">
            <section class="message-area container">
                <?php if ($selectedChatroom): ?>
                    <figure>
                        <figcaption>
                            <h2><?= htmlspecialchars($selectedChatroom['name']) ?></h2>
                        </figcaption>
                        <img src="<?= htmlspecialchars($selectedChatroom['imgSrc']) ?>" alt="<?= htmlspecialchars($selectedChatroom['altText']) ?>">
                    </figure>
                    <section class="club-chatroom-info">
                        <div><p><?= htmlspecialchars($selectedChatroom['name']) ?> Description</p></div>
                        <div><p>Population: <?= htmlspecialchars($selectedChatroom['population']) ?></p></div>
                        <div><p>Online: <?= htmlspecialchars($selectedChatroom['online']) ?></p></div>
                    </section>
                <?php else: ?>
                    <p>Chatroom not found.</p>
                <?php endif; ?>
            </section>

            <section class="input-area input-group container">
                <form method="post" action="../../send_message.php" class="input-group w-100">
                    <input class="form-control" name="message" type="text" placeholder="Type your message here..." required>
                    <input type="hidden" name="chatroom_id" value="<?= $chatroomId ?>">
                    <button class="btn btn-dark" type="submit">Send</button>
                </form>
            </section>
        </section>
    </section>
</main>

<marquee behavior=scroll direction="right" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<script src="../../Assets/js/navbar.js"></script>

</body>
</html>
