<?php
include("connection.php");

//create connection to the database
$conn = new mysqli($servername, $username, $password, $database);

//check connection
if ($conn->connect_error) {
    // die equivalent to exit
    die("Connection failed: " . $conn->connect_error);
}

// read all the data from db table
// $sql = "SELECT * FROM clients";
$sql = "SELECT barangay
        FROM barangay";
$result = $conn->query($sql);

// check if there is data in the table
if (!$result) {
    die('Invalid Query: ' . $conn->error);
}
// $mysqli->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Left Join</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

</head>

<body>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="radioDefault" id="formRadioDefault">
        <label class="form-check-label" for="formRadioDefault">Default radio</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="radioDefault" id="formRadioChecked" checked="">
        <label class="form-check-label" for="formRadioChecked">Default checked radio</label>
    </div>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
            Dropdown button
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown button
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php
            $sql = "SELECT barangay FROM barangay";
            $results = $conn->query($sql);
            if ($results->num_rows) {
                while ($row = $results->fetch_object()) {
                    echo "
                        <a class='dropdown-item' href='#'>
                        {$row->barangay}
                        </a>";
                }
            }
            ?>
        </div>
    </div>
    <select title="Barangay">
        <?php
        $sql = "SELECT barangay FROM barangay";
        $results = $conn->query($sql);
        if ($results->num_rows) {
            while ($row = $results->fetch_object()) {
                echo " 
                    <option value='$row->barangay'>
                    <a class='dropdown-item' href='#'>
                        $row->barangay
                    </a>
                    </option>
                        
                ";
            }
        }
        ?>

    </select>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>