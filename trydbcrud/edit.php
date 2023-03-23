<?php
include("connection.php");

//create connection to the database
// $conn = new mysqli($servername, $username, $password, $database);

$id = '';
$name = '';
$email = '';
$contact = '';
$address = '';

$errorMessage = '';
$successMessage = '';

// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//GET Method: show the data of the client
if (!isset($_GET["id"])) {
    header('location: /phpsandbox/trydbcrud/index.php');
    exit;
}

$id = $_GET['id'];
// read row 
$sql = "SELECT * FROM clients WHERE id = $id";
// execute the sql query
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();

if (!$row) {
    header('location: /phpsandbox/trydbcrud/index.php');
    exit;
}

$name = $row['name'];
$email = $row['email'];
$contact = $row['contact_number'];
$address = $row['address'];
// POST Method: Update the data of the client
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // check if the data is empty
    do {
        if (empty($name) or empty($email) or empty($contact) or empty($address)) {
            $errorMessage = "All fields are required";
            break;
        }
        // update data into the db
        $sql = "UPDATE `clients` SET `name` = '$name', `email` = '$email', `contact_number` = '$contact', `address` = '$address' WHERE id = $id";

        if ($con->query($sql) === TRUE) {
            echo "Record updated successfully";
            $successMessage = "Client added correctly";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        header("location: /phpsandbox/trydbcrud/index.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

</head>

<body>
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
                <label for="" class='col-sm-3 col-form-label'>Contact Number</label>
                <div class="col-sm-6">
                    <input type="text" class='form-control' name='contact' value='<?php echo $contact; ?>'>
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
                    <a href="/phpsandbox/trydbcrud/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
    </div>

    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>