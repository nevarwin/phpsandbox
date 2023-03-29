<?php
include("connection.php");

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
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // check if the data is empty
    do {
        if (empty($name) or empty($email) or empty($password) or empty($contact) or empty($address)) {
            $errorMessage = "All fields are required";
            break;
        }
        // added new data into the db
        $sql = "INSERT INTO clients(`name`, `email`, `password`, `contact_number`, `address`) VALUES ('$name', '$email', '$password' , '$contact', '$address')";
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
    <title>Create Item in DB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="container my-5">
        <h2>New Client</h2>

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
                    <select class="form-select" id="municipality">
                        <option>Select Municipality</option>
                        <?php
                        $sql = "SELECT municipality FROM municipality";
                        $results = mysqli_query($con, $sql);
                        if ($results->num_rows) {
                            while ($row = $results->fetch_object()) {
                                echo " 
                                    <option value='$row->municipality'>
                                        $row->municipality
                                    </option>
                                ";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Barangay Dropdown -->
            <div class="row mb-3">
                <label class='col-sm-3 col-form-label' for="barangay">Barangay</label>
                <div class="col-sm-6">
                    <select class="form-select" id="barangay-dropdown">
                        <option>Select Barangay</option>v
                        <?php
                        $sql = "SELECT barangay FROM barangay";
                        $results = mysqli_query($con, $sql);
                        if ($results->num_rows) {
                            while ($row = $results->fetch_object()) {
                                echo " 
                                    <option value='$row->barangay'>
                                        $row->barangay
                                    </option>
                                ";
                            }
                        }
                        ?>
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
                    <a href="/phpsandbox/publichealth/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>