var canvas, ctx;
var gameRunning = false;
var myGamePiece;
var myObstacles = [];
var myScore;
var frameCount = 0;
var gameInterval;

function startGame() {
    canvas = document.getElementById('gameCanvas');
    ctx = canvas.getContext('2d');
    canvas.width = 480;
    canvas.height = 270;

    myGamePiece = {
        width: 30,
        height: 30,
        x: 10,
        y: 120,
        gravity: 0.25,
        gravitySpeed: 0,
        speedX: 0,
        speedY: 0,
        color: "#800080",
        draw: function () {
            ctx.fillStyle = this.color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        },
        update: function () {
            this.gravitySpeed += this.gravity;
            this.y += this.speedY + this.gravitySpeed;
            this.checkBounds();
        },
        checkBounds: function () {
            if (this.y + this.height > canvas.height) {
                this.y = canvas.height - this.height;
                this.gravitySpeed = 0;
            }
            if (this.y < 0) {
                gameOver();
            }
        }
    };
    /*
    rocketImg.src = 'blue.png';

    // Create game piece that uses the image
    myGamePiece = {
        img: rocketImg,
        width: 30,
        height: 40,
        x: 10,
        y: 120,
        gravity: 0.25,
        gravitySpeed: 0,
        speedX: 0,
        speedY: 0,
        draw: function() {
            // Only draw if image is loaded
            if (this.img.complete) {
                ctx.drawImage(this.img, this.x, this.y, this.width, this.height);
            } else {
                ctx.fillStyle = "#FFFFFF";
                ctx.fillRect(this.x, this.y, this.width, this.height);
            }
        },
        update: function() {
            this.gravitySpeed += this.gravity;
            this.y += this.speedY + this.gravitySpeed;
            this.checkBounds();
        },
        checkBounds: function() {
            if (this.y + this.height > canvas.height) {
                this.y = canvas.height - this.height;
                this.gravitySpeed = 0;
            }
            if (this.y < 0) {
                gameOver();
            }
        }
    }; */

    myScore = {
        text: "SCORE: 0",
        x: 280,
        y: 40,
        update: function () {
            ctx.font = "30px Consolas";
            ctx.fillStyle = "white";
            ctx.fillText(this.text, this.x, this.y);
        }
    };

    gameRunning = true;
    frameCount = 0;
    myObstacles = [];
    document.getElementById('gameOver').style.display = 'none';
    gameInterval = setInterval(updateGame, 20);
}

function updateGame() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (var i = 0; i < myObstacles.length; i++) {
        if (checkCollision(myGamePiece, myObstacles[i])) {
            gameOver();
            return;
        }
    }

    frameCount++;

    if (frameCount == 1 || everyinterval(150)) {
        addObstacle();
    }

    for (var i = 0; i < myObstacles.length; i++) {
        myObstacles[i].x -= 1;
        myObstacles[i].draw();

        if (myObstacles[i].x + myObstacles[i].width < 0) {
            myObstacles.splice(i, 1);
            i--;
        }
    }

    myScore.text = "SCORE: " + frameCount;
    myScore.update();

    myGamePiece.update();
    myGamePiece.draw();
}

function addObstacle() {
    let minHeight = 20;
    let maxHeight = 200;
    let height = Math.floor(Math.random() * (maxHeight - minHeight + 1) + minHeight);
    let minGap = 50;
    let maxGap = 200;
    let gap = Math.floor(Math.random() * (maxGap - minGap + 1) + minGap);

    myObstacles.push({
        width: 10,
        height: height,
        x: canvas.width,
        y: 0,
        color: "#800080",
        draw: function () {
            ctx.fillStyle = this.color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    });

    myObstacles.push({
        width: 10,
        height: canvas.height - height - gap,
        x: canvas.width,
        y: height + gap,
        color: "#800080",
        draw: function () {
            ctx.fillStyle = this.color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    });
}

function checkCollision(obj1, obj2) {
    return !(
        obj1.x + obj1.width < obj2.x ||
        obj1.x > obj2.x + obj2.width ||
        obj1.y + obj1.height < obj2.y ||
        obj1.y > obj2.y + obj2.height
    );
}

function gameOver() {
    clearInterval(gameInterval);
    gameRunning = false;
    document.getElementById('finalScore').textContent = frameCount;
    document.getElementById('gameOver').style.display = 'block';
}

function resetGame() {
    startGame();
}

function everyinterval(n) {
    return (frameCount % n === 0);
}

function accelerate(n) {
    if (gameRunning) {
        myGamePiece.gravity = n;
    }
}

window.onload = startGame;