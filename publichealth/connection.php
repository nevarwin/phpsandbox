<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "publichealthdb";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
  die("Could not connect to MySql Server");
}
