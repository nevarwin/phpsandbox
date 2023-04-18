<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

//create connection to the database
// $conn = new mysqli($servername, $username, $password, $database);

$id = '';
$name = '';
$email = '';
$password = '';
$contact = '';
$address = '';

$errorMessage = '';
$successMessage = '';

// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//GET Method: show the data of the client
if (!isset($_GET["id"])) {
    header('location: /phpsandbox/publichealthd/index.php');
    exit;
}

$id = $_GET['id'];
// read row 
$sql = "SELECT * FROM clients WHERE id = $id";
// execute the sql query
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();

if (!$row) {
    header('location: /phpsandbox/publichealth/index.php');
    exit;
}

$name = $row['name'];
$email = $row['email'];
$password = $row['password'];
$contact = $row['contact_number'];
$address = $row['address'];
$municipality = $row['municipality'];
$barangay = $row['barangay'];

// POST Method: Update the data of the client
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];

    // check if the data is empty
    do {
        if (empty($name) or empty($email) or empty($password)  or empty($contact) or empty($address) or empty($municipality) or empty($barangay)) {
            $errorMessage = "All fields are required";
            break;
        }
        // if ($password != $confirmPassword) {
        //     $errorMessage = "Password and Confirm Password must be the same";
        //     break;
        // }
        // update data into the db
        $sql = "UPDATE `clients` SET `name` = '$name', `email` = '$email',`password` = '$password', `contact_number` = '$contact', `address` = '$address', `municipality` = '$municipality', `barangay` = '$barangay' WHERE id = $id";

        if ($con->query($sql) === TRUE) {
            echo "Record updated successfully";
            $successMessage = "Client added correctly";
        } else {
            echo "Error updating record: ";
        }

        header("location: /phpsandbox/publichealth/admin.php");
        $con->close();
    } while (false);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item in DB</title>
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
            <h2>Edit Client</h2>

            <?php
            if (!empty($errorMessage)) {
                echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type = 'button' class = 'btn-close' data-bs-dismissible = 'alert' aria-label = 'Close'></button>
            </div>
            ";
            }
            ?>
            <form action="" method="post">
                <input type="hidden" name='id' value='<?php echo $id     ?>'>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Name</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='name' value='<?php echo $name; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Email</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='email' value='<?php echo $email; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Password</label>
                    <div class="col-sm-6">
                        <input type="password" class='form-control' name='password' value='<?php echo $password; ?>'>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Contact Number</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='contact' value='<?php echo $contact; ?>'>
                    </div>
                </div>
                <!-- Municipality Dropdown -->
                <div class="row mb-3">
                    <label class='col-sm-3 col-form-label' for="municipality">Municipality</label>
                    <div class="col-sm-6">
                        <select class="form-select" id="municipality" onchange="updateBarangays()" name="municipality">
                            <option value="">Select municipality</option>
                            <?php
                            // Connect to database and fetch municipalities
                            $dbhost = "localhost";
                            $dbuser = "root";
                            $dbpass = "";
                            $dbname = "publichealthdb";

                            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                            $result = mysqli_query($conn, 'SELECT * FROM municipality');

                            // Display each municipalities in a dropdown option
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['munId'] . '">' . $row['municipality'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Barangay Dropdown -->
                <div class="row mb-3">
                    <label class='col-sm-3 col-form-label' for="barangay">Barangay</label>
                    <div class="col-sm-6">
                        <select class="form-select" id="barangay" name="barangay">
                            <option>Select Barangay</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Address</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='address' value='<?php echo $address; ?>'>
                    </div>
                </div>


                <?php
                if (!empty($successMessage)) {
                    echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dimissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type = 'button' class = 'btn-close' data-bs-dismissible = 'alert' aria-label = 'Close'></button>
                        </div>
                    </div>
                </div>
                ";
                }
                ?>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class='btn btn-primary'>Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a href="/phpsandbox/publichealth/admin.php" class="btn btn-outline-primary" role="button">Cancel</a>
                    </div>
                </div>
        </div>
    </div>

    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateBarangays() {
            const municipalitySelect = document.getElementById('municipality');
            const barangaySelect = document.getElementById('barangay');
            const selectedMunicipality = municipalitySelect.value;

            // Clear barangay dropdown
            barangaySelect.innerHTML = '';

            if (selectedMunicipality) {
                // Fetch barangays for selected country using AJAX
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        const barangays = JSON.parse(this.responseText);

                        // Populate barangay dropdown
                        barangays.forEach(function(barangay) {
                            const option = document.createElement('option');
                            option.text = barangay.barangay;
                            option.value = barangay.id;
                            barangaySelect.add(option);
                        });
                    }
                };
                xhr.open('GET', 'get_barangay.php?municipality=' + selectedMunicipality, true);
                xhr.send();
            }
        }
    </script>

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