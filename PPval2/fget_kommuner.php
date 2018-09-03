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
        <li class="breadcrumb-item"><a href="/ppval2/">Startsida</a></li>
        <?php
        $servername = "johantibbelin.se.mysql";
        $username = "johantibbelin_se_ppval";
        $password = "ppval2018";
        $dbname = "johantibbelin_se_ppval";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $lannr = $_GET["lan"];
        $result = $conn->query("SELECT * FROM Län WHERE LänID=" . htmlspecialchars($lannr));
        echo '<li class="breadcrumb-item active" aria-current="page">' . $result->fetch_assoc()["Namn"] . '</li>';
        ?>
      </ol>
    </nav>
  </div>
</div>

<main class="row">
  <div class="col-md-8 offset-md-2">
    <?php
    $result = $conn->query("SELECT * FROM Kommun WHERE länid=" . htmlspecialchars($_GET["lan"]) . " ORDER BY namn");
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">';
        echo '<thead><tr><th>Kommun <i class="fas fa-globe-africa"></i></th><th>Ca. antal röstberättigade <i class="fas fa-check"></i></th></tr></thead><tbody>';
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="fget_lokaler.php?kommun=' . $row["KommunID"] . '&lan='. $lannr . '">' . $row["Namn"] . '</a></td>';
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

<?php require("footer.php"); ?>
