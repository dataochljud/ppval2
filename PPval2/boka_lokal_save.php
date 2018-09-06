<?php
require("includes/open_database.php");

$lokalkod = $_GET["lokalkod"];

$elk = explode('_', $lokalkod);
$lan = $elk[0];
$kommun = $elk[1];

$first_name = $_GET["first_name"];
$last_name = $_GET["last_name"];
$street_adress = $_GET["street_address"];
$post_address = $_GET["post_address"];
$phone_number = $_GET["phone_number"];
$email_address = $_GET["email_address"];

//
// Check if user exists, and if not, add user
//

$result = $conn->query('SELECT * FROM User where mail="' .  htmlspecialchars($email_address) . '"');
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $res = $row["UserID"];
    }
} else {
    //    echo "Adding User...";
    $result = $conn->query('INSERT INTO User (mail, namn, efternamn, adress, postadress, telefon, `not`) VALUES ("' . $email_address . '","' . $first_name . '","' . $last_name . '","' . $street_adress . '","' . $post_address . '","' . $phone_number . '","")');
    //echo $result . "<br>";
}

$result = $conn->query('SELECT * FROM User where mail="' .  htmlspecialchars($email_address) . '"');
$res = $result->fetch_assoc()["UserID"];

//echo "Lägger till boking...";
//echo $lokalkod . "<br>";
$booking = 'INSERT INTO Booking (userID, LokalID) VALUES (' . $res . ',"' .  $lokalkod . '")';
$result = $conn->query($booking);
//echo $booking . "<br>";
//echo $result . "<br>";

//Uppdatera lokalstatus
$uls ='UPDATE vallokal SET status="B" WHERE lokalkod="' . $lokalkod . '"';
//echo $lk . "<br>";
$re = $conn->query($uls);

//echo "Sparar kaka.";
setcookie("PPval2user", $res , time() + (86400 * 30), "/"); //Spara kaka 30 dagar

$result = $conn->query('SELECT * FROM vallokal where LokalKod="' . htmlspecialchars($lokalkod) . '"');
$lokal = $result->fetch_assoc();

$redirect_url = '';

if ($lokal["Typ"] == "F") {
    if (strpos($lokal["Tider"], '9/9') !== false) {
        $redirect_url = '/ppval2/fget_lokaler_b.php?lan=' . $lan . '&kommun=' . $kommun;
    } else {
        $redirect_url = '/ppval2/fget_lokaler_f.php?lan=' . $lan . '&kommun=' . $kommun;
    }
} else {
    $redirect_url = '/ppval2/fget_lokaler_v.php?lan=' . $lan . '&kommun=' . $kommun;
}

$conn->close();

//echo $lan . " " . $kommun . "<br>";
header('Location: ' . $redirect_url);
exit();
?>
