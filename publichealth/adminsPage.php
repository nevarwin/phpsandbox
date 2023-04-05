<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try DB CRUD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="con">
        <div class="navigation">
            <ul>
                <li>
                    <!-- title -->
                    <a href="index.php">
                        <span class="icon"><ion-icon name="medkit-outline"></ion-icon>
                        </span>
                        <span class="title">Public Health Disease </span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Admins</span>
                    </a>
                </li>
                <li>
                    <a href="patient.php">
                        <span class="icon"><ion-icon name="cube-outline"></ion-icon>
                        </span>
                        <span class="title">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="settings-outline"> </ion-icon>
                        </span>
                        <span class="title">
                            <?php
                            echo $user_data['name'];
                            ?>
                            Settings
                        </span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="map-outline"></ion-icon>
                        </span>
                        <span class="title">Map</span>
                    </a>
                </li>
                <li>
                    <a href="signout.php">
                        <span class="icon"><ion-icon name="log-in-outline"></ion-icon>
                        </span>
                        <span class="title">Sign out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- hamber menu -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <!-- Admin Card -->
        <div class="cardBox">
            <div class="card1">
                <div>
                    <div class="numbers">
                        <?php

                        $servername = 'localhost';
                        $username = 'root';
                        $password = '';
                        $database = 'publichealthdb';

                        //create connection to the database
                        $conn = new mysqli($servername, $username, $password, $database);

                        $adminCountSql = "SELECT * from clients";
                        $result = $conn->query($adminCountSql);
                        $adminCount = mysqli_num_rows($result);
                        echo "
                        $adminCount
                        ";
                        ?>
                    </div>
                    <div class="cardName">Admins</div>
                </div>
                <div class="iconBx"><ion-icon name="person-outline"></ion-icon></div>
            </div>
        </div>
        <div class="container my-5">
            <h2>Admins</h2>
            <a href="/phpsandbox/publichealth/createAdmin.php" class='btn btn-primary' role="button">New Item in DB</a>
            <br>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Barangay</th>
                        <th>Municipality</th>
                        <th>Created At</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
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
                    $sql = "SELECT clients.*, barangay.barangay, municipality.municipality
                    FROM clients
                    LEFT JOIN barangay ON clients.barangay = barangay.id 
                    LEFT JOIN municipality ON clients.municipality = municipality.munId";
                    $result = $conn->query($sql);

                    // check if there is data in the table
                    if (!$result) {
                        die('Invalid Query: ' . $conn->error);
                    }

                    while ($row = $result->fetch_object()) {
                        echo "
                        <tr>
                        <td>$row->name</td>
                        <td>$row->email</td>
                        <td>$row->contact_number</td>
                        <td>$row->address</td>
                        <td>$row->barangay</td>
                        <td>$row->municipality</td>
                        <td>$row->created_at</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/phpsandbox/publichealth/editAdmin.php?id=$row->id'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/phpsandbox/publichealth/deleteAdmin.php?id=$row->id'>Delete</a>
                        </td>
                        </tr>
                    ";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- ionicons installation -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        // menu toggle
        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");

        toggle.onclick = function() {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };

        // add hovered class in selected list item
        let list = document.querySelectorAll(".navigation li");

        function activeLink() {
            list.forEach((item) => item.classList.remove("hovered"));
            this.classList.add("hovered");
        }
        list.forEach((item) => item.addEventListener("mouseover", activeLink));
    </script>
</body>

</html>