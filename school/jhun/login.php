<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($username) and !empty($password)) {
    $sql = "SELECT * FROM tbl_adminlog";
    $result = mysqli_query($con, $sql);
    $value = mysqli_fetch_assoc($result);

    if ($value['username'] === $username && $value['password'] === $password) {
      echo "
      <script> 
      alert('succesfull');
      window.location= 'http://localhost/phpsandbox/school/jhun/display.php';
      </script>
      ";
      // header('location: http://localhost/phpsandbox/school/activity/display.php');
      // exit();
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="shortcut icon" href="https://img.icons8.com/external-bearicons-flat-bearicons/64/null/external-sign-up-call-to-action-bearicons-flat-bearicons-1.png" type="image/x-icon" />
  <title>Registration Form</title>

</head>

<body>
  <div>
    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    <form name="registration" onsubmit="return validateForm()" method="post" action="">
      <h2>Login Form</h2>
      <label>Username</label>
      <input type="text" id="username" name="username" autocomplete="username" placeholder="Username" required />
      <label>Password</label>
      <input type="password" id="password" name="password" autocomplete="new-password" placeholder="Password" required />
      <br />
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