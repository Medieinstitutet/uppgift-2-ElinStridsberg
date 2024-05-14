<?php
session_start();

// Kontrollera om användaren är inloggad
if (!isset($_SESSION["user_id"])) {
    // Om användaren inte är inloggad, omdirigera tillbaka till inloggningsformuläret
    header('Location: index.php');
    exit();
}

// Visa välkomstmeddelande
echo "<h2>Välkommen, " . $_SESSION["user_email"] . "!</h2>";

// Visa en länk för att logga ut
echo '<a href="logout.php">Logga ut</a>';
?>
