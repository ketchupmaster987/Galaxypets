<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
  html, body {
    height: 100%;
    margin: 0;
  }

  body {
    background: black;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  canvas {
    border: 1px solid white;
  }
  header{
    width: 100%;
    position: sticky;
    top: 0px;
    left: 0px;
    background-color: darkblue;
    color: aqua;
  }
  </style>
</head>
<body>

<script src="../Assets/js/navbar.js"></script>

<div id="navbar-container"></div>

<canvas width="400" height="400" id="game"></canvas>

<!-- WHAT THE FREAK -->
<header>
    <h1>CYBER SNAKE!</h1>
    <p>Use ur arrow keys to move around and eat the planets</p>
</header>
<!-- WHY IS THIS THING SO UGLYYYYYYY -->


<script>
var canvas = document.getElementById('game');
var context = canvas.getContext('2d');

var grid = 16;
var count = 0;
  
var snake = {
  x: 160,
  y: 160,
  
  dx: grid,
  dy: 0,
  
  // grids the snake body occupies
  cells: [],
  
  // start length
  maxCells: 4
};
var apple = {
  x: 320,
  y: 320
};

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}

function loop() {
  requestAnimationFrame(loop);

  // speed of game 
  if (++count < 10) {
    return;
  }

  count = 0;
  context.clearRect(0,0,canvas.width,canvas.height);
  snake.x += snake.dx;
  snake.y += snake.dy;

  if (snake.x < 0) {
    snake.x = canvas.width - grid;
  }
  else if (snake.x >= canvas.width) {
    snake.x = 0;
  }
  
  if (snake.y < 0) {
    snake.y = canvas.height - grid;
  }
  else if (snake.y >= canvas.height) {
    snake.y = 0;
  }

  snake.cells.unshift({x: snake.x, y: snake.y});

  if (snake.cells.length > snake.maxCells) {
    snake.cells.pop();
  }

  // draw apple
  context.fillStyle = 'blue';
  context.fillRect(apple.x, apple.y, grid-1, grid-1);

  // draw snake one cell at a time
  context.fillStyle = 'teal';
  snake.cells.forEach(function(cell, index) {
    
    context.fillRect(cell.x, cell.y, grid-1, grid-1);  

    if (cell.x === apple.x && cell.y === apple.y) {
      snake.maxCells++;

      // grid size 
      apple.x = getRandomInt(0, 25) * grid;
      apple.y = getRandomInt(0, 25) * grid;
    }

    for (var i = index + 1; i < snake.cells.length; i++) {
      
      // snake occupies same space as a body part. reset game
      if (cell.x === snake.cells[i].x && cell.y === snake.cells[i].y) {
        snake.x = 160;
        snake.y = 160;
        snake.cells = [];
        snake.maxCells = 4;
        snake.dx = grid;
        snake.dy = 0;

        apple.x = getRandomInt(0, 25) * grid;
        apple.y = getRandomInt(0, 25) * grid;
      }
    }
  });
}

//keyboard logic
document.addEventListener('keydown', function(e) {

  // left 
  if (e.which === 37 && snake.dx === 0) {
    snake.dx = -grid;
    snake.dy = 0;
  }
  // up 
  else if (e.which === 38 && snake.dy === 0) {
    snake.dy = -grid;
    snake.dx = 0;
  }
  // right
  else if (e.which === 39 && snake.dx === 0) {
    snake.dx = grid;
    snake.dy = 0;
  }
  // down 
  else if (e.which === 40 && snake.dy === 0) {
    snake.dy = grid;
    snake.dx = 0;
  }
});

// start the game
requestAnimationFrame(loop);
</script>
</body>
</html>