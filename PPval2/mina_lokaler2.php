<?php require("header.php") ?>

<?Php $lokalkod=$_GET["lokalkod"]; 
if(!isset($_COOKIE["PPval2user"])) {
//    Echo "Cookie named PPval2user is not set!";
} else {
//    echo "Cookie PPval2user is set!<br>";
//
//    echo "Value is: " . $_COOKIE["PPval2user"];
}

// Get user info
$servername = "johantibbelin.se.mysql";
$username = "johantibbelin_se_ppval";
$password = "ppval2018";
$dbname = "johantibbelin_se_ppval";
$uid = $_COOKIE["PPval2user"];

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
$postadress = $row["postadress"];
$mob = $row["telefon"];
$mail = $row["mail"];
    }
} else {

}


?>
<h2><?php echo $namn . " " . $efternamn ?></h2>
<p>Lokaler:</p>
<?php
$servername = "johantibbelin.se.mysql";
$username = "johantibbelin_se_ppval";
$password = "ppval2018";
$dbname = "johantibbelin_se_ppval";
$uid = $_COOKIE["PPval2user"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = 'SELECT *
FROM Booking
JOIN vallokal ON Booking.lokalid = vallokal.lokalkod
WHERE Booking.userid =' . $uid;
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
echo '<div id="lokaltable"><table border="4px">';
echo '<tr><td>Lokal</td><td>Adress1</td><td>Adress2</td><td>Postort</td><td>Tider</td></tr>';
    while($row = $result->fetch_assoc()) {
  echo '<tr><td>' . $row["lokal"] . '</td><td>' . $row["Adress1"] . '</td><td>' . $row["Adress2"] . '</td><td>' . $row["Postort"] . '</td><td>' . $row["Tider"] . '</td></tr>';
    }
} else {

}
echo "</table></div>";
?>
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
