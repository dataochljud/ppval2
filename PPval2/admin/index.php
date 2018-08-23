<?php require("admin_header.php") ?>

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
<h2>Admin</h2>

<a href="../distributionslista_vallokaler.php">Distributionslista - vallokaler</a><br>
<a href="distributionslista_fortidslokaler.php">Distributionslista - Förtidsröstning</a>
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
</div><!-- Main -->
</body>
</html>
