<?php require("header.php") ?>

<div class="gmap">
</div>
<script>
function showMap() {
    document.getElementByID("gmap").innerHTML = "<h1>Katan kommer vara här...</h1>";
}
</script>
<div id="data">

<?php
require("open_database.php");

$sql = "SELECT * FROM Län where DistrId=" . htmlspecialchars($_GET["distrikt"]) . " order by namn";
// echo $sql . '<br>';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  '<a href="fget_kommuner.php?lan=' . $row["LänID"] . '">' . $row["Namn"] . '</a><br>';
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</select>";
require("footer.php");
?>
