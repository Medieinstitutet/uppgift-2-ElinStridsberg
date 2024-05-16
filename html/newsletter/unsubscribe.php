<?php
session_start(); 
include_once('../functions.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["newsletter_id"])) {
        $user_id = $_SESSION['user_id'];
        $newsletter_id = $_POST["newsletter_id"];
        
        unsubscribe_from_newsletter($user_id, $newsletter_id);
        
        // Omdirigera användaren tillbaka till sidan där de klickade på avprenumerera
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
