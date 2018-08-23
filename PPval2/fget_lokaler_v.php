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
$kommun=$_GET["kommun"];
$lan=$_GET["lan"];
$k = $kommun;
$l = $lan;
?><div id="lokalmeny">
<p><a href="fget_lokaler.php?kommun=<?php echo $kommun; ?>&lan=<?php echo $lan; ?>">[Visa alla lokaler]</a><a href="fget_lokaler_f.php?kommun=<?php echo $kommun ?>&lan=<?php echo $lan; ?>">[Visa endast förtidsröstningslokaler]</a></p>
</div>
<?php
//echo $kommun . ' ' . $lan . '<br>';
$sql = 'SELECT * FROM vallokal where KommunKod=' .  htmlspecialchars($kommun) . ' AND LanKod=' .  htmlspecialchars($lan) . ' and typ="V"';
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
$voters = 0;
    while($row = $result->fetch_assoc()) {
$voters = $voters +$row["VoterCountCalc"];
        echo  '<a href="fget_lokal.php?lokal=' . $row["LokalKod"] . '">' . $row["lokal"] . '</a><br>'; 
    }
} else {
    echo "0 results";
}
$r = 'select * from Kommun where KommunID=' . $k . ' AND länID=' . $l;  
//echo $r . "<br>";
$result = $conn->query($r);
if ($result->num_rows > 0) {
    // output data of each row
//$voters = 0;
    while($row = $result->fetch_assoc()) {
$rb = $row["Röstb"];
     echo "<p>Antal röstande i kommunen: " . $rb . "</p>";
    }
} else {
    echo "0 results";
}

$conn->close();

?>
</div><!-- data -->
</div><!-- main -->
</body>
</html>
