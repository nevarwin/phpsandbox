<?php
$string1 = 'hello';
$string2 = 'darkness';
$concat1 = $string1 . ' ' . $string2 . ' ' . 'my old friend'; // concatination of strings
$concat2 = "$string1 $string2"; // using double quote to parse the string

$aray = ['aray', 'ko', 'po'];
$aray[] = 'nakakasama ng loob globe';
echo $aray[3];

$num1 = 1;
$num2 = 2;

if ($num1 xor $num2) {
    echo 'true';
} else {
    echo 'false';
}
