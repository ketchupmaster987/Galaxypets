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
    indices.forEach((i) => {
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
    } else {
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
    } else {
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
    cards.forEach(c => {
        c.removeEventListener('click', cardFlip)
        c.style.cursor = 'auto'
    })
}

function enableClicks() {
    const cards = document.querySelectorAll('.card:not(.matched)')
    cards.forEach(c => {
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


window.onbeforeunload = function returnScore(){
    sessionStorage.setItem("points", score);
    //launch seperate php
    //have the phpfile load on close
    window.location("scoreADDer.php");

}