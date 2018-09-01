
<!DOCTYPE html>
<!--- Listar alla vallokaler. Distrikt och namn listas. Startsida startar alltsammans (Doh)

//
//  PPval2 v. 0.0.01
//  DVS knappt fungerande :-P
// Skrivet av Johan Roos Tibbelin (johan.roos.tibbelin@piratpartiet.se)
// www.johantibbelin.se -->
<!-- 
***************************************************
** TODO: AJAX:
** - Visa dölj karta
**(v)Knappar för menyn
** - lägga upp användare
** - boka/avboka lokaler
** - admininterface
** PHP/SQL:
** - databassäkerhet
** - Städa upp databasen
** - Auto increment
** - importera data:
**   v för Vimmerby kommun
**    v för Kalmar län
**    v för Södra distriktet
**    v Resten av landet
***************************************************
**  Not: 
***************************************************
** Senast ändrad: 2018-08-15 08:22
***************************************************
-->
<html lang="sv">
<head>
<meta charset="UTF-8">
<script src="http://ajax.microsoft.com/ajax/jQuery/jquery-1.3.2.min.js"></script>

<style>
#main {
font-family:sans-serif;
}
h1 {
font-family:sans-serif;
font-size:20pt;
color:grey;
}
#msg {
 font-size:12px;
}

button {
 
font-family:lanto,sans-serif;
font-size:20pt;
}
#distrikt {
font-family:sans-serif;
font-size:20pt;
}
#odistrikt {
font-family:lanto,sans-serif;
font-size:20pt;
}

</style>
<title>Piratpartiet: valsedelsdistribution 2.0</title>
  <meta name="description" content="PP valsedelssystem 2.0">
  <meta name="keywords" content="HTML,CSS,XML,JavaScriptPiratpartiet, valsedlar, system">
  <meta name="author" content="Johan Roos Tibbelin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body> 
<div id="main">
<img src="PP_val2_logga.png" alt="Piratpartiet Valsedelsdistribution 2.0" />
<div class="msg"><p>Version: 2.0.0.01a</div>
<div id="menu">
<button type="button">Lista vallokaler</button>
<button type="button" onClick="">Dina lokaler</button>
<button type="button">Raportera fel</button>
<button type="button" onClick="">Visa karta</button>
</div><!-- Menu -->
<div class="gmap">
</div>
<script>

echo "Javascripttest!";

showMap() {
document.getElementByID("gmap").innerHTML =
"
<h1>Katan kommer vara här...</h1>
";
}

</script>
<div id="distrikt">
<select name="dist" onchange="updateLan(this.value)">
<option value="0">--- Välj distrikt ---</option>
  <option value="1">Södra distriktet</option>
<option value="6">Norra distriktet</option>
</select>
</div><!-- Distrikt -->
<div id="lan">


</div><!-- lan -->
<script>
function updateLan(str) {
var xhttp;
if (str == "") {
document.getElementById("lan").innerHTML = "";
return;
}
xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
  document.getElementById("lan").innerHTML = this.responseText;
}
};
xhttp.open("GET", "get_lan.php?distrikt="+str, true);
xhttp.send();
}
</script>
<div id="kommunl">
</div><!-- Kommun -->
<script>
function updateKommuner(str1) {
var xhttp1;
if (str1 == "") {
document.getElementById("kommunl").innerHTML = "";
return;
}
xhttp1 = new XMLHttpRequest();
  xhttp1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
  document.getElementById("kommunl").innerHTML = this.responseText;
}
};
echo str1;
xhttp1.open("GET", "get_kommuner.php?lan="+str1, true);
xhttp1.send();
}
</script>
<div id="lokaler">
</div><!-- lokaler -->
<script>
function updateLokaler(str) {
var xhttp;
if (str == "") {
document.getElementById("lokaler").innerHTML = "";
return;
}
xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
  document.getElementById("lokaler").innerHTML = this.responseText;
}
};
xhttp.open("GET", "get_lokaler.php?kommun="+str, true);
xhttp.send();
}
</script>
</div><!-- Main -->
</body>
</html>
