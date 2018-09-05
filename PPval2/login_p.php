<?php
$email = $_GET["email"];

require("open_database.php");

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
    $have_mail = FALSE;
}
if ($have_mail) {setcookie("PPval2user", $res , time() + ( 86400 * 30), "/"); //Spara kaka 30 dagar
} else { }
header('Location: /ppval2/');
exit();
?>
