<?php
include_once('../functions.php');
connect_database();

// Hämta nyhetsbrevets ID från URL-parametern
$newsletter_id = $_GET['newsletter_id'] ?? '';

// Om nyhetsbrevets ID inte är tomt, hämta nyhetsbrevet från databasen
if (!empty($newsletter_id)) {
    $newsletter = get_newsletter_by_id($newsletter_id);
    
    // Kontrollera om nyhetsbrevet finns
    if ($newsletter) {
        // Hämta titel och beskrivning från nyhetsbrevet
        $title = $newsletter['title'];
        $description = $newsletter['description'];
    } else {
        // Om nyhetsbrevet inte finns, visa ett felmeddelande
        echo "Error: Newsletter not found.";
    }
} else {
    // Om nyhetsbrevets ID inte finns i URL-parametrarna, visa ett felmeddelande
    echo "Error: Newsletter ID missing.";
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Redigera Nyhetsbrev</title>
</head>
<body>
    <h1>Redigera Nyhetsbrev</h1>

    <!-- Skapa HTML-formulär för redigering av nyhetsbrev -->
    <form method="post" action="update-newsletter.php">
        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $title; ?>"><br>
        <label for="description">Beskrivning:</label><br>
        <textarea id="description" name="description"><?php echo $description; ?></textarea><br>
        <button type="submit">Uppdatera nyhetsbrev</button>
    </form>

</body>
</html>


//TODO: ID MISSING