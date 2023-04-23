<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

$rabiesInfoId = '';
$typeOfExposure = '';
$category = '';
$biteSite = '';
$dateBitten = date("Y-m-d");
$typeOfAnimal = '';
$animalStatus = '';
$dateVaccStarted = date("Y-m-d");
$animalVacc = '';
$woundCleaned = '';
$rabiesVaccine = '';
$animalOutcome = '';
$caseClass = '';

$errorMessage = '';
$successMessage = '';

// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//GET Method: show the data of the client
if (!isset($_GET["rabiesInfoId"])) {
    header('location: /phpsandbox/publichealthd/rabiesForm.php');
    exit;
}

$rabiesInfoId = $_GET['rabiesInfoId'];
// read row 
$sql = "SELECT * FROM rabiesinfotbl WHERE rabiesInfoId = $rabiesInfoId";
// execute the sql query
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();

if (!$row) {
    header('location: /phpsandbox/publichealth/patient.php');
    exit;
}

$typeOfExposure = $row['typeOfExposure'];
$category = $row['category'];
$biteSite = $row['biteSite'];
$dateBitten = $row['dateBitten'];
$typeOfAnimal = $row['typeOfAnimal'];
$animalStatus = $row['animalStatus'];
$dateVaccStarted = $row['dateVaccStarted'];
$animalVacc = $row['animalVacc'];
$woundCleaned = $row['woundCleaned'];
$rabiesVaccine = $row['rabiesVaccine'];
$animalOutcome = $row['animalOutcome'];
$caseClass = $row['caseClass'];

// check if the form is submitted using the post method
// initialize data above into the post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $typeOfExposure = $_POST['typeOfExposure'];
    $category = $_POST['category'];
    $biteSite = $_POST['biteSite'];
    $dateBitten = $_POST['dateBitten'];
    $typeOfAnimal = $_POST['typeOfAnimal'];
    $animalStatus = $_POST['animalStatus'];
    $dateVaccStarted = $_POST['dateVaccStarted'];
    $animalVacc = $_POST['animalVacc'];
    $woundCleaned = $_POST['woundCleaned'];
    $rabiesVaccine = $_POST['rabiesVaccine'];
    $animalOutcome = $_POST['animalOutcome'];
    $caseClass = $_POST['caseClass'];


    // check if the data is empty
    do {
        if (empty($typeOfExposure) or empty($category) or empty($biteSite) or empty($dateBitten) or empty($typeOfAnimal) or empty($animalStatus) or empty($dateVaccStarted) or empty($animalVacc) or empty($woundCleaned) or empty($rabiesVaccine) or empty($animalOutcome) or empty($caseClass)) {
            $errorMessage = "All fields are required!";
            echo "<script>alert('All fields are required!');</script>";
            break;
        }
        // Proceed with form submission
        $query = "INSERT INTO rabiesinfotbl (`typeOfExposure`, `category`, `biteSite`, `dateBitten`, `typeOfAnimal`, `animalStatus`, `dateVaccStarted`, `animalVacc`, `woundCleaned`, `rabiesVaccine`,`animalOutcome`, `caseClass`)
            VALUES ('$typeOfExposure', '$category', '$biteSite', '$dateBitten', '$typeOfAnimal','$animalStatus', '$dateVaccStarted', '$animalVacc', '$woundCleaned', '$rabiesVaccine', '$animalOutcome','$caseClass')";

        $result = mysqli_query($con, $query);

        if ($result) {
            $successMessage = "Rabies info successfully added!";
            echo "<script>alert('Rabies form submitted successfully!');</script>";
            header("location: /phpsandbox/publichealth/patient.php");
            exit;
        } else {
            $errorMessage = "Error submitting form!";
            echo "<script>alert('Error submitting form! " . mysqli_error($con) . "');</script>";
        }
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Rabies Info</title>
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
        <div class="container my-5 overflow-auto" style="max-height: calc(100vh - 100px); overflow-y: auto;">
            <h2>Rabies Form</h2>

            <?php
            if (!empty($errorMessage)) {
                echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type = 'button' class = 'btn-close' data-bs-dismissible='alert' aria-label='Close'></button>
            </div>
            ";
            }
            ?>
            <form action="" method="POST">
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Type Of Exposure</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='typeOfExposure' value='<?php echo $typeOfExposure; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Category</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='category' value='<?php echo $category; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Bite Site</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='biteSite' value='<?php echo $biteSite; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Date Bitten</label>
                    <div class="col-sm-6">
                        <input type="date" class='form-control' name='dateBitten' value='<?php echo $dateBitten; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Type Of Animal</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='typeOfAnimal' value='<?php echo $typeOfAnimal; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Animal Status</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='animalStatus' value='<?php echo $animalStatus; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Date Vacc Started</label>
                    <div class="col-sm-6">
                        <input type="date" class='form-control' name='dateVaccStarted' value='<?php echo $dateVaccStarted; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Animal Vaccination</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='animalVacc' value='<?php echo $animalVacc; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Wound Cleaned</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='woundCleaned' value='<?php echo $woundCleaned; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Rabies Vaccine</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='rabiesVaccine' value='<?php echo $rabiesVaccine; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Animal Outcome</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='animalOutcome' value='<?php echo $animalOutcome; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class='col-sm-3 col-form-label'>Case Class</label>
                    <div class="col-sm-6">
                        <input type="text" class='form-control' name='caseClass' value='<?php echo $caseClass; ?>'>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="dropdown">Dropdown Label:</label>
                    </div>
                    <div class="col-md-6">
                        <select id="dropdown" name="dropdown" class="form-control">
                            <option value="">Select an option</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>
                    </div>
                </div>





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
                        <a href="/phpsandbox/publichealth/rabiesForm.php" class="btn btn-outline-primary" role="button">Cancel</a>
                    </div>
                </div>
        </div>
        </form>
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
                            option.name = barangay.id;
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