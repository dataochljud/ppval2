<?php require("includes/header.php") ?>

<?php
require("includes/open_database.php");

$userid = $_COOKIE["PPval2user"];

$result = $conn->query('SELECT * FROM User where userid=' . $userid);

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
}
?>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Startsida</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mina lokaler</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <h2>Mina lokaler</h2>

    <p>Du har anmält dig till att dela ut valsedlar på följande lokaler:</p>
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <?php
    $result = $conn->query('SELECT * FROM Booking JOIN vallokal ON Booking.lokalid = vallokal.lokalkod WHERE Booking.userid =' . $userid);

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">';
        echo '<thead><tr><th>Status <i class="fas fa-clipboard-check"></i></th><th>Namn på lokal <i class="fas fa-tag"></i></th><th>Kort adress <i class="fas fa-map-pin"></i></th><th>Karta <i class="fas fa-map"></th></tr></thead><tbody>';

        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["Status"] == "K") {
                echo '<tr><td class="table-success">Klar</td>';
            } else if ($row["Status"] == "B") {
                echo '<tr><td class="table-warning">Bokad</td>';
            } else {
                echo '<tr><td class="table-danger">Ej bokad</td>';
            }
            echo  '<td><a href="fget_lokal.php?lokal=' . $row["LokalKod"] . '">' . $row["lokal"] . '</a></td>';

            echo '<td>' . ($row["Adress2"] == '' ? '??' : $row["Adress2"]) . ($row["Postort"] == '' ? '' : ', ' . $row["Postort"]) . ($row["Adress1"] == '' ? '' : ' | ' . $row["Adress1"]) . '</td>';
            echo '<td><a class="btn btn-primary" href="https://www.google.com/maps/search/?api=1&query=' . $row["Lat"] . ',' . $row["Lng"] . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Öppna karta <i class="fas fa-map"></i></a></td></tr>';
        }
        echo '</tbody></table>';
    }

    echo "</tbody></table>";
    ?>
  </div>
</main>

<?php require("includes/footer.php"); ?>
