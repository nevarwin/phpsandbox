<?php
if (isset($_GET['rabiesInfoId'])) {
    $rabiesInfoId = $_GET['rabiesInfoId'];

    include("connection.php");

    //create connection to the database
    // $conn = new mysqli($servername, $username, $password, $database);

    //check connection
    if (mysqli_connect_errno()) {
        // die equivalent to exit
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM rabiesinfotbl WHERE rabiesInfoId = $rabiesInfoId";
    mysqli_query($con, $sql);

    header('location: /phpsandbox/publichealth/rabiesForm.php');
    exit;
}
