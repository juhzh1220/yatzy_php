<?php
session_start();

include "config.php";

$rollCount = 0;
$roundCount = 0;
$score = array();
$diceAvalibility = array();
$scoreAvalibility = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$status = $_REQUEST['status'];
$dices = array(1,2,3,4,5);
$previousDice= array();
if ($status==0){
$dice1 = $_REQUEST['dice1'];
$dice2 = $_REQUEST['dice2'];
$dice3 = $_REQUEST['dice3'];
$dice4 = $_REQUEST['dice4'];
$dice5 = $_REQUEST['dice5'];
$diceAvalibility[0]=(int)$dice1;
$diceAvalibility[1]=(int)$dice2;
$diceAvalibility[2]=(int)$dice3;
$diceAvalibility[3]=(int)$dice4;
$diceAvalibility[4]=(int)$dice5;
rollDice();
 
    for ($i = 0; $i < 5; $i++) {

            echo json_encode($dices[$i]);

    }

// for ($i = 0; $i < 5; $i++) {
//     echo json_encode($dices[$i]);
//     // echo json_encode($dice1);

// }
}
elseif($status == 1){
    $dice1 = $_REQUEST['num1'];
    $dice2 = $_REQUEST['num2'];
    $dice3 = $_REQUEST['num3'];
    $dice4 = $_REQUEST['num4'];
    $dice5 = $_REQUEST['num5'];
    $previousDice[0]=(int)$dice1;
    $previousDice[1]=(int)$dice2;
    $previousDice[2]=(int)$dice3;
    $previousDice[3]=(int)$dice4;
    $previousDice[4]=(int)$dice5;
    for ($i = 0; $i < 5; $i++) {

        echo json_encode($previousDice[$i]);echo " ";

}

writeScore($previousDice);






}
if($status==3){
    $x = $_REQUEST['variable'];
    $y = (int)$x;
if (empty($_SESSION["res"])) {
    $_SESSION["res"]=[0,0,0,0,0,0,0,0,0,0]; 
 } else {
    if($x>$_SESSION["res"][9]){
        unset($_SESSION["res"][9]);
        array_push($_SESSION["res"], $x);
        arsort($_SESSION["res"]);
        

    }
    
    print_r($_SESSION["res"]);
 }
}

// if (isset($_REQUEST["array"])) {
//     $diceAvalibility = $_REQUEST["array"];
    // echo json_encode("sdiceAvaibla");
 

// }



// echo json_encode(calculateOnes($dice));
// echo json_encode(calculateTwos($dice));
// echo json_encode(calculateThrees($dice));
// echo json_encode(calculateFours($dice));
// echo json_encode(calculateFives($dice));
// echo json_encode(calculateSixes($dice));
// echo json_encode(calculateThreeOfAKind($dice));
// echo json_encode(calculateFourOfAKind($dice));
// echo json_encode(calculateFullHouse($dice));
// echo json_encode(calculateSmallStraight($dice));
// echo json_encode(calculateLargeStraight($dice));
// echo json_encode(calculateChance($dice));
// echo json_encode(calculateYahtzee($dice));



function writeScore($dices){
    global $scoreAvalibility;
    if ($scoreAvalibility[0] == 0) {
        echo json_encode(calculateOnes($dices));
        echo " ";
             }
             if ($scoreAvalibility[1] == 0) {
                echo json_encode(calculateTwos($dices));
                echo " ";
            }
            if ($scoreAvalibility[2] == 0) {
                echo json_encode(calculateThrees($dices));echo " ";
            }
             if ($scoreAvalibility[3] == 0) {
                echo json_encode(calculateFours($dices));echo " ";
            }
            if ($scoreAvalibility[4] == 0) {
                        echo json_encode(calculateFives($dices));echo " ";
                    }
             if ($scoreAvalibility[5] == 0) {
                echo json_encode(calculateSixes($dices));echo " ";
            }
            if ($scoreAvalibility[6] == 0) {
                echo json_encode(calculateThreeOfAKind($dices));echo " ";
            }
            if ($scoreAvalibility[7] == 0) {
                echo json_encode(calculateFourOfAKind($dices));echo " ";
            }
            if ($scoreAvalibility[8] == 0) {
                echo json_encode(calculateFullHouse($dices));echo " ";
            }
            if ($scoreAvalibility[9] == 0) {
                echo json_encode(calculateSmallStraight($dices));echo " ";
            }
    if ($scoreAvalibility[10] == 0) {
        echo json_encode(calculateLargeStraight($dices));echo " ";
    }
    if ($scoreAvalibility[11] == 0) {
        echo json_encode(calculateChance($dices));echo " ";
    }
    if ($scoreAvalibility[12] == 0) {
        echo json_encode(calculateYahtzee($dices));echo " ";
    }
    

}
function rollDice()
{
    global $rollCount, $dices, $diceAvalibility ;
    // for ($i = 0; $i < 13; $i++) {
    //     array_push($scoreAvalibility, 0);
    // }
    $rollCount++;
    for ($i = 0; $i < 5; $i++) {
        if ($diceAvalibility[$i] === 0) {
            $dices[$i] = (rand(1, 6));
        }
        // else{
        //      $dices[$i] = (rand(1, 6));
        // }
    }

    // foreach ($diceElements as $dice) {
    //     $dice.addEventListener("click", onDiceClick);
    // }
    // changeDiceFaces($dices);
    // writeScore($dices);
    
    // if ($rollCount == 3) {
    //     $rollButton.disabled = true;
    //     $rollButton.style.opacity = 0.5;
    //     foreach ($cells as $cell) {
    //         if ($scoreAvalibility[$cell.getAttribute("data-row")] === 0) {
    //             $cell.addEventListener("click", onCellClick);
    //         }
    //     }
    // }
}



