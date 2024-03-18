<?php
$rollCount = 0;
$diceAvalibility = [0, 0, 0, 0, 0];
$dices = [1, 2, 3, 4, 5];

function roll()
{
    $x = rand(1, 6);
    return $x;
}
