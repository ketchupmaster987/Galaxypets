<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Club Shop</title>
    <link rel="stylesheet" href="../Assets/css/style.css">
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
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}
?>

<header>
    <div id="navbar-container"></div>
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
    let items;
    fetch("../Assets/php/shop_load_handler.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network error");
            }
            return response.text(); // first, get raw text
        })
        .then((text) => {
            const data = JSON.parse(text); // now try to parse
            console.log("Parsed JSON:", data);
            items = data;
            // Initialize with grid-3 view
            changeView('grid-3');
        })
        .catch((error) => {
            console.error("Error parsing JSON:", error);
        });

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
                            <td>${item.fun_factor}</td>
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
                        <td>${item.fun_factor}</td>
                    </div>
                `;
        });
        container.appendChild(grid);
    }

    // Add event listeners to filters
    document.getElementById('product-type').addEventListener('change', filterItems);
    document.getElementById('color').addEventListener('change', filterItems);
    document.getElementById('fun-factor').addEventListener('change', filterItems);
</script>
</body>
</html>
