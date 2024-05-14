<?php
session_start(); 
include_once('../functions.php');
// include('../components/header.php');
  
   // Starta sessionen för att använda sessionsvariabler

    // Kontrollera om användar-ID:et finns i sessionen
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        // Hämta användarens prenumerationer
        $prenumerationer = get_subscriptions_by_user_id($user_id);

    } else {
        // Om användar-ID:et inte finns i sessionen, visa ett felmeddelande eller vidarebefordra användaren
        echo "Användar-ID:et är inte tillgängligt.";
    }
    
  
  
  
  ?>
<p>Nyhetsbrev du prenumererar på: </p>
<ul>
<?php foreach ($prenumerationer as $prenumeration) : ?>
    <li>Prenumeration ID: <?php echo $prenumeration['id']; ?></li>
    <li>Användar-ID: <?php echo $prenumeration['user_id']; ?></li>
    <li>Nyhetsbrevs-ID: <?php echo $prenumeration['newsletter_id']; ?></li>
<?php endforeach; ?>
</ul>

<?php
    // include('../components/footer.php')
    ?>