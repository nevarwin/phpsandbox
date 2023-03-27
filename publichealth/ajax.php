<?php

include('connection.php');

$municipalityId = isset($_POST['municipalityId']) ? $_POST['municipalityId'] : 0;
$barangayId = isset($_POST['barangayId']) ? $_POST['barangayId'] : 0;
$command = isset($_POST['get']) ? $_POST['get'] : "";

switch ($command) {
    case "municipality":
        $statement = "SELECT id,municipality FROM municipality";
        $dt = mysqli_query($conn, $statement);
        while ($result = mysqli_fetch_array($dt)) {
            echo $result1 = "<option value=" . $result['id'] . ">" . $result['municipality'] . "</option>";
        }
        break;

    case "barangay":
        $result1 = "<option>Select Barangay</option>";
        $statement = "SELECT id,barangay FROM barangay WHERE muncityId=" . $municipalityId;
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['id'] . ">" . $result['barangay'] . "</option>";
        }
        echo $result1;
        break;
}

exit();
