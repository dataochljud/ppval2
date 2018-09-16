<?php require("includes/header.php") ?>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Startsida</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lista över användare</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-md-8 offset-md-2">
    <h2>Lista över användare</h2>

    <p>Här kan du se vilka som varit med och delat ut valsedlar. Tabellen är ganska stor, så man kan scrolla höger och vänster för att se all information.</p>

    <div class="alert alert-warning" role="alert">Postnummret är inbakat med postorten. Detta är inte något man kan göra något åt i efterhand utan att manuellt fixa till i databasen. Vissa användare har endast skrivit postnummer, så man får tyvärr kolla upp det via extern karttjänst om man vill ha ut själva postorten.</div>
  </div>
</div>

<main class="row">
  <div class="col-md-8 offset-md-2">
    <table class="table table-responsive table-bordered table-hover">
      <?php
      require("includes/open_database.php");

      //echo $kommun . ' ' . $lan . '<br>';
      $result = $conn->query('SELECT * FROM `User` AS x INNER JOIN (SELECT DISTINCT `UserID` FROM `Booking`) AS y ON x.`UserID` = y.`UserID`');

      echo '<thead><tr><th>Namn</th><th>Efternamn</th><th>Adress</th><th>Postadress</th><th>Mobil</th><th>Mail</th></tr></thead><tbody>';

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $uid = $row["UserID"];
          //echo $uid;

              echo '<tr><td>' . $row["namn"] . "</td><td> " . $row["efternamn"] . "</td><td> " . $row["adress"] ."</td><td> " . $row["postadress"] . "</td><td> " . $row["telefon"] . "</td><td> " . $row["mail"] . '</td></tr>';
          }
          echo '</tbody>';

      } else {
          echo '<div class="alert alert-warning" role="alert">Vi hittade tyvärr inga användare i vår databas. Var god kontakta ansvarig om du tror detta är ett tekniskt fel.</div>';
      }

      $conn->close();
      ?>
    </table>
  </div>
</div>
