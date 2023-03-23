<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "123";
$dbname = "loginsample";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
  die("connection failed!");
}
