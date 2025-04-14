<!DOCTYPE HTML>
<HTML lang="en">
<Head>
    <meta charset="utf-8">
    <title>Memory game</title>
    <style>
        *, ::after, ::before {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            background-color: black;
            color: rgb(246, 14, 168);
        }

        .card {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            margin-right: 5px;
            padding: 5px;
            cursor: pointer;
        }

        #grid {
            margin: 0 auto;
            margin-top: 50px;
            border: 2px solid #20c1cf;
            border-radius: 4px;
            display: flex;
            flex-wrap: wrap;
            padding: 5px 0;
            width: 324px;
            height: 425px;
        }

        .gameover {
            width: 150px;
            height: 100px;
            position: absolute;
            top: 50%;
            left: 50%;
            border: 2px solid #222222;
            border-radius: 5px;
            transform: translate(-50%, -50%);
            background-color: #DDDDDD;
            color: #222222;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #grid > img:nth-child(3n+1)
        {
        margin-left: 5px;
        }

        .matched {
            opacity: 0.5;
            cursor: auto;
        }

    </style>
</Head>
<body>
<header>
    <?php

    
    if (!isset($_SESSION['username'])){
        //echo "<script>alert('current user: ".$_SESSION['username']."')</script>";
        header("location: /../login.php");
    }
    ?>
    <nav>
        <div class="logo"><a href="../index.php" style="text-decoration: none;">GalaxyPets</a></div>
        <ul>
            <li><a href="../index.php">Back to Home</a></li>
            <li class="dropdown">
                Community
                <div class="dropdown-content">
                    <a href="clubs.php">Clubs</a>
                    <a href="#">Users</a>
                </div>
            </li>
            <li><a href="games.php">Games</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="/../logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>
    <h2>Score: <span id='score'>0</span></h2>
    <div id='grid'></div>
    <script>
        const gridDisplay = document.getElementById('grid')
        const canvas = document.createElement('canvas');
        const scoreSpan = document.getElementById('score')
        const MAX_SCORE = 6
        const cardsArr = [
            '../../../Assets/img/glorbus/blue.PNG',
            '../../../Assets/img/glorbus/darkpurple.PNG',
            '../../../Assets/img/glorbus/lightpurple.PNG',
            '../../../Assets/img/glorbus/pink.PNG',
            '../../../Assets/img/glorbus/green.PNG',
            '../../../Assets/img/planets/blueplanet.PNG',
        ]

        let indices = [0, 1, 2, 3, 4, 5]
        let card1 = null, card2 = null;
        let score = 0
        init()

        function init() {
            indices = [...indices, ...indices]
            indices.sort(() => 0.5 - Math.random())
            canvas.width = 100; 
            canvas.height = 100;
            const context = canvas.getContext('2d');
            context.fillStyle = '#3112e0'; 
            context.fillRect(0, 0, canvas.width, canvas.height);
            createBoard()
        }
        function createBoard() {
            indices.forEach( (i) => {
                const img = document.createElement('img')
                img.classList.add('card')
                img.setAttribute('src', canvas.toDataURL())
                img.setAttribute('data-id', i)
                img.addEventListener('click', cardFlip)
                gridDisplay.appendChild(img)
            })
        }

        function cardFlip() {
            this.src = cardsArr[this.getAttribute('data-id')]
            this.style.cursor = 'auto'
            this.removeEventListener('click', cardFlip)
            // Is this the first card being flipped?
            if (card1 == null) {
                card1 = this
            }
            else {
                card2 = this
                checkMatch()
            }
        }

        function checkMatch() {
        if (card1.getAttribute('data-id') === card2.getAttribute('data-id')) {  
                card1.classList.add('matched')
                card2.classList.add('matched')
                card1 = null
                card2 = null
                score = score + 1
                scoreSpan.innerText = score
                if (score === MAX_SCORE) {
                    gameOver()
                }
            }
            else {
                disableClicks()
                setTimeout(restoreCards, 500)
            }
        }

        function restoreCards() {
            card1.src = canvas.toDataURL()
            card2.src = canvas.toDataURL()
            card1 = null
            card2 = null
            enableClicks()
        }

        function disableClicks() {
            const cards = document.querySelectorAll('.card:not(.matched)')
            cards.forEach( c => {
                c.removeEventListener('click', cardFlip)
                c.style.cursor = 'auto'
            })
        }

        function enableClicks() {
            const cards = document.querySelectorAll('.card:not(.matched)')
            cards.forEach( c => {
                c.addEventListener('click', cardFlip)
                c.style.cursor = 'pointer'
            })
        }

        function gameOver() {
            const go = document.createElement('div')
            go.innerText = 'Game over'
            go.classList.add('gameover')
            document.body.appendChild(go)
        }
    </script>
</body>
</HTML>