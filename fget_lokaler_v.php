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
<p><a href="fget_lokaler_f.php?kommun=<?php echo $kommun; ?>&lan=<?php echo $lan; ?>" style="backgroundcolor:#cccccc;">[Visa endast förtidsröstningslokaler]</a><a href="fget_lokaler_v.php?kommun=<?php echo $kommun; ?>&lan=<?php echo $lan; ?>">[Visa endast valdagens lokaler]</a></p>
</div>
<div id="data">
<?php
//echo $kommun . ' ' . $lan . '<br>';
$sql = "SELECT * FROM vallokal where KommunKod=" .  htmlspecialchars($kommun) . " AND LanKod=" .  htmlspecialchars($lan) . ' AND Typ="V"' . " order by Typ";
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
$voters = 0;
echo '<table><tr><td style="background-color:lightgrey;">Förtidsröstning</td><td style="bakground-color:white;">Vallokal (valdagen)</td></tr></table>';
echo '<table id="lokaler">';
    while($row = $result->fetch_assoc()) {
$voters = $voters +$row["VoterCountCalc"];
if ($row["Status"]=="K") {
   echo '<tr><td style="background:green;">&nbsp;&nbsp;&nbsp;</td>';
} 
else if ($row["Status"]=="B") {
   echo '<tr><td style="background:yellow;">&nbsp;&nbsp;&nbsp;</td>';
} else {
   echo '<tr><td style="background:red;">&nbsp;&nbsp;&nbsp;</td>';
}
	if ($row["Typ"] == "F") {
	   //echo " Förtid ";
	   $lok_color = "#cccccc";
	} else {
	   $lok_color = "white";
	}
       echo  '<td style="background-color:'. $lok_color . ';"><a href="fget_lokal.php?lokal=' . $row["LokalKod"] . '">' . $row["lokal"] . '</a></td></tr>'; 
    }
} else {
    echo "0 results";
}
echo '</table>';
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
<?php require("footer.php"); ?>