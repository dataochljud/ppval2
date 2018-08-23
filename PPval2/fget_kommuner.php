<?php require("header.php") ?>

<div class="gmap">
</div>
<script>


function showMap() {
document.getElementByID("gmap").innerHTML =
"
<h1>Katan kommer vara här...</h1>
";
}

</script>
<div id="data">

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
$lannr=$_GET["lan"];
$sql = "SELECT * FROM Kommun where länid=" . htmlspecialchars($lannr) . " order by namn";
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  '<a href="fget_lokaler.php?kommun=' . $row["KommunID"] . '&lan='. $lannr . '">' . $row["Namn"] . '</a><br>'; 
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</select>";
?>
