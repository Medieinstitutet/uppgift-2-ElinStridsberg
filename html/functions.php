<?php

// Funktion för att kontrollera om användaren har en viss roll
function user_has_role($role) {
    // Kontrollera om användaren är inloggad och har rätt roll
    if (is_signed_in() && isset($_SESSION['user_role']) && $_SESSION['user_role'] == $role) {
        return true;
    } else {
        return false;
    }
}

// Funktion för att kontrollera om användaren är inloggad
function is_signed_in() {
    // Kontrollera om en sessionsvariabel för inloggning finns
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

?>
