<?php require("print_header.php") ?>

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

//echo $kommun . ' ' . $lan . '<br>';

$usql = 'SELECT * 
FROM  `vallokal` 
JOIN Booking ON lokalkod = lokalid
JOIN User ON User.userid = Booking.userid
WHERE lankod =1 and typ="F" ORDER BY LokalKod';

Echo '<h1>Bokade Förtidslokaler - Stockholms län</h1>';
echo '<table border=4 style="font-size:15px;">';
echo '<tr><td>Lokalkod</td><td>Lokal</td><td>Adress</td><td>Postort</td><td>Namn</td><td>Efternamn</td><td>Adress</td><td>Postadress</td><td>Mobil</td><td>Mail</td></tr>'; 
$result = $conn->query($usql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo '<tr><td>' . $row["LokalKod"] .'</td><td>' . $row["lokal"] .'</td><td>' . $row["Adress1"] . '</td><td>' . $row["Postort"] . '</td><td>' . $row["namn"] . "</td><td> " . $row["efternamn"] . "</td><td> " . $row["adress"] ."</td><td> " . $row["postadress"] . "</td><td> " . $row["telefon"] . "</td><td> " . $row["mail"] . "</td></tr>"; 
	$antal = 0;
    }
} else {
    echo "0 results";
}
$conn->close();


?>