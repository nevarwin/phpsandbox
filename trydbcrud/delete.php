<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include("connection.php");

    //create connection to the database
    // $conn = new mysqli($servername, $username, $password, $database);

    //check connection
    if (mysqli_connect_errno()) {
        // die equivalent to exit
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM clients WHERE id = $id";
    $conn->query($sql);

    header('location: /phpsandbox/trydbcrud/index.php');
    exit;
}
