<!DOCTYPE html>
<!--- Listar alla vallokaler. Distrikt och namn listas.

//
//  PPval2 v. 0.0.01
//  DVS knappt fungerande :-P
// Skrivet av Johan Roos Tibbelin (johan.roos.tibbelin@piratpartiet.se)
// www.johantibbelin.se ---->
<!---- 
***************************************************
** TODO: AJAX:
** - Visa dölj karta
** - Knappar för menyn
** - lägga upp användare
** - boka/avboka lokaler
** - admininterface
** PHP/SQL:
** - databassäkerhet
** - Städa upp databasen
** - Auto increment
** - importera data:
**   (v)för Vimmerby kommun
**    - för Kalmar län
**    - för Södra distriktet
**    - Resten av landet
***************************************************
**  Not: 
***************************************************
** Senast ändrad: 2018-08-13 16:03
***************************************************
---->
<Html>
<head>
<style>
#main {
font-family:sans-serif;
}
h1 {
font-family:sans-serif;
font-size:12pt;
}
color:grey;
a {
color:#000000;
}
#map {
        height: 450px;  /* The height is 400 pixels */
        width: 450px;  /* The width is the width of the web page */
       }
</style>
<title>Piratpartiet: valsedelsdistribution 2.0 - lista alla lokaler</title>
  <meta charset="UTF-8">
  <meta name="description" content="PP valsedelssystem 2.0 (a0.00.01)">
  <meta name="keywords" content="HTML,CSS,XML,JavaScriptPiratpartiet, valsedlar, system">
  <meta name="author" content="Johan Roos Tibbelin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body link="#000000" alink="#999999">
<div id="main">
<img src="PP_val2_logga.png" alt="Piratpartiet Valsedelsdistribution 2.0" />
<p><a href="list_all_vl.php">Lista alla lokaler</a><br>
<a href="list_all_bvl.php">Lista alla bokade lokaler</a><br>
<a href="list_all_obvl.php">Lista alla obokade lokaler</a></p>
<hr>
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

$sql = "SELECT * FROM vallokal";
$result = $conn->query($sql);
echo "<h2>Samtliga vallokaler</h2><p>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["Lokal"].  "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</p>";
?>
<!--The div element for the map -->
    <div id="map"></div>
    <script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var lock = {lat:57.79747, lng:16.07860 };
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: lock});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: lock, map: map});
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEgxFkVf0iZRWaTUeADQAkldWSZcZftJE&callback=initMap">
    </script>
</div>
</body>
</html>
