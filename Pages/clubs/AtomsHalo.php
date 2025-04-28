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
    <?php
    session_start();

    // Include your database connection and your chatroom functions
    require '../../config.php';         // Update the path to your db connection
    require '../../functions.php';  // Update the path to your functions

    // Assume user is already logged in and has $_SESSION['user_id'], otherwise you'd need login checking here.

    $chatroomId = 1; // Hardcoding for now, or could be from GET param
    $messages = getMessages($conn, $chatroomId);
    ?>

    <div id="navbar-container"></div>
</header>

<marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">
    •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
</marquee>

<main role="main" class="container-md">
    <section class="club-chatroom-grid">
        <section class="left-column">
            <figure>
                <figcaption>
                    <h2>Atoms Halo</h2>
                </figcaption>
                <img src="../../Assets/img/planets/lavenderplanet.png" alt="Atoms Halo">
            </figure>
            <section class="club-chatroom-info">
                <div><p>Message about Atoms Halo :)</p></div>
                <div><p>Population: 5</p></div>
                <div><p>Online: 4</p></div>
            </section>
        </section>

        <section class="chat-area">
            <section class="message-area container">
                <?php foreach ($messages as $message): ?>
                    <?php
                    $isCurrentUser = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $message['user_id'];
                    $chatClass = $isCurrentUser ? 'chat-right' : 'chat-left';
                    ?>
                    <div class="message <?= $chatClass ?>">
                        <?php if ($isCurrentUser): ?>
                            <div class="chat-message"><p><?= htmlspecialchars($message['content']) ?></p></div>
                            <div class="chat-username"><p><?= htmlspecialchars($message['username']) ?></p></div>
                        <?php else: ?>
                            <div class="chat-username"><p><?= htmlspecialchars($message['username']) ?></p></div>
                            <div class="chat-message"><p><?= htmlspecialchars($message['content']) ?></p></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
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