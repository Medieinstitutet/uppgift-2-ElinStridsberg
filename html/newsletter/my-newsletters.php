<?php
session_start();
include_once('../functions.php');
include('../components/header.php');

// Kontrollera om användaren är inloggad och hämta användar-ID
if (is_signed_in()) {
    $user_id = $_SESSION['user_id'];
  
    // Hämta användarens nyhetsbrev från databasen baserat på användar-ID
    $user_newsletters = get_user_newsletters($user_id);
    // Visa nyhetsbreven om de finns
    if ($user_newsletters) {
        echo '<h2>Your Newsletters</h2>';
        echo '<ul>';
        foreach ($user_newsletters as $newsletter) {
            echo '<li>' . $newsletter['name'] . ' - ' . $newsletter['description'] . '</li>';
                echo '<a href="edit-newsletter.php?id=' . $newsletter['id'] . '">Redigera</a></li>';

        }
        echo '</ul>';
    } else {
        echo '<p>You have no newsletters.</p>';
       
    }
} else {
    // Om användaren inte är inloggad, visa ett meddelande eller omdirigera till inloggningssidan
    echo '<p>Please sign in to view your newsletters.</p>';

}


?>
