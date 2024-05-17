<?php
include_once('../functions.php');

// Kontrollera om alla nödvändiga data finns
if (isset($_POST['newsletter_id'], $_POST['title'], $_POST['description'])) {
    // Hämta data från formuläret
    $newsletter_id = $_POST['newsletter_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Anropa den nya funktionen för att uppdatera nyhetsbrevet
    update_newsletter($newsletter_id, $title, $description);

    // Omdirigera tillbaka till redigeringsidan eller en bekräftelsesida
    header("Location: edit-newsletter.php?id=$newsletter_id");
    exit();
} else {
    // Om någon av nycklarna saknas, skriv ut ett felmeddelande eller hantera det på annat sätt
    echo "Någon av de nödvändiga nycklarna saknas i formuläret.";
}
?>
