<?php
// Connect to database and fetch barangays for selected country
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "publichealthdb";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$municipality_id = $_GET['municipality'];
$result = mysqli_query($conn, "SELECT * FROM barangay WHERE muncityId = $municipality_id");

// Encode barangay as JSON and return
$barangays = array();
while ($row = mysqli_fetch_assoc($result)) {
    $barangays[] = $row;
}
echo json_encode($barangays);
