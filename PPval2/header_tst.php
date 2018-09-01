<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link rel="stylesheet" href="ppstyle.css">
<script src="http://ajax.microsoft.com/ajax/jQuery/jquery-1.3.2.min.js"></script>


<title>Piratpartiet: valsedelsdistribution 2.0</title>
  <meta name="description" content="PP valsedelssystem 2.0">
  <meta name="keywords" content="HTML,CSS,XML,JavaScriptPiratpartiet, valsedlar, system">
  <meta name="author" content="Johan Roos Tibbelin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body> 
<div id="main">
<a href="index.php"><img src="PP_val2_logga.png" alt="Piratpartiet Valsedelsdistribution 2.0" width="400px" /></a>
<div class="msg"><br>Version: 2.0.0.4</div>
<div id="menu">
<?php
if(isset($_COOKIE["PPval2user"])) {
echo '<p><a href="mina_lokaler2.php">[Mina lokaler]</a>';
} else {
echo '<a href="login.php" style="font-size:11px;align:right;">[Logga in]</a>';
}
?>

</div><!-- Menu -->
<div id="nav">
<?php echo "Page:" ?>
<a href="/ppval2/">Distrikt</a>
</div>
