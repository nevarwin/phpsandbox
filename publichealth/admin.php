<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

// Determine the total number of records and the number of records per page
$totalRecords = mysqli_query($con, "SELECT COUNT(*) FROM clients ")->fetch_array()[0];
// to edit how many fields in the web
$recordsPerPage = 1;

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
    <title>Admin Page</title>
    <link rel="shortcut icon" href="https://img.icons8.com/material-rounded/24/000000/administrator-male.png" type="image/x-icon">
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
        <!-- Admin Card -->
        <div class="cardBox">
            <div class="card1">
                <div>
                    <div class="numbers">
                        <?php
                        $adminCountSql = "SELECT * from clients";
                        $result = $con->query($adminCountSql);
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
            <a href="/phpsandbox/publichealth/createAdmin.php" class='btn btn-primary' role="button">Add new Admin</a>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // read all the data from db table
                    $sql = "SELECT clients.*, barangay.barangay, municipality.municipality
                    FROM clients
                    LEFT JOIN barangay ON clients.barangay = barangay.id 
                    LEFT JOIN municipality ON clients.municipality = municipality.munId
                    LIMIT $startRecord, $recordsPerPage
                    ";
                    $result = $con->query($sql);

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