<?php
// Inkludera din databasanlutningsfil och funktionerna
include_once('../functions.php');

// Testdata
$user_id = 1; // Använd ett giltigt användar-ID från din users-tabell
$code = bin2hex(random_bytes(16)); // Generera en slumpmässig kod

// Anropa funktionen och spara resultatet
$result = save_reset_password_code($user_id, $code);

// Kontrollera om funktionen lyckades
if ($result) {
    echo "Koden har sparats framgångsrikt i databasen.";
} else {
    echo "Misslyckades med att spara koden i databasen.";
}
?>

// id = 2

user_id = 1
code = 912b3f5794b10e7bb59fd87a9fd35f37

