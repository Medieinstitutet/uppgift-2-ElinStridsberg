<?php
// Starta sessionen för att använda sessionsvariabler
session_start();

// Inkludera din databasanlutningsfil och andra hjälpfunktioner
include_once('../functions.php');

// Kontrollera om användaren är inloggad
if (is_signed_in()) {
    // Hämta användarens ID från sessionsvariabeln
    $user_id = $_SESSION['user_id'];
    
    // Hämta användarens namn från databasen baserat på ID
    $user = get_user_by_id($user_id);
    $user_name = $user['name']; // Antag att namnet finns i en kolumn som heter 'name'

    // Visa användarens namn efter "Välkommen"
    echo "<p>Välkommen $user_name</p>";
} else {
    // Om användaren inte är inloggad, visa ett felmeddelande eller vidarebefordra användaren
    echo "Du är inte inloggad.";
}
?>
