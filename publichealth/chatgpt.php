<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "publichealthdb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the dropdown options from the database
$sql = "SELECT * FROM diseases";
$result = $conn->query($sql);
$options = array();
$tables = array();
$columns = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[$row["diseaseId"]] = $row["disease"]; //name
        $tables[$row["diseaseId"]] = $row["disease"]; //table
        $columns[$row["diseaseId"]] = $row["disease"]; //column_name
    }
}

// Display the dropdown menu
echo '<form method="post" action="">';
echo '<label for="select">Select an option:</label>';
echo '<select id="select" name="option">';
echo '<option>' . 'Please select a disease' . '</option>';
foreach ($options as $id => $name) {
    echo '<option value="' . $id . '">' . $name . '</option>';
}
echo '</select>';
echo '<button type="submit" name="submit">Submit</button>';
echo '</form>';

// Process form submission
if (isset($_POST['submit'])) {
    $option = $_POST['option'];
    $table = $tables[$option];
    $column = $columns[$option];

    // Display the form for the selected option
    echo '<form method="post" action="">';
    echo '<label for="' . $column . '">' . $options[$option] . ' form:</label>';
    echo '<input type="text" id="' . $column . '" name="' . $column . '">';
    echo '<button type="submit" name="submit_' . $column . '">Submit</button>';
    echo '</form>';

    // Process form submission for the selected option
    if (isset($_POST['submit_' . $column])) {
        $value = $_POST[$column];
        $sql = "INSERT INTO $table ($column) VALUES ('$value')";
        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully";
        } else {
            echo "Error adding record: " . $conn->error;
        }
    }
}



$conn->close();
?>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "publichealthdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Determine the total number of records and the number of records per page
$totalRecords = mysqli_query($conn, "SELECT COUNT(*) FROM patients")->fetch_array()[0];
$recordsPerPage = 3;

// Determine the current page number and the starting record for the page
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
$startRecord = ($currentPage - 1) * $recordsPerPage;

// Modify the SQL query to retrieve only the records for the current page
$sql = "SELECT * FROM patients LIMIT $startRecord, $recordsPerPage";
$result = mysqli_query($conn, $sql);

// Display the records in the table
echo "<table>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td></tr>";
}
echo "</table>";

// Add links to navigate between the pages
$totalPages = ceil($totalRecords / $recordsPerPage);
if ($totalPages > 1) {
    echo "<div>";
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
        echo "<a href=\"?page=" . ($currentPage + 1) . "\">Next</a>";
    }
    echo "</div>";
}
?>
