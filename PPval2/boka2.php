<?php $lkod = $_GET["lokalkod"];
//echo $lkod . "<br>";
$namn = $_GET["namn"];
$efternamn = $_GET["efternamn"];
$adress = $_GET["adress"];
$postadress = $_GET["postadress"];
$mobil = $_GET["mobil"];
$mail = $_GET["mail"];
$m = $mail;


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
$sql = 'SELECT * FROM User where mail="' .  htmlspecialchars($mail) . '"';
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	       $res = $row["UserID"];
    }
} else {
//    echo "Adding User...";
    $add_user = 'insert into User (mail, namn, efternamn, adress, postadress, telefon, Admin) values("' . $mail . '","' . $namn . '","' . $efternamn . '","' . $adress . '","' . $postadress . '","' . $mobil . '",NULL)';
//echo $add_user . "<br>";
    $result = $conn->query($add_user);
    //echo $result . "<br>";
}
//echo $mail . "<br>";
$uid = 'select * from User where mail="' . $m . '"';
$result = $conn->query($uid);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	       $res = $row["UserID"];
    }
} else { }
//echo "Lägger till boking...";
//echo $lokalkod . "<br>";
$booking = 'INSERT into Booking ( userID, LokalID) values(' . $res . ',"' .  $lkod . '")';
$result = $conn->query($booking);
//echo $booking . "<br>";
//echo $result . "<br>";
$conn->close();
//echo "Sparar kaka.";
setcookie("PPval2user", $res , time() + ( 86400 * 30), "/"); //Spara kaka 30 dagar
?>
<?php require("index.php") ?>
