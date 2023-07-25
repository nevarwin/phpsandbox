<?php

$business = [
    'name' => 'Laracast',
    'cost' => '500',
    'subjects' => ['php', 'js', 'laravel'],

];

function userLogin($userName, $password) {
    if ($userName === 'raven' && $password === 'admin') {
        echo 'You successfully logged in';
    } else {
        echo 'Wrong username or password';
    }
}


require "laracastQuiz.view.php";
