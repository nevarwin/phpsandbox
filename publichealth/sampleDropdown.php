<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <label for="municipality">Municipality:</label>
    <select id="municipality" onchange="updateBarangays()">
        <option value="">Select a municipality</option>
        <?php
        // Connect to database and fetch municipalities
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "123";
        $dbname = "publichealthdb";

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $result = mysqli_query($conn, 'SELECT * FROM municipality');

        // Display each municipalities in a dropdown option
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['munId'] . '">' . $row['municipality'] . '</option>';
        }
        ?>
    </select>

    <label for="barangay">Barangay:</label>
    <select id="barangay">
        <option value="">Select a barangay</option>
    </select>

    <script>
        function updateBarangays() {
            const municipalitySelect = document.getElementById('municipality');
            const barangaySelect = document.getElementById('barangay');
            const selectedMunicipality = municipalitySelect.value;

            // Clear barangay dropdown
            barangaySelect.innerHTML = '';

            if (selectedMunicipality) {
                // Fetch barangays for selected country using AJAX
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        const barangays = JSON.parse(this.responseText);

                        // Populate barangay dropdown
                        barangays.forEach(function(barangay) {
                            const option = document.createElement('option');
                            option.text = barangay.barangay;
                            option.value = barangay.muncityId;
                            barangaySelect.add(option);
                        });
                    }
                };
                xhr.open('GET', 'get_barangay.php?municipality=' + selectedMunicipality, true);
                xhr.send();
            }
        }
    </script>
</body>

</html>