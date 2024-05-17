<?php
session_start(); 
include_once('../functions.php');
include_once('../components/header.php');
?>

<h1>Dina prenumerationer</h1>

<?php
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];   
        $prenumerationer = get_subscriptions_by_user_id($user_id);
        foreach ($prenumerationer as $prenumeration) {
        $newsletter_id = $prenumeration['newsletter_id'];
        $newsletter = get_newsletter_by_id($newsletter_id);
                if ($newsletter) {
            echo "<p>Namn: " . $newsletter['name'] . "</p>";
            echo "<p>Beskrivning: " . $newsletter['description'] . "</p>";
        }
    }
} else {
    echo "Användar-ID:et är inte tillgängligt.";
}
?>