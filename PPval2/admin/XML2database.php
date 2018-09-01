<?php
//**********************************************************
// Loads XML file and imports it to database
//----------------------------------------------------------
// Written by: Johan Roos Tibbelin (johan@dataochljud.se)
// Version 0.1.00
//----------------------------------------------------------
// Last edited: 2018-08-24 09:52

$xmlfile = $_GET["fil"];

if ($fil != "") {
$xml=simplexml_load_file("upload/" . $xmlfile) or die("Error: Cannot create object");
} else {
 echo "No file name given!";
}




?>