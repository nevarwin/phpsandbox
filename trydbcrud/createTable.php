<?php
include("connection.php");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    printf('connection failed', $mysqli->connect_error);
    exit();
}

$sql = "CREATE TABLE IF NOT EXISTS barangay(
    id INT(11) NOT NULL AUTO_INCREMENT,
    barangay VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
)";

if ($mysqli->query($sql) === TRUE) {
    echo 'Table created';
}

if ($mysqli->errno) {
    echo ("Table not created" . $mysqli->error);
}

$mysqli->close();
