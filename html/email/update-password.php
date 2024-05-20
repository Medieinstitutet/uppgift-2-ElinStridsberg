<?php
// Inkludera din databasanlutningsfil och andra hjälpfunktioner
include_once('../functions.php');

// Kontrollera om formuläret har skickats med POST-metoden
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Hämta återställningskoden och det nya lösenordet från formuläret
    $code = $_POST['code'];
    $new_password = $_POST['password'];

    // Uppdatera lösenordet baserat på återställningskoden
    $success = update_password($new_password, $code);

    // Kontrollera om uppdateringen lyckades
    if ($success) {
        // Om lösenordet har uppdaterats framgångsrikt, visa ett meddelande
        echo "Lösenordet har uppdaterats framgångsrikt!";
        var_dump($code);
var_dump($new_password);
    } else {
        // Om uppdateringen misslyckades, visa ett felmeddelande
        echo "Misslyckades med att uppdatera lösenordet. Vänligen försök igen.";

    }
}
?>
