<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="gameboard">
        <div class="dice_area" id=dicearea>
            <div class="dice" id="die1" data-row="1"><img src="\public\design_system\dice1.png" class="img"></div>
            <div class="dice" id="die2" data-row="2"><img src="\public\design_system\dice1.png" class="img"></div>
            <div class="dice" id="die3" data-row="3"><img src="\public\design_system\dice1.png" class="img"></div>
            <div class="dice" id="die4" data-row="4"><img src="\public\design_system\dice1.png" class="img"></div>
            <div class="dice" id="die5" data-row="5"><img src="\public\design_system\dice1.png" class="img"></div>
        </div>
        <button id="rollButton" class="btn">ROLL</button>


    </div>
    <br><br>

    <table id="scoreboard">
        <tbody>
            <tr>
                <th></th>
                <td class="name bottom-player-name">You</td>
            </tr>
            <tr>
                <th>Ones</th>
                <td id="ones" data-row="0"></td>
            </tr>
            <tr>
                <th>Twos</th>
                <td id="twos" data-row="1"></td>
            </tr>
            <tr>
                <th>Threes</th>
                <td id="threes" data-row="2"></td>
            </tr>
            <tr>
                <th>Fours</th>
                <td id="fours" data-row="3"></td>
            </tr>
            <tr>
                <th>Fives</th>
                <td id="fives" data-row="4"></td>
            </tr>
            <tr>
                <th>Sixes</th>
                <td id="sixes" data-row="5"></td>
            </tr>
            <tr>
                <th>Three of a kind</th>
                <td id="three-of-a-kind" data-row="6"></td>
            </tr>
            <tr>
                <th>Four of a kind</th>
                <td id="four-of-a-kind" data-row="7"></td>
            </tr>
            <tr>
                <th>Full House</th>
                <td id="full-house" data-row="8"></td>
            </tr>
            <tr>
                <th>Small straight</th>
                <td id="small-straight" data-row="9"></td>
            </tr>
            <tr>
                <th>Large straight</th>
                <td id="large-straight" data-row="10"></td>
            </tr>
            <tr>
                <th>Chance</th>
                <td id="chance" data-row="11"></td>
            </tr>
            <tr>
                <th>YAHTZEE</th>
                <td id="yahtzee" data-row="12"></td>
            </tr>
            <tr>
                <th>TOTAL SCORE</th>
                <td id="total-score"></td>
            </tr>
        </tbody>
    </table>


    <script src="main.js">

    </script>
</body>

</html>
<?php
require_once('config.php');

require '/yatzy_php/app/models/dice.php';


for ($i = 1; $i <= 5; $i++) {
    $x = roll();
    echo "ROLL {$i}: {$x}<br>";
}
