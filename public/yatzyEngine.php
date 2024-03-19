<?php
include "config.php";

$rollCount = 0;
$roundCount = 0;
$score = array();
$diceAvalibility = array();
$scoreAvalibility = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$status = $_REQUEST['status'];
$dices = array(1,2,3,4,5);
if ($status==0){

// for ($i = 0; $i < 5; $i++) {
//     echo json_encode($dices[$i]);
//     // echo json_encode($dice1);

// }
}
$rollCount++;
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
$rollCount++;
    for ($i = 0; $i < 5; $i++) {
        if ($diceAvalibility[$i] === 0) {
            $dices[$i] = (rand(1, 6));
            echo json_encode($dices[$i]);
        }
    }

// if (isset($_POST["array"])) {
//     $diceAvalibility = $_POST["array"];
//     echo json_encode("sdiceAvaibla");
 

// }

// if ($scoreAvalibility[0] === 0) {
//     echo json_encode(calculateOnes($dices));
//          }
//          if ($scoreAvalibility[1] === 0) {
//             echo json_encode(calculateTwos($dices));
//         }
//         if ($scoreAvalibility[2] === 0) {
//             echo json_encode(calculateThrees($dices));
//         }
//          if ($scoreAvalibility[3] === 0) {
//             echo json_encode(calculateFours($dices));
//         }
//         if ($scoreAvalibility[4] === 0) {
//                     echo json_encode(calculateFives($dices));
//                 }
//          if ($scoreAvalibility[5] === 0) {
//             echo json_encode(calculateSixes($dices));
//         }
//         if ($scoreAvalibility[6] === 0) {
//             echo json_encode(calculateThreeOfAKind($dices));
//         }
//         if ($scoreAvalibility[7] === 0) {
//             echo json_encode(calculateFourOfAKind($dices));
//         }
//         if ($scoreAvalibility[8] === 0) {
//             echo json_encode(calculateFullHouse($dices));
//         }
//         if ($scoreAvalibility[9] === 0) {
//             echo json_encode(calculateSmallStraight($dices));
//         }
// if ($scoreAvalibility[10] === 0) {
//     echo json_encode(calculateLargeStraight($dices));
// }
// if ($scoreAvalibility[11] === 0) {
//     echo json_encode(calculateChance($dices));
// }
// if ($scoreAvalibility[12] === 0) {
//     echo json_encode(calculateYahtzee($dices));
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




function rollDice()
{
    global $rollCount, $dices, $diceAvalibility ;
    $rollCount++;
    // for ($i = 0; $i < 13; $i++) {
    //     array_push($scoreAvalibility, 0);
    // }
    for ($i = 0; $i < 5; $i++) {
        if ($diceAvalibility[$i] === 0) {
            $dices[$i] = (rand(1, 6));
        }
    }
    // foreach ($diceElements as $dice) {
    //     $dice.addEventListener("click", onDiceClick);
    // }
    // changeDiceFaces($dices);
    // writeScore($dices);
    return $dices;
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
