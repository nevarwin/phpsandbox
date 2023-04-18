<?php
session_start();
include("connection.php");
// include("function.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && !is_numeric($user_id)) {
        $query = "select * from clients where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
                    $_SESSION['id'] = $user_data['id'];
                    header('location: index.php');
                    die;
                }
            }
        }
        echo "
        <script>
            alert('Wrong')
        </script>
        ";
    } else {
        echo "Enter a valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap v5.1.3 CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS File -->
    <link rel="stylesheet" href="loginform.css">

</head>

<body>
    <div class="login">
        <h1 class="text-center">Welcome!</h1>
        <form class="needs-validation" method="POST" name="loginForm">
            <div class="form-group needs-validation">
                <label class="form-label" for="email">Email address</label>
                <input class="form-control" name="email" type="email" id="email" required>
                <div class="invalid-feedback">
                    Please enter your email address
                </div>
            </div>
            <div class="form-group needs-validation">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" name="password" type="password" id="password" required>
                <div class="invalid-feedback">
                    Please enter your password
                </div>
            </div>
            <input class="btn btn-success w-100" type="submit" value="SIGN IN" onclick="checkForm(document.loginForm.password)">


            <a href="./landingpage/landingpage.php" class="btn w-100">Cancel</a>
        </form>
    </div>
</body>
<script>
    function checkForm(password) {
        let passwordRegEx = /^[a-z0-9]+$/i;
        let passwordValue = password.value;

        if (passwordValue.match(passwordRegEx) && passwordValue.length >= 8) {
            alert('Correct');
        } else {
            alert('Password too short');
        }
    }
</script>

</html>