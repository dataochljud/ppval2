<!DOCTYPE html>
<html>
<head link="#000000" alink="#000000">
<style>
#main {
font-family:sans-serif;
}
h1 {
font-family:sans-serif;
font-size:12pt;
color:grey;
}
</style>
<title>Piratpartiet: valsedelsdistribution 2.0 - main</title>
  <meta charset="UTF-8">
  <meta name="description" content="PP valsedelssystem 2.0">
  <meta name="keywords" content="HTML,CSS,XML,JavaScriptPiratpartiet, valsedlar, system">
  <meta name="author" content="Johan Roos Tibbelin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="main">
<img src="PP_val2_logga.png" alt="Piratpartiet Valsedelsdistribution 2.0" />
<p><a href="list_all_vl.php">Lista alla lokaler</a><br>
<a href="list_all_bvl.php">Lista alla bokade lokaler<br>
<a href="list_all_uvl.php">Lista alla obokade lokaler</p>
<hr>
<!---- <?php
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

$sql = "SELECT * FROM lokal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["Namn"]. " - typ: " . $row["typ"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>---->
</div>
</body>
</html>
