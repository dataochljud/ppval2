<?php require("includes/header.php") ?>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Startsida</a></li>
        <?php
        require("includes/open_database.php");

        $lokalkod = $_GET["lokal"];

        $result = $conn->query("SELECT * FROM vallokal WHERE LokalKod='" . htmlspecialchars($lokalkod) . "'");

        $row = $result->fetch_assoc();
        $lan = $row["LanKod"];
        $kommun = $row["KommunKod"];

        $result = $conn->query("SELECT * FROM Län WHERE LänID='" . htmlspecialchars($lan) . "'");
        echo '<li class="breadcrumb-item"><a href="fget_kommuner.php?lan=' . $lan . '">' . $result->fetch_assoc()["Namn"] . '</a></li>';

        $result = $conn->query("SELECT * FROM Kommun WHERE KommunID='" . htmlspecialchars($kommun) . "' AND LänID='" . htmlspecialchars($lan) . "'");
        $kommun_row = $result->fetch_assoc();
        $kommun_namn = $kommun_row["Namn"];

        if ($row["Typ"] == "F") {
            if (strpos($row["Tider"], '9/9') !== false) {
                echo '<li class="breadcrumb-item"><a href="fget_lokaler_b.php?kommun=' . $kommun . '&lan=' . $lan . '">' . $kommun_namn . ' (lokaler som används både som förtidsröstningslokal och valdagslokal)</a></li>';
            } else {
                echo '<li class="breadcrumb-item"><a href="fget_lokaler_f.php?kommun=' . $kommun . '&lan=' . $lan . '">' . $kommun_namn . ' (endast förtidslokaler)</a></li>';
            }
        } else {
            echo '<li class="breadcrumb-item"><a href="fget_lokaler_v.php?kommun=' . $kommun . '&lan=' . $lan . '">' . $kommun_namn . ' (endast valdagslokaler)</a></li>';
        }

        $result = $conn->query("SELECT * FROM vallokal WHERE LokalKod='" . htmlspecialchars($lokalkod) . "'");
        $lokal_namn = $result->fetch_assoc()["lokal"];

        echo '<li class="breadcrumb-item active" aria-current="page">' . $lokal_namn . '</li>';
        ?>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <?php
    if(isset($_COOKIE["PPval2user"])) {
        echo '<a class="btn btn-pirate" href="mina_lokaler.php" role="button">Mina lokaler <i class="fas fa-city"></i></a>';
    } else {
        echo '<form class="form-inline" action="login.php" method="GET"><label class="sr-only" for="email">E-postadress</label><div class="input-group mb-2 mr-sm-2"><div class="input-group-prepend"><div class="input-group-text">@</div></div><input type="email" class="form-control" id="email" name="email" placeholder="E-postadress"></div><button type="submit" class="btn btn-primary mb-2"><i class="fas fa-caret-right"></i> Logga in</button></form>';
    }
    ?>
    <hr>
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <?php

    $done = $booked = FALSE;

    // Hämta status för vallokalen (klar, bokad, obokad)
    $result = $conn->query('SELECT * FROM vallokal where LokalKod="' . htmlspecialchars($lokalkod) . '"');
    $lokal = $result->fetch_assoc();

    // Hämta bokningar för denna lokal
    $bookings = $conn->query('SELECT * FROM Booking where LokalID="' .  htmlspecialchars($lokalkod) . '"');

    if ($lokal["Status"] == "K") {
        echo '<div class="alert alert-success" role="alert"><strong>Lokalen är klar! Bra jobbat! <i class="fas fa-check"></i></strong></div>';
        $done = $booked = TRUE;
    } else {

        // Om lokalen inte är klar, är den bokad?
        if ($bookings->num_rows > 0) {
            echo '<div class="alert alert-warning" role="alert"><strong>Denna lokal är bokad. <i class="fas fa-user-clock"></i></strong></div>';
            $booked = TRUE;
        } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Denna lokal är obokad. <i class="fas fa-exclamation-triangle"></i></strong></div>';
        }
    }
    ?>

  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <?php
    // Är lokalen öppen för förtidsröstning?
    if ($lokal["Typ"] == "F") {
        echo '<h2>' . $lokal["lokal"] . ' <span class="badge badge-primary">Förtidsröstningslokal</span>';

        // Kolla om lokalen även är öppen på valdagen
        if (strpos($lokal["Tider"], '9/9') !== false) {
            echo ' <span class="badge badge-info">Valdagslokal</span></h2>';
        } else {
            echo '</h2>';
        }
    } else {
        echo '<h2>' . $lokal["lokal"] . ' <small class="badge badge-info">' . 'Valdagslokal' . '</small></h2>';
    }
    ?>

  </div>
</div>

<div class="row">
  <div class="col-md-4 offset-md-2">

    <?php
    echo '<address><b>Adress</b>: ' . $lokal["Adress2"] . ($lokal["Adress1"] == '' ? '' : ' | ' . $lokal["Adress1"]) . '<br><b>Postort</b>: ' . $lokal["Postort"] . '</address>';
    echo '<p><b>Antal röstande</b>: ' . $lokal["VoterCount"] . '</p>';
    ?>

  </div>
  <div class="col-md-4" style="margin-top: 20px">

    <?php
    if (!$booked) {
        echo '<a class="btn btn-primary" href="boka_lokal.php?lokalkod=' . $lokalkod .'" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Boka den här vallokalen <i class="fas fa-clipboard-list"></i></a>';
    } else {
        if(isset($_COOKIE["PPval2user"])) {
            $result = $conn->query('SELECT * FROM Booking JOIN vallokal ON Booking.lokalid = vallokal.lokalkod WHERE Booking.userid=' . $_COOKIE["PPval2user"] . ' AND Booking.LokalID="' . $lokalkod . '"');

            if ($result->num_rows > 0) {
                if (!$done) {
                    echo '<a class="btn btn-success" href="lokal_klar.php?lokal=' . $lokalkod . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Markera lokalen som klar <i class="fas fa-check"></i></a>';
                    echo '<a class="btn btn-danger" href="lokal_avboka.php?lokal=' . $lokalkod . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Avboka denna lokal <i class="fas fa-times"></i></a>';
                } else {
                    echo '<a class="btn btn-info" href="lokal_oklar.php?lokal=' . $lokalkod . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Markera som ej klar <i class="fas fa-minus"></i></a>';
                }
            }
        }
    }

    echo '<a class="btn btn-primary" href="https://www.google.com/maps/search/?api=1&query=' . $lokal["Lat"] . ',' . $lokal["Lng"] . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Öppna karta <i class="fas fa-map"></i></a>';
    ?>

  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <?php

    echo '<h3>Valsedlar</h3>';
    echo '<table class="table table-bordered table-hover"><thead><tr><th>Riksdag</th><th>Landsting</th><th>Kommun</th></tr></thead>';
    echo '<tbody><tr><td class="table-warning">' . $lokal["AntalR"] . '</td><td class="table-primary">' . $lokal["AntL"] . '</td><td>' . $lokal["AntalK"] . '</td></tr></tbody></table>';

    echo '<h3>Öppettider</h3>';
    $array = explode(';', $lokal["Tider"]);

    echo '<table class="table-sm table-bordered table-hover">';
    foreach ($array as $arr) {
        echo '<tr><td><b>' . $arr . '</b></td></tr>';
    }
    echo '</table>';
    ?>

  </div>
</div>

<?php require("includes/footer.php"); ?>
