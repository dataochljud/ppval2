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
      	FROM  `User`';

echo '<h1>Valsedlar - vallokaler</h1>';
echo '<table border=4 style="font-size:15px;">';
echo '<tr><td>Namn</td><td>Efternamn</td><td>Adress</td><td>Postadress</td><td>Mobil</td><td>Mail</td><td>Antal Valsedlar</td></tr>'; 
$result = $conn->query($usql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $uid = $row["UserID"];
	//echo $uid;
	$sql = 'SELECT * 
	FROM  `Booking` 
	JOIN vallokal ON vallokal.lokalkod = Booking.lokalid
	WHERE userid =' . $uid . ' and typ="V"';
	//echo $sql . "<br>";
        $res2 = $conn->query($sql);
	if ($res2->num_rows > 0) {
	   $antal = 0;
	   while($r = $res2->fetch_assoc()) {
	   	 //echo $voterCount;
	   	 $antal = $antal + $r["VoterCount"];
	   } 
	} else { }; // IF

	echo '<tr><td>' . $row["namn"] . "</td><td> " . $row["efternamn"] . "</td><td> " . $row["adress"] ."</td><td> " . $row["postadress"] . "</td><td> " . $row["telefon"] . "</td><td> " . $row["mail"] . "</td><td> " . intdiv($antal, 10) . '</td></tr>'; 
	$antal = 0;
    }
} else {
    echo "0 results";
}
$conn->close();


?>
<?php require("footer.php"); ?>