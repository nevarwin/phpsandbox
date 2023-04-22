<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "crudseries";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("connection failed!");
}

$id = $_GET['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];


if (count($_POST) > 0) {

    $sql = "UPDATE seriescrud 
    set fname = '$fname', lname = '$lname', mobile = '$mobile', email = '$email'
    where id = '$id'
    ";
    mysqli_query($con, $sql);
}

$selectsql = "select * from seriescrud where id = '$id'";
$result = mysqli_query($con, $selectsql);
$row = mysqli_fetch_array($result);
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
        <input type="text" name='fname' value="<?php echo $row['fname'] ?>"></input>
        <label for="">Last Name</label>
        <input type="text" name="lname" value="<?php echo $row['lname'] ?>"></input>
        <label for="">Email</label>
        <input type="text" type='email' name='email' value="<?php echo $row['email'] ?>"></input>
        <label for="">Mobile</label>
        <input type="text" name='mobile' value="<?php echo $row['mobile'] ?>"></input>
        <input type="submit" value="update">
        <a href="/phpsandbox/school/secondmeeting/read.php" role="button">Cancel</a>
    </form>
</body>

</html>