<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read: CRUD Series</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('connection.php');
            $sql = "select * from seriescrud";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $mobile = $row['mobile'];


                echo "
                <tr>
                    <th>$id</th>
                    <th>$fname</th>
                    <th>$lname</th>
                    <th>$email</th>
                    <th>$mobile</th>
                    <th>
                        <a href='/phpsandbox/school/secondmeeting/update.php?id=$id'>Edit</a>                    
                    </th>
                    <th>
                        <a href='/phpsandbox/school/secondmeeting/delete.php?id=$id'>Delete</a>                    
                    </th>
                </tr>
                ";
            }
            ?>
        </tbody>

    </table>
</body>

</html>