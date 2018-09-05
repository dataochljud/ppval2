<?php
require("header.php");
require("open_database.php");

$sql = 'SELECT * FROM Kommun ORDER BY Namn';

$res = $conn->query($sql);

echo '<table class="table table-bordered table-hover">';
if ($res->num_rows > 0) {
   while ($row = $res->fetch_assoc()) {
   	 echo '<tr><td><a href="bokade_lokaler_kommun.php?lan=' . $row["LänID"] . '&kommun=' . $row["KommunID"] . '">'. $row["Namn"]  .'</a></td></tr>';
}
} else {echo "Inga rader<br>"; }
echo '</table>';

?>