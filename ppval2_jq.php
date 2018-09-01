
<!DOCTYPE html>
<!--- Listar alla vallokaler. Distrikt och namn listas. Startsida startar alltsammans (Doh)

//
//  PPval2 v. 0.0.01
//  DVS knappt fungerande :-P
// Skrivet av Johan Roos Tibbelin (johan.roos.tibbelin@piratpartiet.se)
// www.johantibbelin.se ---->
<!---- 
***************************************************
** TODO: AJAX:
** - Visa dölj karta
**(v)Knappar för menyn
** - lägga upp användare
** - boka/avboka lokaler
** - admininterface
** PHP/SQL:
** - databassäkerhet
** - Städa upp databasen
** - Auto increment
** - importera data:
**   v för Vimmerby kommun
**    v för Kalmar län
**    v för Södra distriktet
**    v Resten av landet
***************************************************
**  Not: 
***************************************************
** Senast ändrad: 2018-08-15 08:22
***************************************************
---->
<html>
<head link="#000000" alink="#000000">
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jQuery/jquery-1.3.2.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('#series option').click(function() { 
var value= $(this).attr('value');
alert(value);
})
})

</script>
<style>
#main {
font-family:sans-serif;
}
h1 {
font-family:sans-serif;
font-size:20pt;
color:grey;
}
#msg {
 font-size:12px;
}

button {
 witdh:100%;
font-family:lanto,sans-serif;
font-size:20pt;
}
#distrikt {
font-family;lanto,sans-serif;
font-size:20pt;
}
#odistrikt {
font-family;lanto,sans-serif;
font-size:20pt;
}

</style>
<title>Piratpartiet: valsedelsdistribution 2.0</title>
  <meta charset="UTF-8">
  <meta name="description" content="PP valsedelssystem 2.0">
  <meta name="keywords" content="HTML,CSS,XML,JavaScriptPiratpartiet, valsedlar, system">
  <meta name="author" content="Johan Roos Tibbelin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body link="#000000" alink="#000000">
<div id="main">
<img src="PP_val2_logga.png" alt="Piratpartiet Valsedelsdistribution 2.0" />
<div="msg"><p>Version: 2.0.0.01a</div>
<div id="menu">
<button type="button" witdth="100%">Lista vallokaler</button>
<button type="button">Dina lokaler</button>
<button type="button">Raportera fel</button>
</div><!-- Menu -->
<div id="distrikt">
<select>
<div id="odistrikt">
  <option value="Södra distriktet">Södra distriktet</option>
</div>
</select>
</div><!-- Distrikt -->
<div id="lan">
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

$sql = "SELECT * FROM Län";
$result = $conn->query($sql);
echo "<select>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?><option value="<?php echo  $row["LänId"]; ?>"><?php echo $row["Namn"];?></option><?php 
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</select>
</div>
<div id="kommun">
<select>
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

$sql = "SELECT * FROM Kommun WHERE LänId=8";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  '<option value="' . $row["Namn"] . '">' . $row["Namn"] . '</option>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>----></div>
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
