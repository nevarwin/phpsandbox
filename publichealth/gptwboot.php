<!DOCTYPE html>
<html>

<head>
    <title>Dynamic Form with PHP and MySQL</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Dynamic Form with PHP and MySQL</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="select">Select an option:</label>
                <select id="select" name="option" class="form-control">
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
                            $tables[$row["diseaseId"]] = "disease"; //table
                            $columns[$row["diseaseId"]] = "disease"; //column_name
                        }
                    }
                    ?>
                    <option value="0">Please select a disease</option>
                    <?php
                    foreach ($options as $id => $name) {
                        echo '<option value="' . $id . '">' . $name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        // Process form submission
        if (isset($_POST['submit'])) {
            $option = $_POST['option'];
            $table = $tables[$option];
            $column = $columns[$option];

            // Display the form for the selected option
            echo '<form method="post" action="" class="mt-3">';
            echo '<h2>' . $options[$option] . ' Form</h2>';
            echo '<div class="form-group">';
            echo '<label for="' . $column . '">' . $column . ':</label>';
            echo '<input type="text" id="' . $column . '" name="' . $column . '" class="form-control">';
            echo '</div>';
            echo '<button type="submit" name="submit_' . $column . '" class="btn btn-primary">Submit</button>';
            echo '</form>';

            // Process form submission for the selected option
            if (isset($_POST['submit_' . $column])) {
                $value = $_POST[$column];
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "INSERT INTO $table ($column) VALUES ('$value')";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success mt-3" role="alert">Record added successfully</div>';
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">Error adding record: ' . $conn->error . '</div>';
                }
                $conn->close();
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>