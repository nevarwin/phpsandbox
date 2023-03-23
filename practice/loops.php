<?php

// For loop
for ($i = 1; $i <= 10; $i++) {
    echo $i . '<br>';
}

// While loop
$k = 1;
while ($k <= 10) {
    echo $k . '<br>';
    $k++;
}

// Do while loop
$p = 1;
do {
    echo 'hello ' . $p . '<br>';
    $p++;
} while ($p <= 10);

// Foreach loop
$colors = ['red', 'green', 'blue'];

foreach ($colors as $color) {
    echo "$color <br>";
}

$colorDesc = ['red' => 'bright', 'green' => 'peace', 'blue' => 'ocean'];

foreach ($colorDesc as $color => $desc) {
    echo "$color is $desc <br>";
}
