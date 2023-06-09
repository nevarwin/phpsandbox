<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

// patient name
$patientId = '';
$fName = '';
$lName = '';
$mName = '';

$contact = '';
$address = '';
$addressDRU = '';

$errorMessage = '';
$successMessage = '';

// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//GET Method: show the data of the client
if (!isset($_GET["patientId"])) {
    header('location:/phpsandbox/publichealthd/patient.php');
    exit;
}

$patientId = $_GET['patientId'];
// read row 
$sql = "SELECT * FROM patients WHERE patientId = $patientId";
// execute the sql query
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();

if (!$row) {
    header('location: /phpsandbox/publichealth/patient.php');
    exit;
}

$fName = $row['firstName'];
$lName = $row['lastName'];
$mName = $row['middleName'];
$gender = $row['gender'];
$dob = $row['dob'];
$municipality = $row['municipality'];
$barangay = $row['barangay'];
$municipalityDRU = $row['munCityOfDRU'];
$barangayDRU = $row['brgyOfDRU'];
$disease = $row['disease'];
// $outcome = $row['outcome'];
$contact = $row['contact'];
$address = $row['address'];
$addressDRU = $row['addressOfDRU'];

// check if the form is submitted using the post method
// initialize data above into the post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the data from the Form
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $mName = $_POST['mName'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $municipalityDRU = $_POST['municipalityDRU'];
    $barangayDRU = $_POST['barangayDRU'];
    $disease = $_POST['disease'];
    // $outcome = $_POST['outcome'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $addressDRU = $_POST['addressDRU'];
    // $dateDied = $_POST['dateDied'];
    $currentDate = date("Y-m-d H:i:s");

    // check if the data is empty
    do {
        if (empty($fName) or empty($lName) or empty($municipality) or empty($barangay) or empty($municipalityDRU) or empty($barangayDRU) or empty($disease) or empty($contact) or empty($address) or empty($gender)) {
            $errorMessage = "All fields are required";
            break;
        }
        // added new data into the db
        $sql = "UPDATE patients SET `creationDate`='$currentDate', `firstName`='$fName', `lastName`='$lName', `middleName`='$mName', `munCityOfDRU`='$municipalityDRU', `addressOfDRU`='$addressDRU', `gender`='$gender', `dob`='$dob', `municipality`='$municipality', `barangay`='$barangay', `address`='$address', `disease`='$disease' WHERE patientId=$patientId";

        $result = mysqli_query($con, $sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $result;
            break;
        }

        $successMessage = "Client added correctly";

        header("location: /phpsandbox/publichealth/patient.php");
        exit;
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
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
        <div class="container">
            <?php
            if (!empty($errorMessage)) {
                echo "
                <script>
                    alert(<strong>$errorMessage</strong>;
                </script>
            ";
            }
            ?>
            <!-- Name Form Group -->
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <h2>Edit Patient</h2>

                    <form action="" method="post">
                        <input type="text" class='form-control' name='patientId' value='<?php echo $patientId; ?>'>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Patient Name</span>
                            <input placeholder="Last Name" type="text" class='form-control' name='lName' value='<?php echo $lName; ?>'>
                            <input placeholder="First Name" type="text" class='form-control' name='fName' value='<?php echo $fName; ?>'>
                            <input placeholder="Middle Name" type="text" class='form-control' name='mName' value='<?php echo $mName; ?>'>
                        </div>

                        <!-- Gender Dropdown -->
                        <div class="row mb-3">
                            <label class='col-sm-3 col-form-label' for="gender">Gender</label>
                            <div class="col-sm-6">
                                <select class="form-select" id="gender" name="gender">
                                    <option value=""><?php echo $gender; ?></option>
                                    <?php
                                    // Connect to database and fetch municipalities
                                    include("connection.php");
                                    $result = mysqli_query($con, 'SELECT * FROM genders');

                                    // Display each municipalities in a dropdown option
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['genderId'] . '">' . $row['gender'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- DOB -->
                        <div class="row mb-3">
                            <label for="" class='col-sm-3 col-form-label'>Date of Birthday</label>
                            <div class="col-sm-6">
                                <input type="date" class='form-control' name='dob' id="dob" onchange="calculateAge()" value=''>
                            </div>
                        </div>
                        <!-- Age minus the DOB -->
                        <div class="row mb-3">
                            <label for="" class='col-sm-3 col-form-label'>Age</label>
                            <div class="col-sm-6">
                                <input type="number" class='form-control' id="age" name='age' disabled>
                            </div>
                        </div>
                        <!-- Contact Number -->
                        <div class="row mb-3">
                            <label for="" class='col-sm-3 col-form-label'>Contact Number</label>
                            <div class="col-sm-6">
                                <input type="text" class='form-control' name='contact' value='<?php echo $contact; ?>'>
                            </div>
                        </div>
                        <!-- Municipality Dropdown -->
                        <div class="input-group mb-3">
                            <span class="input-group-text">Municipality</span>
                            <select class="form-select" id="municipality" onchange="updateBarangays()" name="municipality">
                                <option value=""><?php echo $municipality; ?></option>
                                <?php
                                // Connect to database and fetch municipalities
                                include("connection.php");
                                $result = mysqli_query($con, 'SELECT * FROM municipality');

                                // Display each municipalities in a dropdown option
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['munId'] . '">' . $row['municipality'] . '</option>';
                                }
                                ?>
                            </select>
                            <!-- Barangay Dropdown -->
                            <span class="input-group-text">Barangay</span>
                            <select class="form-select" id="barangay" name="barangay">
                                <option><?php echo $barangay; ?></option>
                            </select>
                        </div>
                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="" class='col-sm-3 col-form-label'>Address</label>
                            <div class="col-sm-6">
                                <input placeholder="Address" type="text" class='form-control' name='address' value='<?php echo $address; ?>'>
                            </div>
                        </div>
                        <!-- Municipality of DRU Dropdown -->
                        <div class="input-group mb-3">
                            <span class="input-group-text">Municipality of DRU</span>
                            <select class="form-select" id="municipalityDRU" onchange="updateBarangaysDRU()" name="municipalityDRU">
                                <option value=""><?php echo $municipalityDRU; ?></option>
                                <?php
                                // Connect to database and fetch municipalities
                                include("connection.php");
                                $result = mysqli_query($con, 'SELECT * FROM municipality');

                                // Display each municipalities in a dropdown option
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['munId'] . '">' . $row['municipality'] . '</option>';
                                }
                                ?>
                            </select>
                            <!-- Barangay of DRU Dropdown -->
                            <span class="input-group-text">Barangay of DRU</span>
                            <select class="form-select" id="barangayDRU" name="barangayDRU">
                                <option><?php echo $barangayDRU; ?></option>
                            </select>
                        </div>
                        <!-- Address of DRU -->
                        <div class="row mb-3">
                            <label for="" class='col-sm-3 col-form-label'>Address of DRU</label>
                            <div class="col-sm-6">
                                <input placeholder="Address of DRU" type="text" class='form-control' name='addressDRU' value='<?php echo $addressDRU; ?>'>
                            </div>
                        </div>
                        <!-- Disease Dropdown -->
                        <div class="row mb-3">
                            <label class='col-sm-3 col-form-label' for="disease">Disease</label>
                            <div class="col-sm-6">
                                <select class="form-select" id="disease" name="disease">
                                    <option value=""><?php echo $disease; ?></option>
                                    <?php
                                    // Connect to database and fetch municipalities
                                    include("connection.php");
                                    $result = mysqli_query($con, 'SELECT * FROM diseases');

                                    // Display each municipalities in a dropdown option
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['diseaseId'] . '">' . $row['disease'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Outcome Dropdown
                <div class="row mb-3">
                    <label class='col-sm-3 col-form-label' for="outcome">Outcome</label>
                    <div class="col-sm-6">
                        <select class="form-select" id="outcome" name="outcome">
                            <option value="">Select Outcome</option>
                            <?php
                            // Connect to database and fetch municipalities
                            include("connection.php");
                            $result = mysqli_query($con, 'SELECT * FROM outcomes');

                            // Display each municipalities in a dropdown option
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['outcomeId'] . '">' . $row['outcome'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                DateDied 
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Date Died</label>
                    <div class="col-sm-6">
                        <input type="date" class='form-control' name='dateDied' value='<?php echo $dateDied; ?>'>
                    </div>
                </div> -->

                        <?php
                        if (!empty($successMessage)) {
                            echo "
                    <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dimissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type = 'button' class = 'btn-close' data-bs-dismissible = 'alert' aria-label = 'close'></button>
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
                                <a href="/phpsandbox/publichealth/patient.php" class="btn btn-outline-primary" role="button">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        function updateBarangaysDRU() {
            const municipalitySelect = document.getElementById('municipalityDRU');
            const barangayDRUSelect = document.getElementById('barangayDRU');
            const selectedMunicipality = municipalitySelect.value;

            // Clear barangay dropdown
            barangayDRUSelect.innerHTML = '';

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
                            option.value = barangay.muncityId;
                            barangayDRUSelect.add(option);
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