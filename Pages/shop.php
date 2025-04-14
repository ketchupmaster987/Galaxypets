<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Club Shop</title>
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="preload" href="../Assets/img/aquagalaxy_small.gif" as="image">
    <style>
        :root {
            --dark-purple: #6917d0;
            --light-purple: #cc17ff;
            --pink: #ff1791;
            --green: #17ffc4;
            --blue: #17ffee;
        }

        body {
            font-family: 'pixel', sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: var(--blue);
            text-align: center;
        }

        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            margin-bottom: 5px;
        }

        select {
            padding: 5px;
            background-color: var(--dark-purple);
            color: white;
            border: none;
        }

        .view-options {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .view-options button {
            margin-left: 10px;
            padding: 5px 10px;
            background-color: var(--pink);
            color: white;
            border: none;
            cursor: pointer;
        }

        .grid {
            display: grid;
            gap: 20px;
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-5 {
            grid-template-columns: repeat(5, 1fr);
        }

        .item {
            background-color: var(--dark-purple);
            padding: 10px;
            text-align: center;
        }

        .item img {
            max-width: 100%;
            height: auto;
        }

        .item h3 {
            margin: 10px 0;
            color: var(--green);
        }

        .item p {
            margin: 5px 0;
            color: var(--blue);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid var(--light-purple);
            text-align: left;
        }

        th {
            background-color: var(--dark-purple);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><a href="../index.php" style="text-decoration: none;">GalaxyPets</a></div>
            <ul>
                <li class="dropdown">
                    <a href="petprofile.php">Your Pet/Profile</a>
                    <div class="dropdown-content">
                        <a href="petprofile.php">My GalaxyPet</a>
                        <a href="#">Closet</a>
                        <a href="#">Settings</a>
                    </div>
                </li>
                <li class="dropdown">
                    Community
                    <div class="dropdown-content">
                        <a href="clubs.php">Clubs</a>
                        <a href="#">Users</a>
                    </div>
                </li>
                <li><a href="../index.php">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
            </ul>
        </nav>
    </header>
    
    <marquee behavior=scroll direction="left" scrollamount="5" style="color: #17ffee;">
        •°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ.•°*”˜˜”*°•.ƸӜƷ•°*”˜˜”*°•.ƸӜƷ
    </marquee>
    <div class="container">
        <h1>Welcome to the Shop!</h1>

        <div class="filters">
            <div class="filter-group">
                <label for="product-type">Product Type:</label>
                <select id="product-type">
                    <option value="">All</option>
                    <option value="hat">Hat</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="color">Color:</label>
                <select id="color">
                    <option value="">All</option>
                    <option value="lilac">Lilac</option>
                    <option value="purple">Purple</option>
                    <option value="pink">Pink</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="fun-factor">Fun Factor:</label>
                <select id="fun-factor">
                    <option value="">All</option>
                    <option value="super-fun">Super Fun</option>
                    <option value="kind-of-fun">Kind of Fun</option>
                    <option value="boring">Boring</option>
                </select>
            </div>
        </div>

        <div class="view-options">
            <button onclick="changeView('table')">Table View</button>
            <button onclick="changeView('grid-3')">Grid (3 columns)</button>
            <button onclick="changeView('grid-5')">Grid (5 columns)</button>
        </div>

        <div id="items-container"></div>
    </div>

    <script>
        const items = [
            { id: "hat-1", name: "Alien Antenna", price: 20, image: "sillyband-yellow.PNG", type: "hat", color: "yellow", fun_factor: "super-fun" },
            { id: "hat-2", name: "Alien Antenna", price: 20, image: "sillyband-blue.PNG", type: "hat", color: "blue", fun_factor: "super-fun" },
            { id: "hat-3", name: "Alien Antenna", price: 20, image: "sillyband-green.PNG", type: "hat", color: "green", fun_factor: "super-fun" },
            { id: "hat-4", name: "Alien Antenna", price: 20, image: "sillyband-lilac.PNG", type: "hat", color: "lilac", fun_factor: "super-fun" },
            { id: "hat-5", name: "Alien Antenna", price: 20, image: "sillyband-purple.PNG", type: "hat", color: "purple", fun_factor: "super-fun" },
            { id: "hat-6", name: "Alien Antenna", price: 20, image: "sillyband-pink.PNG", type: "hat", color: "pink", fun_factor: "super-fun" },
            { id: "hat-7", name: "Nebula Noggin", price: 10, image: "helmet-green.PNG", type: "hat", color: "green", fun_factor: "boring" },
            { id: "hat-8", name: "Nebula Noggin", price: 10, image: "helmet-pink.PNG", type: "hat", color: "pink", fun_factor: "boring" },
            { id: "hat-9", name: "Nebula Noggin", price: 10, image: "helmet-blue.PNG", type: "hat", color: "blue", fun_factor: "boring" },
            { id: "hat-10", name: "Nebula Noggin", price: 10, image: "helmet-purple.PNG", type: "hat", color: "purple", fun_factor: "boring" },
            { id: "hat-11", name: "Nebula Noggin", price: 10, image: "helmet-lilac.PNG", type: "hat", color: "lilac", fun_factor: "boring" },
            { id: "hat-5", name: "Lunar Lid", price: 15, image: "tophat-blue.PNG", type: "hat", color: "blue", fun_factor: "kind-of-fun" },
            { id: "hat-5", name: "Lunar Lid", price: 15, image: "tophat-pink.PNG", type: "hat", color: "pink", fun_factor: "kind-of-fun" },
            { id: "hat-5", name: "Lunar Lid", price: 15, image: "tophat-lilac.PNG", type: "hat", color: "lilac", fun_factor: "kind-of-fun" },
            { id: "hat-5", name: "Lunar Lid", price: 15, image: "tophat-green.PNG", type: "hat", color: "green", fun_factor: "kind-of-fun" },
            { id: "hat-5", name: "Lunar Lid", price: 15, image: "tophat-purple.PNG", type: "hat", color: "purple", fun_factor: "kind-of-fun" },
            { id: "hat-6", name: "Cosmic Crown", price: 20, image: "crown-purple.PNG", type: "hat", color: "purple", fun_factor: "super-fun" },
            { id: "hat-6", name: "Cosmic Crown", price: 15, image: "crown-pink.PNG", type: "hat", color: "pink", fun_factor: "kind-of-fun" },
            { id: "hat-6", name: "Cosmic Crown", price: 15, image: "crown-green.PNG", type: "hat", color: "green", fun_factor: "kind-of-fun" },
            { id: "hat-6", name: "Cosmic Crown", price: 15, image: "crown-lilac.PNG", type: "hat", color: "lilac", fun_factor: "kind-of-fun" },
            { id: "hat-6", name: "Cosmic Crown", price: 15, image: "crown-blue.PNG", type: "hat", color: "blue", fun_factor: "kind-of-fun" },

        ];

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        function changeView(viewType) {
            const container = document.getElementById('items-container');
            container.innerHTML = '';

            let itemsToDisplay = [...items]; // Create a copy to shuffle
            shuffleArray(itemsToDisplay); // Shuffle the copied array

            if (viewType === 'table') {
                const table = document.createElement('table');
                table.innerHTML = `
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Fun Factor</th>
                    </tr>
                `;
                itemsToDisplay.forEach(item => {
                    table.innerHTML += `
                        <tr>
                            <td><img src="../Assets/img/hats/${item.image}" alt="${item.name}" style="width: 50px;"></td>
                            <td>${item.name}</td>
                            <td>$${item.price.toFixed(2)}</td>
                            <td>${item.color}</td>
                            <td>${item.fun_factor}</td>
                        </tr>
                    `;
                });
                container.appendChild(table);
            } else {
                const grid = document.createElement('div');
                grid.className = `grid ${viewType}`;
                itemsToDisplay.forEach(item => {
                    grid.innerHTML += `
                        <div class="item">
                            <img src="../Assets/img/hats/${item.image}" alt="${item.name}">
                            <h3>${item.name}</h3>
                            <p>$${item.price.toFixed(2)}</p>
                            <p>Color: ${item.color}</p>
                        </div>
                    `;
                });
                container.appendChild(grid);
            }
        }

        function filterItems() {
            const typeFilter = document.getElementById('product-type').value;
            const colorFilter = document.getElementById('color').value;
            const funFactorFilter = document.getElementById('fun-factor').value;

            const filteredItems = items.filter(item =>
                (typeFilter === '' || item.type === typeFilter) &&
                (colorFilter === '' || item.color === colorFilter) &&
                (funFactorFilter === '' || item.fun_factor === funFactorFilter)
            );

            displayFilteredItems(filteredItems);
        }

        function displayFilteredItems(filteredItems) {
            const container = document.getElementById('items-container');
            container.innerHTML = '';

            let itemsToDisplay = [...filteredItems]; // Create a copy to shuffle
            shuffleArray(itemsToDisplay); // Shuffle the copied array

            const grid = document.createElement('div');
            grid.className = 'grid grid-3';
            itemsToDisplay.forEach(item => {
                grid.innerHTML += `
                    <div class="item">
                        <img src="../Assets/img/hats/${item.image}" alt="${item.name}">
                        <h3>${item.name}</h3>
                        <p>$${item.price.toFixed(2)}</p>
                        <p>Color: ${item.color}</p>
                    </div>
                `;
            });
            container.appendChild(grid);
        }

        // Initialize with grid-3 view
        changeView('grid-3');

        // Add event listeners to filters
        document.getElementById('product-type').addEventListener('change', filterItems);
        document.getElementById('color').addEventListener('change', filterItems);
        document.getElementById('fun-factor').addEventListener('change', filterItems);
    </script>
</body>
</html>
