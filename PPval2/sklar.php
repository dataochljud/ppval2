<?php
$lokalkod = $_GET['lokal'];
$lkod = $lokalkod;
//echo $lkod . "<br>";
$elk = explode('_',$lkod);
$lk = $lkod;
$lan = $elk[0];
$kommun = $elk[1];
require('open_database.php');

$sql = 'UPDATE vallokal SET Status = "K" where LokalKod="' . $lokalkod . '"'; 

if (!$conn->query($sql)) { echo "Databasfel!"; }
header('Location: https://www.johantibbelin.se/ppval2/fget_lokaler.php?lan=' . $lan . '&kommun=' . $kommun);
exit();

?>