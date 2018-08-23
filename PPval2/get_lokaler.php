<?php 
$servername = "johantibbelin.se.mysql";
$username = "johantibbelin_se_ppval";
$password = "ppval2018";
$dbname = "johantibbelin_se_ppval";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM Län where DistrId=" . htmlspecialchars($_GET["distrikt"]);
$result = $conn->query($sql);
echo '<select name="llan" onchange="updateKommun(this.value)">';
echo '<option value="0">--- Välj län ---</option>';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?><option value="<?php echo  $row["LänId"]; ?>"><?php echo $row["Namn"];?></option><?php 
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</select>";
?>