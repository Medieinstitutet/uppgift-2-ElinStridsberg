<?php
session_start(); 
include_once('../functions.php');
include_once('../components/header.php');
?>

<h1>Dina prenumerationer</h1>

<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Hämta användarens prenumererade nyhetsbrev
    $subscribed_newsletters = get_user_subscribed_newsletters($user_id);

    // Visa nyhetsbrevens namn och beskrivning
    if ($subscribed_newsletters) {
        foreach ($subscribed_newsletters as $newsletter) {
            echo "<p>Namn: " . $newsletter['name'] . "</p>";
            echo "<p>Beskrivning: " . $newsletter['description'] . "</p>";
        }
    } else {
        echo "Du prenumererar inte på några nyhetsbrev för närvarande.";
    }
} else {
    // Om användar-ID:et inte finns i sessionen, visa ett felmeddelande eller vidarebefordra användaren
    echo "Användar-ID:et är inte tillgängligt.";
}
?>
