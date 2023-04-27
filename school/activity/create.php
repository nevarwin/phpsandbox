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
        $sql = "INSERT INTO tbl_records(`fname`, `lname`, `mobile`, `email`, `address`) 
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
            <input type="cancel" value="Cancel" />
        </form>
    </div>
    <!-- <script>
        function validateForm() {
            // Get form input values
            var username = document.forms["registration"]["username"].value;
            var password = document.forms["registration"]["password"].value;
            var confirmPassword =
                document.forms["registration"]["confirmPassword"].value;
            var email = document.forms["registration"]["email"].value;
            var dob = document.forms["registration"]["dob"].value;

            // Initialize error messages array
            var errors = [];

            // Check if username meets requirements
            if (username.length < 5 || username.match(/[^\w]/)) {
                errors.push(
                    "Username must be at least 5 characters long and can only contain letters, numbers, and underscores."
                );
            }

            // Check if password meets requirements
            if (
                password.length < 8 ||
                !password.match(/[A-Z]/) ||
                !password.match(/[a-z]/) ||
                !password.match(/[0-9]/) ||
                !password.match(/[\W]/)
            ) {
                errors.push(
                    "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character."
                );
            }

            // Check if confirm password matches password
            if (password !== confirmPassword) {
                errors.push("Confirm password does not match password.");
            }

            // Check if email is in valid format
            if (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,}$/)) {
                errors.push("Email address is not in valid format.");
            }

            // Check if dob is in valid format and user is at least 18 years old
            var today = new Date();
            var birthDate = new Date(dob);
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();
            var dayDiff = today.getDate() - birthDate.getDate();

            if (
                monthDiff < 0 ||
                (monthDiff === 0 && today.getDate() < birthDate.getDate())
            ) {
                monthDiff--;
                dayDiff =
                    new Date(today.getFullYear(), today.getMonth(), 0).getDate() -
                    birthDate.getDate() +
                    today.getDate();
            }

            var totalMonths = age * 12 + monthDiff;
            var totalDays = Math.floor((today - birthDate) / (1000 * 60 * 60 * 24));

            console.log("Age in years: " + age);
            console.log("Age in months: " + totalMonths);
            console.log("Age in days: " + totalDays);
            console.log("Remaining days: " + dayDiff);

            if (isNaN(age) || age < 18) {
                errors.push(
                    "Date of birth is not in valid format or user is under 18 years old."
                );
            }

            // Check if there are any errors
            if (errors.length > 0) {
                // Display error messages
                var errorString = "";
                for (var i = 0; i < errors.length; i++) {
                    errorString += errors[i] + "\n";
                }
                alert(errorString);
                return false;
            }

            // Submit form if all fields are valid
            alert("Registration successful!");
            return true;
        }
    </script> -->
</body>

</html>