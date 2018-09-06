<?php
require("includes/open_database.php");

$first_name = $_GET["first_name"];
$last_name = $_GET["last_name"];
$address = $_GET["address"];
$post_address = $_GET["post_address"];
$phone_number = $_GET["phone_number"];
$email_address = $_GET["email_address"];

$conn->query('UPDATE User SET mail="' . $email_address . '", namn="' . $first_name . '", efternamn="' . $last_name . '", adress="' . $address . '", postadress="' . $post_address . '", telefon="' . $phone_number . '" WHERE UserID=' . $_COOKIE["PPval2user"]);

$conn->close();

//echo $lan . " " . $kommun . "<br>";
header('Location: /ppval2/');
exit();
?>
