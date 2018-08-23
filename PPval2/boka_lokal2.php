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
<?Php $lokalkod=$_GET["lokalkod"]; 
if(!isset($_COOKIE["PPval2user"])) {
//    echo "Cookie named PPval2user is not set!";
} else {
//    echo "Cookie PPval2user is set!<br>";
//    echo "Value is: " . $_COOKIE["PPval2user"];
}

// Get user info
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

$sql = 'SELECT * FROM User where userid=' . $_COOKIE["PPval2user"];
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	       $namn = $row["namn"];
$efternamn = $row["efternamn"];
$adress = $row["adress"];
$postadress = $row["adress"];
$mob = $row["telefon"];
$mail = $row["mail"];
    }
} else {

}


?>
<table>
<form action="boka2.php" metod="GET">
<tr><td></td><td><input type="hidden" name="lokalkod" value="<?php echo $lokalkod; ?>"></td></tr>
<tr><td><label for="namn" >Namn:</label></td><td><input type="text" name="namn" value="<?php echo $namn; ?>"></td></tr>
<Tr><td><label for="namn">Efternamn:</label></td><td><input type="text" name="efternamn" value="<?php echo $efternamn; ?>"></td></tr>
<tr><td><label for="namn">Adress:</label></td><td><input type="text" name="adress" value="<?php echo $adress; ?>"></td></tr>
<tr><td><label for="namn">Postadress:</label></td><td><input type="text" name="postadress" value="<?php echo $adress; ?>"></td></tr>
<tr><td><label for="namn">Mobil:</label></td><td><input type="text" name="mobil" value="<?php echo $mob; ?>"></td></tr>
<tr><td><label for="namn">Mail:</label></td><td><input type="text" name="mail" value="<?php echo $mail; ?>"></td></tr>
<tr><td></td><td><input type="submit" value="Boka lokal" onclick="onSub()"></td></tr>
</table>
<div id="msg">
</div>
<script>
function onSub() {
  document.getElementById("msg").innerHTML = <?php echo $_POST['mail'] ?>;
}
</script>
</div><!-- Main -->
</body>
</html>
<?php
function onSub() {
   if(isset($_POST['submit'])) {
   echo $_POST["mail"];
   echo $_POST["namn"] . " " . $_POST["efternamn"];
   
}
}
?>
