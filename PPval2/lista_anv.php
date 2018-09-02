<?php require("print_header.php"); ?>
<?php require("open_database.php");
// GET
$kommunkod = $_GET["kommun"];

$lankod = $_GET["lan"];

$user_id = $_GET["anv"];
//echo $user_id . "<br>";


   $sql = 'SELECT * FROM User WHERE UserID =' . $user_id;


Echo '<h1>Bokade vallokaler - Användare</h1>';
echo '<table border=4 style="font-size:15px;">';
echo '<tr><td>Namn</td><td>Adress</td><td>Postadress</td><td>Telefon</td><td>mail</td></tr>'; 
$result = $conn->query($sql);
$first_row=TRUE;
	$namn=$row["Namn"];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	// Hämta eventuell bokning
 	if ($first_row) {


	echo '<tr><td>' . $row["namn"] . ' ' . $row["efternamn"] . '</td><td>' . $row["adress"] .'</td><td>' . $row["postadress"] .'</td><td>' . $row["telefon"] .'</td><td>' . $row["mail"] . "</td><tr> ";
	$first_row = FALSE;
	}	
		
    }
} else {
    echo "0 results";
}
echo '</table>
      <h2>Bokade lokaler</h2>
<table border="4">';

$sql2 = 'SELECT * FROM Booking JOIN vallokal ON LokalKod = LokalID Where UserID =' . $user_id;

$lokaler = $conn->query($sql2);
if ($lokaler->num_rows > 0) {
echo '<tr><td>Lokal</td><td>Adress1</td><td>Adress2</td><td>Postort</td><td>Typ</td></tr>'; 
    // output data of each row
    while($row_lokaler = $lokaler->fetch_assoc()) {
echo '<tr><td>' . $row_lokaler["lokal"] . '</td><td>' . $row_lokaler["Adress1"] . '</td><td>' . $row_lokaler["Adress2"] . '</td><td>' . $row_lokaler["Postort"] . '</td><td>' . $row_lokaler["Typ"] . '</td></tr>'; 
}

} else { }
echo '</table>';
$conn->close();

require("footer.php");
?>