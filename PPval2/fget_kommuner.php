<?php require("includes/header.php") ?>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Startsida</a></li>
        <?php
        require("includes/open_database.php");

        $lannr = $_GET["lan"];
        $result = $conn->query("SELECT * FROM Län WHERE LänID=" . htmlspecialchars($lannr));
        echo '<li class="breadcrumb-item active" aria-current="page">' . $result->fetch_assoc()["Namn"] . '</li>';
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

<main class="row">
  <div class="col-md-8 offset-md-2">
    <?php
    $result = $conn->query("SELECT * FROM Kommun WHERE länid=" . htmlspecialchars($_GET["lan"]) . " ORDER BY namn");
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">';
        echo '<thead><tr><th>Kommun <i class="fas fa-globe-africa"></i></th><th>Lokaler <i class="fas fa-city"></i></th><th>Ca. antal röstberättigade <i class="fas fa-check"></i></th></tr></thead><tbody>';
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr><td>' . $row["Namn"] . '</td>';

            echo '<td class="text-center"><a class="btn btn-primary" href="fget_lokaler_f.php?kommun=' . $row["KommunID"] . '&lan='. $lannr . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Endast förtid</a><a class="btn btn-info" href="fget_lokaler_v.php?kommun=' . $row["KommunID"] . '&lan='. $lannr . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Endast valdag</a><a class="btn btn-dark" href="fget_lokaler_b.php?kommun=' . $row["KommunID"] . '&lan='. $lannr . '" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Öppna för båda</a></td>';

            echo '<td>' . $row["Röstb"] . '</td></tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Vi hittade tyvärr inga kommuner i vår databas. Vänligen kontakta ansvarig.</div>';
    }
    $conn->close();
    ?>
  </div>
</main>

<?php require("includes/footer.php"); ?>
