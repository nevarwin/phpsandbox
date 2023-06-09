<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

//create connection to the database
// $conn = new mysqli($servername, $username, $password, $database);

$name = '';
$email = '';
$password = '';
$contact = '';
$address = '';

$errorMessage = '';
$successMessage = '';

// check if the form is submitted using the post method
// initialize data above into the post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // check if the data is empty
    do {
        if (empty($name) or empty($email) or empty($password) or empty($contact) or empty($address) or empty($municipality) or empty($barangay)) {
            $errorMessage = "All fields are required";
            break;
        }
        // added new data into the db
        $sql = "INSERT INTO clients(`name`, `email`, `municipality`, `barangay`, `password`, `contact_number`, `address`) VALUES ('$name', '$email', '$municipality','$barangay','$password' , '$contact', '$address')";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $result;
            break;
        }

        // reset data
        $name = '';
        $email = '';
        $password = '';
        $contact = '';
        $address = '';

        $successMessage = "Client added correctly";

        header("location: /phpsandbox/publichealth/index.php");
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
    <title>Create Admin Page</title>
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
            <h2>New Admin</h2>

            <?php
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Holy guacamole!</strong> $errorMessage
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>
            <form action="" method="post">
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
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Holy guacamole!</strong> $successMessage
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
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