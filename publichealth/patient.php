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
                    <a href="adminsPage.php">
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
            <!-- <div class="search">
                <label for="">
                    <input type="text" placeholder="Search here" />
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <div class="user">
                <img src="user.jpg" alt="" />
            </div> -->
        </div>
        <!-- cards -->
        <div class="cardBox">
            <!-- <div class="card1">
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
            </div> -->
            <div class="card1">
                <div>
                    <div class="numbers">
                        <?php
                        include("connection.php");
                        $rabiesCount = "SELECT * from patients WHERE disease = 13";
                        $result = $conn->query($rabiesCount);
                        $rabiesCases = mysqli_num_rows($result);
                        echo "
                            $rabiesCases
                        ";
                        ?>
                    </div>
                    <div class="cardName">Rabies</div>
                </div>
                <div class="iconBx"><ion-icon name="medical-outline"></ion-icon></div>
            </div>
            <div class="card1">
                <div>
                    <div class="numbers">19</div>
                    <div class="cardName">Malaria</div>
                </div>
                <div class="iconBx"><ion-icon name="medical-outline"></ion-icon></div>
            </div>
            <div class="card1">
                <div>
                    <div class="numbers">58</div>
                    <div class="cardName">TB</div>
                </div>
                <div class="iconBx"><ion-icon name="medical-outline"></ion-icon></div>
            </div>
        </div>
        <div class="container my-5">
            <h2>Patients</h2>
            <a href="/phpsandbox/publichealth/createPatient.php" class='btn btn-primary' role="button">New Item in DB</a>
            <br>
            <table class='table'>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Disease</th>
                        <th>Outcome</th>
                        <th>Date of Birth</th>
                        <th>Age</th>
                        <th>Barangay</th>
                        <th>Municipality</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("connection.php");
                    // read all the data from db table
                    $sql = "SELECT *
                    FROM patients
                    LEFT JOIN barangay ON patients.barangay = barangay.id
                    LEFT JOIN municipality ON patients.municipality = municipality.munId
                    LEFT JOIN diseases ON patients.disease = diseases.diseaseId
                    -- LEFT JOIN outcomes ON patients.outcome = outcomes.outcomeId
                    LEFT JOIN genders ON patients.gender = genders.genderId
                    ";

                    $result = $con->query($sql);

                    // check if there is data in the table
                    if (!$result) {
                        die('Invalid Query: ' . $con->error);
                    }

                    while ($row = $result->fetch_object()) {
                        // <td>$row->outcome</td>
                        echo "
                        <tr>
                        <td>$row->firstName</td>
                        <td>$row->lastName</td>
                        <td>$row->gender</td>
                        <td>$row->disease</td>
                        <td>$row->dob</td>
                        <td>$row->age</td>
                        <td>$row->barangay</td>
                        <td>$row->municipality</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/phpsandbox/publichealthdbcrud/editPatient.php?id=$row->patientId'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/phpsandbox/publichealthdbcrud/deletePatient.php?id=$row->patientId'>Delete</a>
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