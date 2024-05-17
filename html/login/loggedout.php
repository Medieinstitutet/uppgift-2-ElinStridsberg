<?php
// Starta sessionen
session_start();

// Töm alla sessionsvariabler
$_SESSION = array();

// Förstör sessionen
session_destroy();

// Redirect till utloggad sida
header("Location: logged-out.php");
exit();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Utloggad</title>
</head>
<body>
    <h1>Du har loggats ut</h1>
    <p>Du har framgångsrikt loggats ut från ditt konto.</p>
    <form method="post" action="/index">
        <button type="submit">Logga in igen</button>
    </form>
</body>
</html>
