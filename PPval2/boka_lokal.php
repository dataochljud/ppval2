<?php require("includes/header.php") ?>

<?php
require("includes/open_database.php");

$lokalkod=$_GET["lokalkod"];
$result = $conn->query('SELECT * FROM vallokal where LokalKod="' . htmlspecialchars($lokalkod) . '"');
$lokal = $result->fetch_assoc();

$first_name = $last_name = $street_adress = $post_address = $phone_number = $email_address = '';

if(isset($_COOKIE["PPval2user"])) {
    $result = $conn->query('SELECT * FROM User where userid=' . $_COOKIE["PPval2user"]);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $first_name = $row["namn"];
            $last_name = $row["efternamn"];
            $street_adress = $row["adress"];
            $post_address = $row["postadress"];
            $phone_number = $row["telefon"];
            $email_address = $row["mail"];
        }
    }
}
?>

<main class="row">
  <div class="col-md-8 offset-md-2">
    <h2>Lokal: <?php echo $lokal["lokal"]; ?></h2>
    <hr>

    <form action="boka_lokal_save.php" metod="GET">
      <input type="hidden" name="lokalkod" value="<?php echo $lokalkod == '' ? '' : $lokalkod; ?>">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="first-name">Förnamn</label>
          <input type="text" class="form-control" id="first-name" name="first_name" placeholder="Kalle" value="<?php echo $first_name == '' ? '' : $first_name; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="last-name">Efternamn</label>
          <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Anka" value="<?php echo $last_name == '' ? '' : $last_name; ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="street-address">Adress</label>
        <input type="text" class="form-control" id="street-address" name="street_address" placeholder="Fågelvägen 7" value="<?php echo $street_adress == '' ? '' : $street_adress; ?>">
      </div>
      <div class="form-group">
        <label for="post-address">Postadress</label>
        <input type="text" class="form-control" id="post-address" name="post_address" placeholder="144 52 Stockholm" value="<?php echo $post_address == '' ? '' : $post_address; ?>">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email-address">E-postadress</label>
          <input type="email" class="form-control" id="email-address" name="email_address" placeholder="kalle@anka.se" value="<?php echo $email_address == '' ? '' : $email_address; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="phone-number">Mobilnummer</label>
          <input type="tel" class="form-control" id="phone-number" name="phone_number" placeholder="073 678 42 31" value="<?php echo ($phone_number == '' ? '' : $phone_number); ?>">
        </div>
      </div>

      <hr>

      <button type="submit" class="btn btn-primary"><i class="fas fa-caret-right"></i> Boka denna lokal <i class="fas fa-clipboard-list"></i></button>
    </form>
  </div>
</main>
