<?php
// indexed array
$a = array(1, 2, 3); //using array function in creating an array'
$aray = ['aray', 'ko', 'po'];
$aray[] = 'nakakasama ng loob globe';
echo 'text plus variable $a';
echo $aray[3];

// associative array is like a map
$b = array('one' => 1, 'two' => 2, 'three' => 3);
echo $b['one'];
echo $b['three'];

// multidimentional array
$c = [
    ['honda', 1, 2],
    ['toyota', 3, 4],
    ['ford', 5, 6],
];
echo $c[0][0];

echo var_dump($a);
print_r($aray);
