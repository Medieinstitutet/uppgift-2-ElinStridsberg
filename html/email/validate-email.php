<?php
// Inkludera din databasanlutningsfil och andra hjälpfunktioner
include('../functions.php');

// Kontrollera om formuläret har skickats med POST-metoden
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Hämta e-postadressen från formuläret
    $email = $_POST['email'];

    // Kontrollera om e-postadressen finns i databasen
    $user = get_user_by_email($email);

    // Om användaren finns i databasen
    if ($user) {
        // Om e-postadressen finns i databasen, skicka e-posten
        include_once('send-email.php');
    } else {
        // Om e-postadressen inte finns i databasen, visa ett felmeddelande
        echo "E-postadressen finns inte i databasen.";
    }
}

?>
