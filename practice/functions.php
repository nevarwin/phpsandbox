<?php

// Functions
function myFunction() {
    echo "Hellow";
}

myFunction();

function addNumber($num1, $num2) {
    return $num1 + $num2;
}

echo addNumber(2, 3) . '<br>';

function add($num) {
    echo $num + 10 . '<br>';
}

add(1);

// By reference
$five = 10;

function addFive($num) {
    echo $num + 5 . '<br>';
}

function addTen(&$num) {
    echo $num + 10 . '<br>';
}

addFive($five);
addTen($five);
