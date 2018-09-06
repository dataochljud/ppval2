<?php
require("includes/open_database.php");

$email = $_GET["email"];
$result = $conn->query('SELECT * FROM User where mail="' .  htmlspecialchars($email) . '"');

if ($result->num_rows > 0) {
    $user_id = $result->fetch_assoc()["UserID"];
    $valid_user = TRUE;
} else {
    echo '<p style="font-size:14px;background:red;">Mailadressen finns ej i systemet<br>';
    echo "När du bokar dig på en lokal så skapas ditt konto automatiskt. <br>";
    $valid_user = FALSE;
}

if ($valid_user) {
    setcookie("PPval2user", $user_id , time() + (86400 * 30), "/"); //Spara kaka 30 dagar
}

header('Location: /ppval2/');
exit();
?>
