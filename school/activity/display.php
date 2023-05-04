<?php
session_start();
include('connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Form</title>
    <style>
        table,
        tr,
        th {
            border: 1px solid black;
        }
    </style>
</head>


<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tbl_records";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $contact = $row['contact'];
                $address = $row['address'];

                echo "
                <tr>
                    <th>$id</th>
                    <th>$fname</th>
                    <th>$lname</th>
                    <th>$email</th>
                    <th>$contact</th>
                    <th>$address</th>
                    <th>
                        <a href='http://localhost/phpsandbox/school/activity/create.php'>Create</a>
                        <a href='http://localhost/phpsandbox/school/activity/update.php?id=$id'>Update</a>
                        <a href='http://localhost/phpsandbox/school/activity/remove.php?id=$id'>Remove</a>
                    </th>
                </tr>
                        ";
            }
            ?>
        </tbody>
    </table>
    <a style="border: solid 1px grey" href='http://localhost/phpsandbox/school/activity/login.php'>Logout</a>
</body>

</html>