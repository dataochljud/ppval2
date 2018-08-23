<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="ppstyle.css">
<title>Piratpartiet: valsedelsdistribution 2.0</title>
  <meta name="description" content="PP valsedelssystem 2.0">
  <meta name="keywords" content="HTML,CSS,XML,JavaScriptPiratpartiet, valsedlar, system">
  <meta name="author" content="Johan Roos Tibbelin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body> 
<div id="main">
<img src="PP_val2_logga.png" alt="Piratpartiet Valsedelsdistribution 2.0" />
<div class="msg"><p>Version: 2.0.0.01a</div>
<div id="menu">

</div><!-- Menu -->


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
echo $murl . '<br>';

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
echo '<h2>' . $row["Lokal"] . '</h2>';
echo '<p>Adress: ' . $row["Adress2"] . '<br>postort: ' . $row["Postort"] . '</p>';
echo '<p>Öppettider: ' .$row["Tider"] . '</p><p>Status: ' . $row["Status"];
    }
} else {
    echo "0 results";
}
$conn->close();

?>
<p><a href="boka_lokal.php?lokalkod=<?php echo $lokalkod; ?>">Boka den här vallokalen</a></p>

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
