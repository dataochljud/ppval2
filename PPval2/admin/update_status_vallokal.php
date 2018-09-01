<?php require('adminheader.php') ?>
<?php

echo "Uppdaterar status på vallokaler</br>";

$sql = 'select * from vallokal join Booking on LokalKod=LokalID'; 
$sql2 = 'update vallokal, Booking inner join vallokal on vallokal.LokalKod = Booking.LokalID set vallokal.status = "B"';

require(../open_database.php);



?>
<?php require('admin_footer.php') ?>