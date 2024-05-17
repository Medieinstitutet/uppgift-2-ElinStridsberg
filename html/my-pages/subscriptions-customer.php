<?php
// Starta sessionen först
session_start();

// Inkludera dina funktioner
include_once('../functions.php');
include_once('../components/header.php');


// Kontrollera om användaren är inloggad
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Omdirigera användaren till inloggningssidan om de inte är inloggad
    exit(); // Avsluta exekveringen här
}

// Hämta användarens ID från sessionen
$user_id = $_SESSION['user_id'];

// Hämta prenumeranterna för den aktuella användaren från databasen
$subscribers = get_subscribers_for_owner($user_id);
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Mina Prenumeranter</title>
</head>
<body>
    
    <h1>Mina Prenumeranter</h1>

    <?php if ($subscribers): ?>
        <table>
            <tr>
                <th>Namn</th>
                <th>E-post</th>
                <th>Nyhetsbrev</th>
            </tr>
            <?php foreach ($subscribers as $subscriber): ?>
                <tr>
                    <td><?php echo $subscriber['subscriber_name']; ?></td>
                    <td><?php echo $subscriber['subscriber_email']; ?></td>
                    <td><?php echo $subscriber['newsletter_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Inga prenumeranter för närvarande.</p>
    <?php endif; ?>
</body>
</html>
