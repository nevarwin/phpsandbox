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
