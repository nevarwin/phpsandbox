<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
</head>

<body>
    <h1>
        <?php echo $user_data['user_name']; ?>
        <?php echo $user_data['password']; ?> <br>

        <a href="login.php">Sign Out</a>

        <script>
            alert('are you sure you want to logout?')
        </script>
    </h1>
</body>

</html>