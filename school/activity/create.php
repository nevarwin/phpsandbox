<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (!empty($fname) and !empty($lname) and !empty($number) and !empty($email) and !empty($address)) {
        $sql = "INSERT INTO tbl_records(`fname`, `lname`, `contact`, `email`, `address`) 
            VALUES ('$fname', '$lname', '$number', '$email', '$address')
            ";

        $result = mysqli_query($con, $sql);
        header('location: http://localhost/phpsandbox/school/activity/display.php');
        exit(0);
    } else {
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="https://img.icons8.com/external-bearicons-flat-bearicons/64/null/external-sign-up-call-to-action-bearicons-flat-bearicons-1.png" type="image/x-icon" />
    <title>Registration Form</title>
    <style>
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #eff3eb;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#00ff87, #60efff);
            left: -70px;
            top: -90px;
        }

        .shape:last-child {
            background: linear-gradient(to right, #0061ff, #60efff);
            right: -85px;
            bottom: -90px;
        }

        form {
            height: 530px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 15px 20px;
        }

        form * {
            font-family: "Poppins", sans-serif;
            color: #080710;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h2 {
            /* font-size: 32px; */
            font-weight: 500;
            text-align: center;
            color: #1e1e1e;
        }

        label {
            display: block;
            margin-top: 5px;
            font-size: 16px;
            font-weight: 500;
            color: #090909;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 5px;
            padding: 0 10px;
            font-size: 14px;
            font-weight: 300;
            border: 0.5px grey solid;
        }

        ::placeholder {
            color: grey;
        }

        input[type="submit"] {
            width: 100%;
            background: linear-gradient(to right, #00ff87, #0061ff);
            color: #ffffff;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        input[type="cancel"] {
            width: 100%;
            background-color: transparent;
            color: #252525;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            border: none;
        }
    </style>
</head>

<body>
    <div>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form name="registration" onsubmit="return validateForm()" method="post" action="">
            <h2>Registration Form</h2>
            <label>First Name</label>
            <input type="text" id="fname" name="fname" autocomplete="fname" placeholder="Enter First Name" required />
            <label>Last Name</label>
            <input type="text" id="lname" name="lname" autocomplete="lname" placeholder="Enter Last Name" required />
            <label>Address</label>
            <input type="text" id="address" name="address" autocomplete="address" placeholder="Enter Address" required />
            <label>Email</label>
            <input type="email" id="email" name="email" placeholder="example@email.com" />
            <label>Mobile Number</label>
            <input type="text" id="number" name="number" placeholder="Enter mobile number" /><br />
            <input type="submit" value="Register" />
            <a href="./display.php" value="Cancel"> Cancel </a>
        </form>
    </div>
</body>

</html>