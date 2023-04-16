<?php
$nameArray = [];
if (isset($_POST['name'])) {
    $nameArray =  array_push($nameArray, $_POST['name']);
    print_r($nameArray);
    $name = $_POST['name'];
    $email = $_POST['email'];
    echo $name;
}


// if (isset($_GET['name'])) {
//     echo "Name: " . $_GET['name'] . "<br>";
//     echo "Email: " .
//         $_GET['email'] . "<br />";
//     echo "Password: " . $_GET['password'] . "<br />";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Get-Post Samples</title>
</head>

<body>
    <form action="home.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" />
        <label for="email">Email</label>
        <input type="email" name="email" id="email" />
        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
        <input type="submit" value="Submit" />
    </form>
</body>

</html>