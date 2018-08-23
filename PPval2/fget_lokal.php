<?php require("header.php") ?>




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
$lokalkod=$_GET["lokal"];

//echo $kommun . ' ' . $lan . '<br>';
$sql = 'SELECT * FROM vallokal where LokalKod="' .  htmlspecialchars($lokalkod) . '"';
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$lat = $row["Lat"];
$long = $row["Lng"];
    }
} else {
    echo "0 results";
}
$conn->close();

$murl = "gmap_lokal.php?lat=" . $lat . "&long=" . $long;
//echo $murl . '<br>';

?>

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
$lokalkod=$_GET["lokal"];

//echo $kommun . ' ' . $lan . '<br>';
$sql = 'SELECT * FROM vallokal where LokalKod="' .  htmlspecialchars($lokalkod) . '"';
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

if ($row["Typ"] == "F") {
   echo '<h4>Förtidsröstning</h4>'; 
} else {
   echo '<h4>Vallokal</h4>'; 
}
echo '<h2 style="Margin:0px; padding:0px;">' . $row["lokal"] . '</h2>';
echo '<p>Adress: ' . $row["Adress2"] . '<br>postort: ' . $row["Postort"] . '</p>';
echo '<h3>Valsedlar</h3>';
echo '<table border=4><tr><td>Riksdag</td><td>Landsting</td><td>Kommun</td></tr>';
echo '<tr><td style="background:yellow;">' . $row["AntalR"] . '</td><td style="background:purple;color:white;">' . $row["AntL"] . '</td><td style="background:white;">' . $row["AntalK"] . '</td></tr></table>';
$str = $row["Tider"];
$array = explode(';', $str);

echo '<h3>Öppettider</h3>';
echo '<table border=4>';
foreach ($array as $arr) {
		echo '<tr><td><b>' . $arr . '</b></td></tr>';	   
	}
	echo '</table>';
}
echo '<p>Antal röstande: ' . $row["VoterCount"];
    
} else {
    echo "0 results";
}

$sql2 = 'SELECT * FROM Booking where LokalID="' .  htmlspecialchars($lokalkod) . '"';
//echo $sql2 . '<br>';
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $booked = TRUE;
       echo '<div><h3  style="background:yellow;">Lokalen är bokad</h3></div>';
    }
} else {
    echo '<h3 style="background:red;">lokalen är obokad</h3>';
}



$conn->close();

?>
<?php 
if (!$booked) { echo '<p><a href="boka_lokal.php?lokalkod=' . $lokalkod .'">Boka den här vallokalen</a></p>'; } ?>

<div class="gmap">
<!--<p><button type="button" onclick="loadDoc()">Visa karta</button></p>-->
</div>
<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("gmap").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", <?php echo $murl; ?>, true);
  xhttp.send();
}
</script>
<p><a href="<?php echo $murl; ?>">Visa karta</a></p>
</div>
</body>
</html>
