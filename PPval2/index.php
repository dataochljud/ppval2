<?php require("header.php") ?>

<div class="gmap">
</div>
<script>


function showMap() {
document.getElementByID("gmap").innerHTML =
"
<h1>Katan kommer vara här...</h1>
";
}

</script>
<div id="data">
<h2>Distrikt</h2>
<a href="fget_lan.php?distrikt=5">Norra distriktet</a><br>
<a href="fget_lan.php?distrikt=1">Södra distriktet</a><br>
<a href="fget_lan.php?distrikt=4">Stockholmsdistriktet</a><br>
<a href="fget_lan.php?distrikt=2">Västra distriktet</a><br>
<a href="fget_lan.php?distrikt=3">Östra distriktet</a><br>
</div><!-- data -->

<script>
function updateData(str) {
var xhttp;
if (str == "") {
document.getElementById("data").innerHTML = "";
return;
}
xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
  document.getElementById("data").innerHTML = this.responseText;
}
};
echo str;
xhttp.open("GET", "get_lan.php?distrikt="+str, true);
xhttp.send();
}
</script>
<?php require("footer.php"); ?>


