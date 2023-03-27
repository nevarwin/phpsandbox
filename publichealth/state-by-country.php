<?php
require_once "db.php";
$muncityId = $_POST["muncityId"];
$result = mysqli_query($conn, "SELECT * FROM barangay where muncityId = $muncityId");
?>
<option value="">Select State</option>
<?php
while ($row = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
<?php
}
?>