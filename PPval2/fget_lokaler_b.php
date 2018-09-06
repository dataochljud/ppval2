<?php require("includes/header.php") ?>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Startsida</a></li>
        <?php
        require("includes/open_database.php");

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
    <h2>Lokaler öppna förtid och valdag</h2>

    <?php
    $result = $conn->query('SELECT * from Kommun WHERE KommunID=' . $kommun . ' AND länID=' . $lan);
    echo '<p>' . $kommun_namn . ' har cirka ' . $result->fetch_assoc()["Röstb"] . ' röstberättigade.</p>'
    ?>
  </div>
</div>

<div class="row" id="filter">
  <div class="col-md-8 offset-md-2">
    <a class="btn btn-info" href="fget_lokaler_f.php?kommun=<?php echo $kommun; ?>&lan=<?php echo $lan; ?>" role="button"><i class="fas fa-caret-right"></i> Visa endast förtidsröstningslokaler <i class="fas fa-filter"></i></a>
    <a class="btn btn-info" href="fget_lokaler_v.php?kommun=<?php echo $kommun; ?>&lan=<?php echo $lan; ?>" role="button"><i class="fas fa-caret-right"></i> Visa endast valdagens lokaler <i class="fas fa-filter"></i></a>
  </div>
</div>

<main class="row">
  <div class="col-md-8 offset-md-2">

    <?php
    //echo $sql . '<br>';
    $result = $conn->query("SELECT * FROM vallokal WHERE KommunKod=" .  htmlspecialchars($kommun) . " AND LanKod=" .  htmlspecialchars($lan) . " order by Typ");
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">';
        echo '<thead><tr><th>Status <i class="fas fa-clipboard-check"></i></th><th>Namn på lokal <i class="fas fa-tag"></i></th><th>Kort adress <i class="fas fa-map-pin"></i></th><th>Karta <i class="fas fa-map"></th></tr></thead><tbody>';

        $no_results = true;

        // output data of each row
        while($row = $result->fetch_assoc()) {

            if (strpos($row["Tider"], '9/9') !== false && count(explode(";", $row["Tider"])) > 1) {
                $no_results = false;

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
        }
        echo '</tbody></table>';

        if ($no_results) {
            echo '<div class="alert alert-warning" role="alert">Vi hittade tyvärr inga lokaler som är både förtids och valdagslokaler. Det finns säkert lokaler som endast är förtidslokaler och lokaler som endast är valdagslokaler. Använd filtreringsknapparna. :)</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Vi hittade tyvärr inga lokaler i vår databas. Vänligen kontakta ansvarig.</div>';
    }

    $conn->close();
    ?>

  </div>
</main>

<?php require("includes/footer.php"); ?>
