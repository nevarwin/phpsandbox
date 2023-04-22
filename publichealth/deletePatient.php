<?php
if (isset($_GET['patientId'])) {
    $patientId = $_GET['patientId'];

    include("connection.php");

    //create connection to the database
    // $conn = new mysqli($servername, $username, $password, $database);

    //check connection
    if (mysqli_connect_errno()) {
        // die equivalent to exit
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM patients WHERE patientId = $patientId";
    mysqli_query($con, $sql);

    header('location: /phpsandbox/publichealth/patient.php');
    exit;
}
