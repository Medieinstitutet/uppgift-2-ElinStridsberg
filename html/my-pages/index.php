<?php
session_start();

// Inkludera din databasanslutningsfil och andra hjälpfunktioner
include('../functions.php');

// Kontrollera om användaren är inloggad
if (!is_signed_in()) {
    // Om användaren inte är inloggad, omdirigera till inloggningssidan
    header("Location: login.php");
    exit(); // Avsluta skriptet för att säkerställa att ingen ytterligare kod körs
}

// Hämta användarens ID från sessionen
$user_id = $_SESSION['user_id'];

// Hämta användarens namn från databasen baserat på användar-ID:t
$user_name = get_username_by_id($user_id);
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Välkommen</title>
</head>
<body>
    <h2>Välkommen, <?php echo $user_name; ?></h2>
    <!-- Visa andra användarrelaterade uppgifter här -->
    <p>Din användarprofil</p>
    <p>Dina prenumerationer </p>
    <button onclick="window.location.href='/newsletter'">Dina prenumerationer</button>
</body>
</html>
