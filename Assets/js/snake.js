// Get the canvas element and its 2D rendering context
const canvas = document.getElementById('game');
const context = canvas.getContext('2d');

// Size of each grid cell
const grid = 16;
// Frame counter for controlling game speed
let count = 0;

// Snake object
const snake = {
    x: 160, // initial x position
    y: 160, // initial y position
    dx: grid, // horizontal movement direction (right)
    dy: 0,    // vertical movement direction
    cells: [], // array of cells that make up the snake's body
    maxCells: 4 // starting length of the snake
};

// Apple object (the thing the snake "eats")
const apple = {
    x: 320,
    y: 320
};

// Helper function to get a random integer in a range (min inclusive, max exclusive)
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

// Main game loop
function loop() {
    requestAnimationFrame(loop); // loop continuously using the browser's animation frame

    // Only update game state every 10 frames to slow down the game
    if (++count < 10) {
        return;
    }

    count = 0;

    // Clear the canvas
    context.clearRect(0, 0, canvas.width, canvas.height);

    // Move the snake by updating its head position
    snake.x += snake.dx;
    snake.y += snake.dy;

    // Wrap around screen edges
    if (snake.x < 0) {
        snake.x = canvas.width - grid;
    } else if (snake.x >= canvas.width) {
        snake.x = 0;
    }

    if (snake.y < 0) {
        snake.y = canvas.height - grid;
    } else if (snake.y >= canvas.height) {
        snake.y = 0;
    }

    // Add new head position to the front of the snake body array
    snake.cells.unshift({x: snake.x, y: snake.y});

    // Remove cells from the end if snake is longer than maxCells
    if (snake.cells.length > snake.maxCells) {
        snake.cells.pop();
    }

    // Draw the apple
    context.fillStyle = 'blue';
    context.fillRect(apple.x, apple.y, grid - 1, grid - 1);

    // Draw the snake
    context.fillStyle = 'teal';
    snake.cells.forEach(function (cell, index) {
        context.fillRect(cell.x, cell.y, grid - 1, grid - 1);

        // If the snake eats the apple
        if (cell.x === apple.x && cell.y === apple.y) {
            snake.maxCells++;

            // Place a new apple randomly
            apple.x = getRandomInt(0, 25) * grid;
            apple.y = getRandomInt(0, 25) * grid;
        }

        // Check for collision with self (loop through the rest of the body)
        for (let i = index + 1; i < snake.cells.length; i++) {
            if (cell.x === snake.cells[i].x && cell.y === snake.cells[i].y) {
                // Reset the game state if collision occurs
                snake.x = 160;
                snake.y = 160;
                snake.cells = [];
                snake.maxCells = 4;
                snake.dx = grid;
                snake.dy = 0;

                // Reposition the apple
                apple.x = getRandomInt(0, 25) * grid;
                apple.y = getRandomInt(0, 25) * grid;
            }
        }
    });
}

// Keyboard input: change snake direction based on arrow keys
document.addEventListener('keydown', function (e) {
    // Prevent snake from reversing direction directly
    if (e.which === 37 && snake.dx === 0) { // left
        snake.dx = -grid;
        snake.dy = 0;
    } else if (e.which === 38 && snake.dy === 0) { // up
        snake.dy = -grid;
        snake.dx = 0;
    } else if (e.which === 39 && snake.dx === 0) { // right
        snake.dx = grid;
        snake.dy = 0;
    } else if (e.which === 40 && snake.dy === 0) { // down
        snake.dy = grid;
        snake.dx = 0;
    }
});

// Start the game loop
requestAnimationFrame(loop);