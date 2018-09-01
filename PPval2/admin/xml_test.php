<?php
$xml = simplexml_load_file("xmlfiles/rostlokal.xml") or die("kan inte öppna fil...");
echo "XML test...<br>";
print_r($xml);
echo $xml . "<br>";
?>