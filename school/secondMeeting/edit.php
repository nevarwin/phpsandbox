<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "crudseries";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("connection failed!");
}
if (!isset($_GET["id"])) {
    header('location: /phpsandbox/school/read.php');
    exit;
}

$id = $_GET['id'];
// read row 
$sql = "SELECT * FROM seriescrud WHERE id = $id";
// execute the sql query
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();

if (!$row) {
    header('location: /phpsandbox/school/read.php');
    exit;
}
$firstName = $row['fname'];
$lastName = $row['lname'];
$email = $row['email'];
$mobile = $row['mobile'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($mobile)) {
        $query = "INSERT INTO seriescrud(fname, lname, email, mobile) VALUES ('$firstName', '$lastName', '$email', '$mobile')";
        $result = mysqli_query($con, $query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create: CRUD Series</title>
</head>

<body>
    <form action="" method="post">
        <label for="">First Name</label>
        <input type="text" name="firstName"></input>
        <label for="">Last Name</label>
        <input type="text" name="lastName"></input>
        <label for="">Email</label>
        <input type="text" type="email" name="email"></input>
        <label for="">Mobile</label>
        <input type="text" name="mobile"></input>
        <input type="submit" value="submit">
    </form>
</body>

</html>