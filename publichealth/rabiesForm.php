<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

// Determine the total number of records and the number of records per page
$totalRecords = mysqli_query($con, "SELECT COUNT(*) FROM rabiesinfotbl ")->fetch_array()[0];
// to edit how many fields in the web
$recordsPerPage = 10;

// Determine the current page number and the starting record for the page
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
$startRecord = ($currentPage - 1) * $recordsPerPage;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabies Form Page</title>
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
                <!-- <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li> -->
                <li>
                    <a href="admin.php">
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
        <div class="container my-5">
            <div class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php
                    // Determine the current page number and the starting record for the page
                    if (isset($_GET['page'])) {
                        $currentPage = $_GET['page'];
                    } else {
                        $currentPage = 1;
                    }
                    $startRecord = ($currentPage - 1) * $recordsPerPage;
                    // Add links to navigate between the pages
                    $totalPages = ceil($totalRecords / $recordsPerPage);
                    if ($totalPages > 1) {
                        if ($currentPage > 1) {
                            echo "<li class='page-item'><a class='page-link' href=\"?page=" . ($currentPage - 1) . "\">Previous</a>";
                        }
                        // old code with class
                        // if ($currentPage > 1) {
                        //     echo "<li class='page-item disabled'> <a class='page-link' aria-disabled='true' tabindex='-1' href=\"?page=" . ($currentPage - 1) . "\">Previous</a></li>";
                        // }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            if ($i == $currentPage) {
                                echo "<li class='page-item active'><a class='page-link'>" . $i . "</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href=\"?page=" . $i . "\">" . $i . "</a></li>";
                            }
                        }
                        if ($currentPage < $totalPages) {
                            echo "<li class='page-item'><a class='page-link' href=\"?page=" . ($currentPage + 1) . "\">Next</a>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="container my-5 overflow-auto" style="max-height: calc(100vh - 100px); overflow-y: auto;">
            <h2>Admins</h2>
            <a href=" /phpsandbox/publichealth/rabiesForm-create.php" class='btn btn-primary' role="button">Add New Rabies Form</a>
            <br>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Disease ID</th>
                        <th>Rabies Info ID</th>
                        <th>Patient ID</th>
                        <th>Type of Exposure</th>
                        <th>Category</th>
                        <th>Bite Site</th>
                        <th>Date Bitten</th>
                        <th>Type of Animal</th>
                        <th>Animal Status</th>
                        <th>Date Vaccination Started</th>
                        <th>Wound Cleaned</th>
                        <th>Rabies Vaccine</th>
                        <th>Animal Outcome</th>
                        <th>Case Class</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    // read all the data from db table
                    $sql = "SELECT *
                    FROM rabiesinfotbl
                    LIMIT $startRecord, $recordsPerPage
                    ";
                    $result = $con->query($sql);

                    // check if there is data in the table
                    if (!$result) {
                        die('Invalid Query: ');
                    }

                    while ($row = $result->fetch_object()) {
                        echo "
                        <tr>
                        <td>$row->diseaseId</td>
                        <td>$row->rabiesInfoId</td>
                        <td>$row->patientId</td>
                        <td>$row->typeOfExposure</td>
                        <td>$row->category</td>
                        <td>$row->biteSite</td>
                        <td>$row->dateBitten</td>
                        <td>$row->typeOfAnimal</td>
                        <td>$row->animalStatus</td>
                        <td>$row->dateVaccStarted</td>
                        <td>$row->woundCleaned</td>
                        <td>$row->rabiesVaccine</td>
                        <td>$row->animalOutcome</td>
                        <td>$row->caseClass</td>
                        <td>
                            <a class='btn btn-info btn-sm' href='/phpsandbox/publichealth/rabiesForm-view.php?rabiesInfoId=$row->rabiesInfoId'>View</a>
                            <a class='btn btn-primary btn-sm' href='/phpsandbox/publichealth/rabiesForm-edit.php?rabiesInfoId=$row->rabiesInfoId'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/phpsandbox/publichealth/rabiesForm-delete.php?rabiesInfoId=$row->rabiesInfoId'>Delete</a>
                        </td>
                        </tr>
                    ";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-TTTUxJ33FLw0+wD/b5r5QUNl5LdJKT7GZZkpu0NfAW32+MBu+jv+3q7Vbe12lFH0" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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