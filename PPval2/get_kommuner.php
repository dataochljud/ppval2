<?php
require("open_database.php");

$sql = 'SELECT * FROM Kommun where LänID=' . htmlspecialchars($_GET["lan"]);
//echo $sql;
$result = $conn->query($sql);
echo '<select name="llan" onchange="updateLokaler(this.value)">';
echo '<option value="0">--- Välj kommun ---</option>';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?><option value="<?php echo  $row["KommunID"]; ?>"><?php echo $row["Namn"];?></option><?php
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</select>";
?>
