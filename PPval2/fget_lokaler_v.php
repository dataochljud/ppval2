<?php require("header.php") ?>

<div class="gmap">
</div>

<script>
function showMap() {
    document.getElementByID("gmap").innerHTML = "<h1>Katan kommer vara här...</h1>";
}
</script>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Startsida</a></li>
        <?php
        require("open_database.php");

        $lan = $_GET["lan"];
        $kommun = $_GET["kommun"];

        $result = $conn->query("SELECT * FROM Län WHERE LänID=" . htmlspecialchars($lan));
        echo '<li class="breadcrumb-item"><a href="fget_kommuner.php?lan=' . $lan . '">' . $result->fetch_assoc()["Namn"] . '</a></li>';

        $result = $conn->query("SELECT * FROM Kommun WHERE KommunID=" . htmlspecialchars($kommun) . " AND LänID=" . htmlspecialchars($lan));
        $kommun_namn = $result->fetch_assoc()["Namn"];
        echo '<li class="breadcrumb-item active" aria-current="page">' . $kommun_namn . '</li>';
        ?>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <?php
    $result = $conn->query('SELECT * from Kommun WHERE KommunID=' . $kommun . ' AND länID=' . $lan);
    echo '<p>' . $kommun_namn . ' har cirka ' . $result->fetch_assoc()["Röstb"] . ' röstberättigade.</p>'
    ?>

    <ul id="filter">
      <li><a href="fget_lokaler_f.php?kommun=<?php echo $kommun; ?>&lan=<?php echo $lan; ?>" role="button">Visa endast förtidsröstningslokaler <i class="fas fa-filter"></i></a></li> |
      <li><a href="fget_lokaler_v.php?kommun=<?php echo $kommun; ?>&lan=<?php echo $lan; ?>" role="button">&nbsp;&nbsp;Visa endast valdagens lokaler <i class="fas fa-filter"></i></a></li>
    </ul>
  </div>
</div>

<main class="row">
  <div class="col-md-8 offset-md-2">

    <?php
    //echo $sql . '<br>';
    $result = $conn->query("SELECT * FROM vallokal WHERE KommunKod=" .  htmlspecialchars($kommun) . " AND LanKod=" .  htmlspecialchars($lan). " AND Typ='V'" . " order by Typ");
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">';
        echo '<thead><tr><th>Status <i class="fas fa-clipboard-check"></i></th><th>Förtidsröstning <i class="fas fa-clock"></i></th><th>Namn på lokal <i class="fas fa-tag"></i></th></tr></thead><tbody>';

        // output data of each row
        while($row = $result->fetch_assoc()) {

            if ($row["Status"]=="K") {
                echo '<tr><td class="table-success">Klar</td>';
            } else if ($row["Status"]=="B") {
                echo '<tr><td class="table-warning">Bokad</td>';
            } else {
                echo '<tr><td class="table-danger">Ej bokad</td>';
            }
            if ($row["Typ"] == "F") {
                //echo " Förtid ";
                echo '<td class="table-primary">Ja</td>';
            } else {
                echo '<td>Nej</td>';
            }
            echo  '<td><a href="fget_lokal.php?lokal=' . $row["LokalKod"] . '">' . $row["lokal"] . '</a></td></tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Vi hittade tyvärr inga lokaler i vår databas. Vänligen kontakta ansvarig.</div>';
    }

    $conn->close();
    ?>

  </div>
</main>

<?php require("footer.php"); ?>
