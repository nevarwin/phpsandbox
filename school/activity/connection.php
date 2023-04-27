<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "crudseries";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
  die("connection failed!");
}
