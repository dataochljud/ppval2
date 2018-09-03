<?php require("header.php") ?>

<?php $lokalkod=$_GET["lokalkod"];
if(!isset($_COOKIE["PPval2user"])) {
//    Echo "Cookie named PPval2user is not set!";
} else {
//    echo "Cookie PPval2user is set!<br>";
//
//    echo "Value is: " . $_COOKIE["PPval2user"];
}


?>
<h2>Logga in</h2>
<form action="login_p.php" method="GET">
<label>e-post:</label><input type="input" name="email">
<input type="Submit" value="Logga in">
</form>


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
<?php require("footer.php"); ?>
