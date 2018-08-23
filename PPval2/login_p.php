<?php
$email = $_GET["email"];

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

$sql = 'SELECT * FROM User where mail="' .  htmlspecialchars($email) . '"';
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	       $res = $row["UserID"];
    }
} else {
    echo '<p style="font-size:14px;background:red;">Mailadressen finns ej i systemet<br>';
    echo "När du bokar dig på en lokal så skapas ditt konto automatiskt. <br>";
    $have_mail = TRUE;
}
if ($have_mail) {setcookie("PPval2user", $res , time() + ( 86400 * 30), "/"); //Spara kaka 30 dagar
} else { }
require('index.php');
?>