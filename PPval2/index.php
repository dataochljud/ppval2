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
    <div class="alert alert-primary" role="alert">Hittade du ett fel i systemet? Vänligen meddela <a class="alert-link" href="mailto:johan.roos.tibbelin@piratpartiet.se">johan.roos.tibbelin@piratpartiet.se</a>. Tack på förhand. <i class="fas fa-heart"></i></div>
  </div>
</div>

<main class="row">
  <div class="col-md-8 offset-md-2">

    <p>Välkommen till Piratpartiets tjänst för valsedeldistribution. För att samordna denna insats använder du denna tjänst för att anmäla vilka vallokaler du siktar på att leverera till. Valsedlar kommer i posten.</p>

    <h5>Hur använder man tjänsten?</h5>

    <p>En lokal kan bokas genom att man navigerar till dess sida och trycker på "boka denna lokal". Om detta är första gången kommer du behöva fylla i dina uppgifter. Valsedlarna skickas till den address du uppger.</p>

    <p>När du fyllt i dina uppgifter markeras lokalen som "bokad" i listan, med en gul markering. Efter detta kan du nu boka fler lokaler (förhoppningsvis) utan att behöva skriva in uppgifter igen.</p>

    <p>När du fått valsedlarna, och levererat till respektive lokaler, bör du gå in på varje lokal och markera den som "klar".</p>

    <p>Om du inser att du ej kan leverera till en eller flera lokaler du bokat, var vänlig avboka dessa så fort som möjligt, så att andra förhoppningsvis ser detta och kan ställa upp.</p>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "johantibbelin_se_ppval";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM Län order by namn");
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">';
        echo '<thead><tr><th>Län <i class="fas fa-globe-africa"></i></th><th>Ca. antal röstberättigade <i class="fas fa-check"></i></th></tr></thead><tbody>';
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="fget_kommuner.php?lan=' . $row["LänID"] . '">' . $row["Namn"] . '</a></td>';
            echo '<td>' . $row["Röstb"] . '</td></tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Vi hittade tyvärr inga län i vår databas. Vänligen kontakta ansvarig.</div>';
    }

    $conn->close();
    ?>
  </div>
</main>

<?php require("footer.php"); ?>
