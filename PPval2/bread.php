<?php 
//** Kod för att skriva ut breadcrum till aktuell sida

require('open_database.php');

$kommunkod = $_GET["kommun"];
$lankod = $_GET["lan"];
$lokalkod = $_GET["lokal"];
$distrikt = $_GET["distrikt"];
echo $distrikt;

// Hämta info från databas

if ($kommunkod > 0 && lankod > 0) {
     $sql1 = 'SELECT * FROM vallokal WHERE lankod=' . $lankod . ' AND kommunkod=' . $kommunkod;
     $st1 = $conn->query($sql1);
}
if ($distrikt > 0) {
     $sql2 = 'SELECT * FROM Distrikt WHERE DistrID=' . $distrikt;
     $st2 = $conn->query($sql2);
}
if ($lan > 0) {
     $sql3 = 'SELECT * FROM Län WHERE LänID=' . $lankod;
     $st3 = $conn->query($sql3);
}




if ($st1->num_rows > 0) {
     $info_r1 = TRUE;
     $row1 = $st1->fetch_assoc();

}
if ($st2->num_rows > 0) {
     $info_r2 = TRUE; echo "st2! <br>";
     $row2 = $st2->fetch_assoc();
     $distrikt_namn = $row2["Namn"];
}
if ($st3->num_rows > 0) {
     $info_r3 = TRUE;
     $row3 = $st3->fetch_assoc();
     $lan_namn = row3["Namn"];
}
echo $distrikt . "<br>";
echo '<div id="bcrum"><a href="/ppval2/index.php">Start</a>&nbsp;';

if ($info_r2) {
     echo '>&nbsp;<a href="fget_lan.php?distrikt=' . $distrikt . '">' . $row2["Namn"] . '</a>';
} else if ($lankod > 0 && $kommunkod > 0) {
     echo "Lankod & kommunkod!<br>";
     $sql_distrikt = "SELECT * FROM Distrikt WHERE DistrID=" . $row1["DistrID"];
     $res_distr = $conn->query($sql_distrikt);
     if ($res_distr->num_rows > 0) {
     	  $row_d = $res_dist->fetch_assoc();
	  $distrikt_namn = $row_d["Namn"];
     }
     echo '>&nbsp;<a href="fget_lan.php?distrikt=' . $distrikt . '">' . $distrikt_namn . '</a>';
     echo '>&nbsp;<a href="fget_lan.php?lan=' . $lankod . '">' . $lan_namn . '</a>';
     //echo '>&nbsp;<a href="fget_kommuner.php?lan=' . $lankod . '">' . $row["Namn"] . '</a>';
} 
	
		

$conn->close();
?>