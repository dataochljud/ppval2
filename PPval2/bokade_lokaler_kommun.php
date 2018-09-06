<?php require("includes/header.php") ?>
<?php require("includes/open_database.php");

$lan = $_GET["lan"];
$kommun = $_GET["kommun"];


$sql = 'SELECT *
FROM  `vallokal`
JOIN Kommun ON Kommunkod = Kommun.KommunID
AND LanKod = Kommun.länid
WHERE lankod = ' . $lan . ' AND KommunKod = ' . $kommun . ' AND (Typ = "V" OR Typ = "F")';
echo '<p>';
Echo '<h1>Bokade vallokaler</h1>';
echo '<table class="table table-bordered table-hover">';
echo '<tr><td>Kommun</td><td>Lokalkod</td><td>Typ</td><td>Lokal</td><td>Adress</td><td>Postort</td><td>Bokad av</td></tr>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	// Hämta eventuell bokning
    	$bokad_av_sql = 'SELECT *
		       	   FROM  `Booking`
			   JOIN User ON Booking.UserID = User.UserID
			   WHERE LokalID = "' . $row["LokalKod"] . '"';

	$userb = $conn->query($bokad_av_sql);
	if ($userb->num_rows > 0) {
	$userrow = $userb->fetch_assoc();
	$bokad_av = '<td><a href="lista_anv.php?anv=' . $userrow["UserID"] . '">' . $userrow["namn"] . " " . $userrow["efternamn"] . '</a></td>';
	} else { $bokad_av = '<td style="background-color:red;color:white;">Obokad</td>';}
	echo '<tr><td>' . $row["Namn"] . '</td><td>' . $row["LokalKod"] .'</td><td>' . $row["Typ"] .'</td><td>' . $row["lokal"] .'</td><td>' . $row["Adress1"] . '</td><td>' . $row["Postort"] . $bokad_av . "<tr> ";

    }
} else {
    echo "0 results";
}
$conn->close();


?>
