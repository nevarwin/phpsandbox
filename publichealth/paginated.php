<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "publichealthdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Determine the total number of records and the number of records per page
$totalRecords = mysqli_query($conn, "SELECT COUNT(*) FROM patients ")->fetch_array()[0];
// to edit how many fields in the web
$recordsPerPage = 1;

// Determine the current page number and the starting record for the page
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
$startRecord = ($currentPage - 1) * $recordsPerPage;

// Modify the SQL query to retrieve only the records for the current page
$sql =
    "SELECT patients.*, municipality.municipality 
FROM patients 
LEFT JOIN municipality ON patients.municipality = municipality.munId 
LIMIT $startRecord, $recordsPerPage ";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Pagination Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container my-5">
        <h1 class="text-center mb-4">Pagination Example</h1>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Municipality</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                            <tr>
                            <td>" . $row['firstName'] . "</td>
                            <td>" . $row['lastName'] . "</td>
                            <td>" . $row['municipality'] . "</td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <?php
                // Determine the current page number and the starting record for the page
                if (isset($_GET['page'])) {
                    $currentPage = $_GET['page'];
                } else {
                    $currentPage = 1;
                }
                $startRecord = ($currentPage - 1) * $recordsPerPage;
                // Add links to navigate between the pages
                $totalPages = ceil($totalRecords / $recordsPerPage);
                if ($totalPages > 1) {
                    if ($currentPage > 1) {
                        echo "<li class='page-item disabled'> <a class='page-link' aria-disabled='true' tabindex='-1' href=\"?page=" . ($currentPage - 1) . "\">Previous</a></li>";
                    }
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $currentPage) {
                            echo "<li class='page-item active'><a class='page-link'>" . $i . "</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href=\"?page=" . $i . "\">" . $i . "</a></li>";
                        }
                    }
                    if ($currentPage < $totalPages) {
                        echo "<li class='page-item'><a class='page-link' href=\"?page=" . ($currentPage + 1) . "\">Next</a>";
                    }
                }
                ?>
            </ul>
        </div>

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-TTTUxJ33FLw0+wD/b5r5QUNl5LdJKT7GZZkpu0NfAW32+MBu+jv+3q7Vbe12lFH0" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>