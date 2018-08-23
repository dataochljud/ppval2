<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="ppstyle.css">
<title>Piratpartiet: valsedelsdistribution 2.0</title>
  <meta name="description" content="PP valsedelssystem 2.0">
  <meta name="keywords" content="HTML,CSS,XML,JavaScriptPiratpartiet, valsedlar, system">
  <meta name="author" content="Johan Roos Tibbelin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body> 
<div id="main">
<img src="PP_val2_logga.png" width="400px" alt="Piratpartiet Valsedelsdistribution 2.0" />
<div class="msg"><p>Version: 2.0.0.01a</div>
<div id="menu">

</div><!-- Menu -->
<?Php $lokalkod=$_GET["lokalkod"]; 
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
