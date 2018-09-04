<?php require("header.php") ?>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Startsida</a></li>
        <?php
        require("open_database.php");

        $lokalkod = $_GET["lokal"];

        $result = $conn->query("SELECT * FROM vallokal WHERE LokalKod='" . htmlspecialchars($lokalkod) . "'");

        $row = $result->fetch_assoc();
        $lan = $row["LanKod"];
        $kommun = $row["KommunKod"];

        $result = $conn->query("SELECT * FROM Län WHERE LänID='" . htmlspecialchars($lan) . "'");
        echo '<li class="breadcrumb-item"><a href="fget_kommuner.php?lan=' . $lan . '">' . $result->fetch_assoc()["Namn"] . '</a></li>';

        $result = $conn->query("SELECT * FROM Kommun WHERE KommunID='" . htmlspecialchars($kommun) . "' AND LänID='" . htmlspecialchars($lan) . "'");
        $kommun_namn = $result->fetch_assoc()["Namn"];
        echo '<li class="breadcrumb-item"><a href="fget_lokaler.php?kommun=' . $kommun . '&lan=' . $lan . '">' . $kommun_namn . '</a></li>';

        $result = $conn->query("SELECT * FROM vallokal WHERE LokalKod='" . htmlspecialchars($lokalkod) . "'");
        $lokal_namn = $result->fetch_assoc()["lokal"];

        echo '<li class="breadcrumb-item active" aria-current="page">' . $lokal_namn . '</li>';
        ?>
      </ol>
    </nav>
  </div>
</div>

<main class="row">
  <div class="col-md-8 offset-md-2">

    <?php
    $result = $conn->query('SELECT * FROM vallokal where LokalKod="' . htmlspecialchars($lokalkod) . '"');
    $row = $result->fetch_assoc();

    $status = $row["Status"];

    //echo $sql2 . '<br>';
    $result = $conn->query('SELECT * FROM Booking where LokalID="' .  htmlspecialchars($lokalkod) . '"');

    //echo $status . "<br><br>";
    if ($status == "K") {
        echo '<div class="alert alert-success" role="alert"><strong>Lokalen är klar! Bra jobbat! <i class="fas fa-check"></i></strong></div>';
        $done = TRUE;
        $booked = TRUE;
    } else {
        if ($result->num_rows > 0) {
             $booked = TRUE;
             echo '<div class="alert alert-warning" role="alert"><strong>Denna lokal är bokad. <i class="fas fa-user-clock"></i></strong></div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Denna lokal är obokad. <i class="fas fa-exclamation-triangle"></i></strong></div>';
        }
    }

    if ($row["Typ"] == "F") {
        echo '<h2>' . $row["lokal"] . ' <small class="text-muted">' . 'Förtidsröstning' . '</small></h2>';
    } else {
        echo '<h2>' . $row["lokal"] . ' <small class="text-muted">' . 'Vallokal' . '</small></h2>';
    }

    echo '<address><b>Adress</b>: ' . $row["Adress2"] . '<br><b>Postort</b>: ' . $row["Postort"] . '</address>';
    echo '<p><b>Antal röstande</b>: ' . $row["VoterCount"] . '</p>';

    echo '<h3>Valsedlar</h3>';
    echo '<table class="table table-bordered table-hover"><thead><tr><th>Riksdag</th><th>Landsting</th><th>Kommun</th></tr></thead>';
    echo '<tbody><tr><td class="table-warning">' . $row["AntalR"] . '</td><td class="table-primary">' . $row["AntL"] . '</td><td>' . $row["AntalK"] . '</td></tr></tbody></table>';

    echo '<h3>Öppettider</h3>';
    $array = explode(';', $row["Tider"]);

    echo '<table class="table-sm table-bordered table-hover">';
    foreach ($array as $arr) {
        echo '<tr><td><b>' . $arr . '</b></td></tr>';
    }
    echo '</table>';
    ?>

    <?php
    if (!$booked) {
        echo '<p><a href="boka_lokal.php?lokalkod=' . $lokalkod .'">Boka den här vallokalen</a></p>';
    } elseif (!$done) {
         echo 'Sätt lokalen som <a href="sklar.php?lokal=' . $lokalkod . '">Klar</a>.';
    }
    ?>

    <?php
    $lokalkod=$_GET["lokal"];

    //echo $kommun . ' ' . $lan . '<br>';
    $sql = 'SELECT * FROM vallokal where LokalKod="' .  htmlspecialchars($lokalkod) . '"';
    //echo $sql . '<br>';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $lat = $row["Lat"];
            $long = $row["Lng"];
        }
    } else {
        echo "0 results";
    }

    $murl = "gmap_lokal.php?lat=" . $lat . "&long=" . $long;
    //echo $murl . '<br>';
    $conn->close();
    ?>

    <div class="gmap">
    <!--<p><button type="button" onclick="loadDoc()">Visa karta</button></p>-->
    </div>
    <script>
    function loadDoc() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("gmap").innerHTML =
          this.responseText;
        }
      };
      xhttp.open("GET", <?php echo $murl; ?>, true);
      xhttp.send();
    }
    </script>
    <p><a href="<?php echo $murl; ?>">Visa karta</a></p>
  </div>
</main>

<?php require("footer.php"); ?>
