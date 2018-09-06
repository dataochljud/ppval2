<?php
require("includes/open_database.php");

$lokalkod = $_GET['lokal'];
//echo $lkod . "<br>";
$elk = explode('_', $lokalkod);
$lan = $elk[0];
$kommun = $elk[1];

$result = $conn->query('SELECT * FROM vallokal where LokalKod="' . htmlspecialchars($lokalkod) . '"');
$lokal = $result->fetch_assoc();

$conn->query('UPDATE vallokal SET Status = "O" WHERE LokalKod="' . $lokalkod . '"');
$conn->query('DELETE FROM Booking WHERE UserID=' . $_COOKIE["PPval2user"] . ' AND LokalID="' . $lokalkod . '"');

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

header('Location: ' . $redirect_url);
exit();
?>
