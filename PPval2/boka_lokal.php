<?php require("header.php") ?>

<?Php $lokalkod=$_GET["lokalkod"];
if(!isset($_COOKIE["PPval2user"])) {
//    echo "Cookie named PPval2user is not set!";
} else {
//    echo "Cookie PPval2user is set!<br>";
//
    echo "Value is: " . $_COOKIE["PPval2user"];
}

// Get user info
require("open_database.php");

$sql = 'SELECT * FROM User where userid=' . $_COOKIE["PPval2user"];
//echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	       $namn = $row["namn"];
$efternamn = $row["efternamn"];
$adress = $row["adress"];
$postadress = $row["postadress"];
$mob = $row["telefon"];
$mail = $row["mail"];
    }
} else {

}


?>
<table>
<form action="boka2.php" metod="GET">
<tr><td></td><td><input type="hidden" name="lokalkod" value="<?php echo $lokalkod; ?>"></td></tr>
<tr><td><label for="namn" >Namn:</label></td><td><input type="text" name="namn" value="<?php echo $namn; ?>"></td></tr>
<Tr><td><label for="namn">Efternamn:</label></td><td><input type="text" name="efternamn" value="<?php echo $efternamn; ?>"></td></tr>
<tr><td><label for="namn">Adress:</label></td><td><input type="text" name="adress" value="<?php echo $adress; ?>"></td></tr>
<tr><td><label for="namn">Postadress:</label></td><td><input type="text" name="postadress" value="<?php echo $postadress; ?>"></td></tr>
<tr><td><label for="namn">Mobil:</label></td><td><input type="text" name="mobil" value="<?php echo $mob; ?>"></td></tr>
<tr><td><label for="namn">Mail:</label></td><td><input type="text" name="mail" value="<?php echo $mail; ?>"></td></tr>
<tr><td></td><td><input type="submit" value="Boka lokal" onclick="onSub()"></td></tr>
</table>
<div id="msg">
</div>
<script>
function onSub() {
  document.getElementById("msg").innerHTML = <?php echo $_POST['mail'] ?>;
}
</script>
</div><!-- Main -->
</body>
</html>
<?php
function onSub() {
   if(isset($_POST['submit'])) {
   echo $_POST["mail"];
   echo $_POST["namn"] . " " . $_POST["efternamn"];

}
}
?>
