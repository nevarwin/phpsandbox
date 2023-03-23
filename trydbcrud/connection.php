<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "123";
$dbname = "trydb";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
  die("connection failed!");
}

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
