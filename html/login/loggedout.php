<?php
// Starta sessionen
session_start();

// Töm sessionens variabler
session_unset();

// Förstör sessionen
session_destroy();

// Redirect till utloggad sida
header("Location: logged-out.php");
exit();
?>
