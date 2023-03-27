<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "123";
$dbname = "publichealthdb";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
  die("Could not connect to MySql Server");
}
