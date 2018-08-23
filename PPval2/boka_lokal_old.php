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
<?Php $lokalkod=$_GET["lokalkod"]; ?>
<table>
<form action="http://dev.johantibbelin.se/ppval2/boka.php" metod="GET">
<tr><td></td><td><input type="hidden" name="lokalkod" value="<?php echo $lokalkod; ?>"></td></tr>
<tr><td><label for="namn">Namn:</label></td><td><input type="text" name="namn"></td></tr>
<Tr><td><label for="namn">Efternamn:</label></td><td><input type="text" name="efternamn"></td></tr>
<tr><td><label for="namn">Adress:</label></td><td><input type="text" name="adress"></td></tr>
<tr><td><label for="namn">Postadress:</label></td><td><input type="text" name="postadress"></td></tr>
<tr><td><label for="namn">Mobil:</label></td><td><input type="text" name="mobil"></td></tr>
<tr><td><label for="namn">Mail:</label></td><td><input type="text" name="mail"></td></tr>
<tr><td></td><td><input type="submit" value="Boka lokal"></td></tr>
</table>
</div><!-- Main -->
</body>
</html>
