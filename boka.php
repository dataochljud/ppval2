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
<img src="PP_val2_logga.png" width="400px" alt="Piratpartiet Valsedelsdistribution 2.0" />
<div class="msg"><p>Version: 2.0.0.01a</div>
<div id="menu">

</div><!-- Menu -->
<?php $lkod = $_GET["lokalkod"];
echo $lkod . "<br>";
$namn = $_GET["namn"];
$efternamn = $_GET["efternamn"];
$adress = $_GET["adress"];
$postadress = $_GET["postadress"];
$mobil = $_GET["mobil"];
$mail = $_GET["mail"];


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
$sql = 'SELECT * FROM user where mail="' .  htmlspecialchars($mail) . '"';
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	       $result = $row["UserID"];
    }
} else {
    echo "Adding User...";
    $add_user = 'insert into User (mail, namn, efternamn, adress, telefon, Admin) values("' . $mail . '","' . $namn . '","' . $efternamn . '","' . $adress . ' ' . $postadress . '","' . $mobil . '",NULL)';
echo $add_user . "<br>";
    $result = $conn->query($add_user);
    echo $result . "<br>";
}
echo $mail . "<br>";
$uid = 'select * from user where mail="' . $mail . '"';
$result = $conn->query($uid);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	       $result = $row["userID"];
    }
} else { }
echo "Lägger till boking...";
echo $lokalkod . "<br>";
$booking = 'INSERT into Booking ( userID, LokalID) values(' . $result . ',"' .  $lkod . '")';
$result = $conn->query($booking);
echo $booking . "<br>";
echo $result . "<br>";
$conn->close();

?>
</div>
</body>
</html>
