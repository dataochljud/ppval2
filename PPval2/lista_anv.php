<?php require("includes/header.php") ?>
<?php require("includes/open_database.php");

$user_id = $_GET["anv"];
//echo $user_id . "<br>";

$sql = 'SELECT * FROM User WHERE UserID =' . $user_id;

echo '<h1>Bokade vallokaler - Användare</h1>';
echo '<table class="table table-bordered table-hover">';
echo '<thead><tr><th>Namn</th><th>Adress</th><th>Postadress</th><th>Telefon</th><th>mail</th></tr></thead>';
$result = $conn->query($sql);
$first_row = TRUE;

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

echo '</table><h2>Bokade lokaler</h2><table class="table table-bordered table-hover">';

$sql2 = 'SELECT * FROM Booking JOIN vallokal ON LokalKod = LokalID Where UserID =' . $user_id;

$lokaler = $conn->query($sql2);
if ($lokaler->num_rows > 0) {
echo '<thead><tr><th>Lokal</th><th>Adress1</th><th>Adress2</th><th>Postort</th><th>Typ</th></tr></thead>';
    // output data of each row
    while($row_lokaler = $lokaler->fetch_assoc()) {
        echo '<tr><td>' . $row_lokaler["lokal"] . '</td><td>' . $row_lokaler["Adress1"] . '</td><td>' . $row_lokaler["Adress2"] . '</td><td>' . $row_lokaler["Postort"] . '</td><td>' . $row_lokaler["Typ"] . '</td></tr>';
    }
}
echo '</table>';

$conn->close();
?>

<?php require("includes/footer.php"); ?>
