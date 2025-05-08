<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tic Tac toe</title>

    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="C4/css/style.css">
    <script src="../../Assets/js/navbar.js"></script>
</head>
<body>

<header class="border-bottom sticky-top">
    <div id="navbar-container"></div>
</header>

<main>
    <div id="tic-tac-toe">
        <div class="span3 new_span">
            <div class="row">
                <h1 class="span3">Tic Tac Toe</h1>
                <div class="span3">
                    <div class="input-prepend input-append">
                        <span class="add-on win_text">O won</span><strong id="o_win" class="win_times add-on">0</strong><span class="add-on">time(s)</span>
                    </div>
                    <div class="input-prepend input-append">
                        <span class="add-on win_text">X won</span><strong id="x_win" class="win_times add-on">0</strong><span class="add-on">time(s)</span>
                    </div>
                </div>
            </div>

            <ul class="row" id="game">
                <li id="one" class="btn span1" >+</li>
                <li id="two" class="btn span1">+</li>
                <li id="three" class="btn span1">+</li>
                <li id="four" class="btn span1">+</li>
                <li id="five" class="btn span1">+</li>
                <li id="six" class="btn span1">+</li>
                <li id="seven" class="btn span1">+</li>
                <li id="eight" class="btn span1">+</li>
                <li id="nine" class="btn span1">+</li>
            </ul>
            <div class="clr">&nbsp;</div>
            <div class="row"><a href="#" id="reset" class="btn-success btn span3" >Restart</a>
            </div>
        </div>
    </div>
</main>

<footer>

</footer>

<script>
    // JavaScript Document
    document.addEventListener("DOMContentLoaded", function () {
        const x = "x";
        const o = "o";
        let count = 0;
        let o_win = 0;
        let x_win = 0;

        const cells = Array.from(document.querySelectorAll("#game li"));
        const oWinDisplay = document.getElementById("o_win");
        const xWinDisplay = document.getElementById("x_win");

        function checkWin(letter) {
            const ids = [
                "one", "two", "three",
                "four", "five", "six",
                "seven", "eight", "nine"
            ];
            const get = (id) => document.getElementById(id).classList.contains(letter);

            return (
                (get("one") && get("two") && get("three")) ||
                (get("four") && get("five") && get("six")) ||
                (get("seven") && get("eight") && get("nine")) ||
                (get("one") && get("four") && get("seven")) ||
                (get("two") && get("five") && get("eight")) ||
                (get("three") && get("six") && get("nine")) ||
                (get("one") && get("five") && get("nine")) ||
                (get("three") && get("five") && get("seven"))
            );
        }

        function resetBoard() {
            cells.forEach(cell => {
                cell.textContent = "+";
                cell.classList.remove("disable", "o", "x", "btn-primary", "btn-info");
            });
            count = 0;
        }

        cells.forEach(cell => {
            cell.addEventListener("click", function () {
                if (checkWin("o")) {
                    alert("O has won the game. Start a new game");
                    resetBoard();
                    return;
                }
                if (checkWin("x")) {
                    alert("X has won the game. Start a new game");
                    resetBoard();
                    return;
                }

                if (count === 9) {
                    alert("It's a tie. It will restart.");
                    resetBoard();
                    return;
                }

                if (cell.classList.contains("disable")) {
                    alert("Already selected");
                    return;
                }

                if (count % 2 === 0) {
                    count++;
                    cell.textContent = o;
                    cell.classList.add("disable", "o", "btn-primary");
                    if (checkWin("o")) {
                        alert("O wins");
                        o_win++;
                        oWinDisplay.textContent = o_win;
                        count = 0;
                    }
                } else {
                    count++;
                    cell.textContent = x;
                    cell.classList.add("disable", "x", "btn-info");
                    if (checkWin("x")) {
                        alert("X wins");
                        x_win++;
                        xWinDisplay.textContent = x_win;
                        count = 0;
                    }
                }
            });
        });

        document.getElementById("reset").addEventListener("click", resetBoard);
    });
</script>

</body>
</html>