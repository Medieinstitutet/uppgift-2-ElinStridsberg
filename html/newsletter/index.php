<?php
session_start(); 
include_once('../functions.php');
// include('../components/header.php');
  
   // Starta sessionen för att använda sessionsvariabler
?>
<h1>Dina prenumerationer</h1>
<?php
    // Kontrollera om användar-ID:et finns i sessionen
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        // Hämta användarens prenumerationer
        $prenumerationer = get_subscriptions_by_user_id($user_id);

    // Loopa igenom prenumerationer och hämta information om nyhetsbreven
    foreach ($prenumerationer as $prenumeration) {
        $newsletter_id = $prenumeration['newsletter_id'];
        $newsletter = get_newsletter_by_id($newsletter_id);
        
        // Visa namn och beskrivning av nyhetsbrevet
        if ($newsletter) {
            echo "<p>Namn: " . $newsletter['name'] . "</p>";
            echo "<p>Beskrivning: " . $newsletter['description'] . "</p>";
        }
    }

} else {
    // Om användar-ID:et inte finns i sessionen, visa ett felmeddelande eller vidarebefordra användaren
    echo "Användar-ID:et är inte tillgängligt.";
}
?>