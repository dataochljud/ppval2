<?php
$lokalkod = $_GET['lokal'];

require('open_database.php');

$sql = 'UPDATE vallokal SET Status = "K" where LokalKod="' . $lokalkod . '"'; 

if (!$conn->query($sql)) { echo "Databasfel!"; }

require('index.php');
?>