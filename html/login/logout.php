<?php
// Starta sessionen
session_start();

session_unset();

session_destroy();

header("Location: logged-out.php");
exit();
?>
