<?php
include_once('../functions.php');
connect_database();

session_start(); // Säkerställ att sessionen startas för att få tillgång till $_SESSION
include_once('../components/header.php');

// Hämta nyhetsbrevets ID från URL-parametern
$newsletter_id = $_GET['id'] ?? '';


// Hämta användarens ID från sessionen
$owner_id = $_SESSION['user_id'] ?? '';


// Om nyhetsbrevets ID och användarens ID inte är tomma, hämta nyhetsbrevet från databasen
if (!empty($newsletter_id) && !empty($owner_id)) {
    $newsletter = get_newsletter_by_id($newsletter_id, $owner_id);
    
    // Kontrollera om nyhetsbrevet finns
    if ($newsletter) {
        // Hämta titel och beskrivning från nyhetsbrevet
        $name = $newsletter['name'];
        $description = $newsletter['description'];
    } else {
        // Om nyhetsbrevet inte finns, visa ett felmeddelande
        echo "Error: Newsletter not found.";
        exit(); // Avsluta skriptet om nyhetsbrevet inte hittas
    }
} else {
    // Om nyhetsbrevets ID eller användarens ID saknas, visa ett felmeddelande
    echo "Error: Newsletter ID or user ID missing.";
    exit(); // Avsluta skriptet om ID saknas
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Redigera Nyhetsbrev</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
         
        }

        h1 {
            text-align: center;
            margin-top: 90px;
            margin-bottom: 50px;
        }

        .editNewsletters {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        textarea{
            font-family: Arial, sans-serif;

        } 
    </style>
</head>
<body>
    <h1>Redigera Nyhetsbrev</h1>

    <!-- Skapa HTML-formulär för redigering av nyhetsbrev -->
    <form class='editNewsletters' method="post" action="update-newsletter.php">
        <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletter_id, ENT_QUOTES, 'UTF-8'); ?>">
        <label for="name">Titel:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <label for="description">Beskrivning:</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></textarea><br>
        <button type="submit">Uppdatera nyhetsbrev</button>
    </form>

</body>
</html>
