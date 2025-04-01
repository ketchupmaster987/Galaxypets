const alienImage = document.getElementById('alienImage');
const colorCircles = document.querySelectorAll('.color-circle');
const alienCircles = document.querySelectorAll('.alien-circle');
const stateCircles = document.querySelectorAll('.state-circle');
const devInfo = document.querySelector('.dev-info');

let currentColor = "lightpurple";
let currentAlien = "jelly"
let currentState = "normal";

colorCircles.forEach(circle => {
    circle.addEventListener('click', () => {
        currentColor = circle.getAttribute('data-color');
        if (currentState === "normal") {
            alienImage.src = `/Assets/img/${currentAlien}/${currentColor}.png`;
        }
        else {
            alienImage.src = `/Assets/img/${currentAlien}/${currentState}/${currentColor}.png`;
        }
    });
});

alienCircles.forEach(circle => {
    circle.addEventListener('click', () => {
        currentAlien = circle.getAttribute('data-color');
        if (currentState === "normal") {
            alienImage.src = `/Assets/img/${currentAlien}/${currentColor}.png`;
        }
        else {
            alienImage.src = `/Assets/img/${currentAlien}/${currentState}/${currentColor}.png`;
        }
    })
})

stateCircles.forEach(circle => {
    circle.addEventListener('click', () => {
        const selectedColor = circle.getAttribute('data-color');
        currentState = selectedColor;
        if (selectedColor === "normal") {
            alienImage.src = `/Assets/img/${currentAlien}/${currentColor}.png`;
        }
        else {
            alienImage.src = `/Assets/img/${currentAlien}/${selectedColor}/${currentColor}.png`;
        }
    })
})

const expand = document.querySelector('.expand-dev');
document.querySelector('.down-arrow').addEventListener("click", () => {
    devInfo.style.display = "none";
    expand.style.display = "block";
});

expand.addEventListener("click", () => {
    devInfo.style.display = "block";
    expand.style.display = "none";
})