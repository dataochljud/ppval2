<?php require("includes/header.php") ?>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="alert alert-primary" role="alert">Hittade du ett fel i systemet? Vänligen meddela <a class="alert-link" href="mailto:johan.roos.tibbelin@piratpartiet.se">johan.roos.tibbelin@piratpartiet.se</a>. Tack på förhand. <i class="fas fa-heart"></i></div>
    <div class="alert alert-danger" role="alert">Valdagen börjar närma sig med stora kliv och det är hög tid att boka vallokaler om vi ska ha möjlighet att skicka valsedlar innan klockan <strong>15:00 idag den 6/9</strong>. Om du missar detta och har möjlighet att hämta upp valsedlar, vänligen kontakta valsedelansvariga.</div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <?php
    if(isset($_COOKIE["PPval2user"])) {
        echo '<a class="btn btn-pirate" href="mina_lokaler.php" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Mina lokaler <i class="fas fa-city"></i></a>';
        echo '<a class="btn btn-pirate" href="anv_uppgifter.php" role="button" style="margin: 5px"><i class="fas fa-caret-right"></i> Mina uppgifter <i class="fas fa-user"></i></a>';
    } else {
        echo '<form class="form-inline" action="login.php" method="GET"><label class="sr-only" for="email">E-postadress</label><div class="input-group mb-2 mr-sm-2"><div class="input-group-prepend"><div class="input-group-text">@</div></div><input type="email" class="form-control" id="email" name="email" placeholder="E-postadress"></div><button type="submit" class="btn btn-primary mb-2"><i class="fas fa-caret-right"></i> Logga in</button></form>';
    }
    ?>
    <hr>
  </div>
</div>

<main class="row">
  <div class="col-md-8 offset-md-2">

    <p>Välkommen till Piratpartiets tjänst för valsedeldistribution. För att samordna denna insats använder du denna tjänst för att anmäla vilka vallokaler du siktar på att leverera till. <del>Valsedlar kommer i posten.</del></p>

    <h5>Hur använder man tjänsten?</h5>

    <p>En lokal kan bokas genom att man navigerar till dess sida och trycker på "boka denna lokal". Om detta är första gången kommer du behöva fylla i dina uppgifter. Ett konto skapas automatiskt med din e-postadress<del>, och valsedlarna skickas till den address du uppger</del>.</p>

    <p>När du fyllt i dina uppgifter markeras lokalen som "bokad" i listan, med en gul markering. Efter detta kan du nu boka fler lokaler (förhoppningsvis) utan att behöva skriva in uppgifter igen.</p>

    <p>När du fått/hämtat valsedlarna, och levererat till respektive lokaler, bör du gå in på varje lokal och markera den som "klar".</p>

    <p>Om du inser att du ej kan leverera till en eller flera lokaler du bokat, var vänlig avboka dessa så fort som möjligt, så att andra förhoppningsvis ser detta och kan ställa upp.</p>

    <?php
    require("includes/open_database.php");

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

<?php require("includes/footer.php"); ?>