function calculateOnes($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] === 1) {
            $score += 1;
        }
    }
    return $score;
}

function calculateTwos($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] === 2) {
            $score += 2;
        }
    }
    return $score;
}

function calculateThrees($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] === 3) {
            $score += 3;
        }
    }
    return $score;
}

function calculateFours($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] === 4) {
            $score += 4;
        }
    }
    return $score;
}

function calculateFives($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] === 5) {
            $score += 5;
        }
    }
    return $score;
}

function calculateSixes($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] === 6) {
            $score += 6;
        }
    }
    return $score;
}

function calculateThreeOfAKind($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        $count = 1;
        for ($j = 0; $j < count($dice); $j++) {
            if ($j !== $i && $dice[$i] === $dice[$j]) {
                $count++;
            }
        }
        if ($count >= 3) {
            $score = array_reduce($dice, function ($acc, $val) {
                return $acc + $val;
            });
            break;
        }
    }
    return $score;
}

function calculateFourOfAKind($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        $count = 1;
        for ($j = 0; $j < count($dice); $j++) {
            if ($j !== $i && $dice[$i] === $dice[$j]) {
                $count++;
            }
        }
        if ($count >= 4) {
            $score = array_reduce($dice, function ($acc, $val) {
                return $acc + $val;
            });
            break;
        }
    }
    return $score;
}

function calculateFullHouse($dice)
{
    $score = 0;
    $diceCopy = $dice;
    sort($diceCopy);
    if (
        ($diceCopy[0] == $diceCopy[1] &&
            $diceCopy[1] == $diceCopy[2] &&
            $diceCopy[3] == $diceCopy[4]
        ) ||
        ($diceCopy[0] == $diceCopy[1] &&
            $diceCopy[2] == $diceCopy[3] &&
            $diceCopy[3] == $diceCopy[4]
        )
    ) {
        $score = 25;
        return $score;
    }
    return $score;
}

function calculateSmallStraight($dice)
{
    $score = 0;
    $diceCopy = array_unique($dice);
    sort($diceCopy);
    if (
        ($diceCopy[1] == $diceCopy[0] + 1 &&
            $diceCopy[2] == $diceCopy[1] + 1 &&
            $diceCopy[3] == $diceCopy[2] + 1
        ) ||
        ($diceCopy[2] == $diceCopy[1] + 1 &&
            $diceCopy[3] == $diceCopy[2] + 1 &&
            $diceCopy[4] == $diceCopy[3] + 1
        )
    ) {
        $score = 30;
    }
    return $score;
}

function calculateLargeStraight($dice)
{
    $score = 0;
    $diceCopy = array_unique($dice);
    sort($diceCopy);
    if (
        ($diceCopy[1] == $diceCopy[0] + 1 &&
            $diceCopy[2] == $diceCopy[1] + 1 &&
            $diceCopy[3] == $diceCopy[2] + 1 &&
            $diceCopy[4] == $diceCopy[3] + 1
        )
    ) {
        $score = 40;
    }
    return $score;
}

function calculateChance($dice)
{
    $score = 0;
    for ($i = 0; $i < count($dice); $i++) {
        $score += $dice[$i];
    }
    return $score;
}

function calculateYahtzee($dice)
{
    $firstDie = $dice[0];
    $score = 50;
    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] !== $firstDie) {
            $score = 0;
        }
    }
    return $score;
}