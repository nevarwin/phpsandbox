<?php
session_start();
include("connection.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_id)) {
        $query = "select * from user where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];

                    header('location: home.php');
                    die;
                }
            }
        }
        echo "Very Wrong!";
    } else {
        echo "enter a valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <style>
        form,
        div,
        a,
        br {
            padding: 5px;
        }

        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
        }

        #button {
            padding: 10px;
            width: 100px;
            color: whitesmoke;
            background-color: gray;
            border: none;

        }

        #box {
            background-color: navy;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>
</head>


<body>
    <center style="background-color: aquamarine;">
        <form action="" method="POST">
            <div>LOGIN</div>
            <div>Username</div>
            <input type="text" name="user_name" id="text" /> <br>
            <div>Password</div>
            <input name="password" id="text" type="password" /> <br>
            <input type="submit" name="" value="login" /> <br>
            <a href="signup.php">Click to Signup</a>
        </form>
    </center>
</body>

</html>