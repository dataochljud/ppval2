<?php require("mobile_detect.php"); ?>
<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Piratpartiet: valsedelsdistribution</title>

  <meta name="description" content="PP valsedelssystem">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript,Piratpartiet,valsedlar,system">
  <meta name="author" content="Johan Roos Tibbelin">

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/solid.css" integrity="sha384-VGP9aw4WtGH/uPAOseYxZ+Vz/vaTb1ehm1bwx92Fm8dTrE+3boLfF1SpAtB1z7HW" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css" integrity="sha384-1rquJLNOM3ijoueaaeS5m+McXPJCGdr5HcA03/VHXxcp2kX2sUrQDmFc3jR5i/C7" crossorigin="anonymous">
</head>
<body>
<div id="wrapper" class="container-fluid">
  <header class="row">
    <div class="col-md-8 offset-md-2">
      <a href="index.php"><img src="assets/icons/pirat-logga.png" alt="Piratpartiets logga" <? if ($mobile_browser) { echo ' width="300"';} ?>></a>
    </div>
  </header>
