<?php
include('connection.php');

if (!isset($_GET['id'])) {
    echo "
        <script> 
            alert('No id');
        </script>
        ";
}

$id = $_GET['id'];

$sql = "DELETE FROM tbl_records WHERE id = $id";
$result = mysqli_query($con, $sql);

echo "
    <script>
        alert('Record Succesfully Deleted');
        window.location('http://localhost/phpsandbox/school/activity/display.php');
    </script>
";
