<?php
session_start(); 
include_once('../functions.php');
include_once('../components/header.php');
?>
        <style>
 body {
    width: 100%;
    margin: 0 auto;
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    text-align: center;
}

h1 {
    margin-top: 100px;
    margin-bottom: 50px;
    text-align: center;
}

div {
 
    margin: 0 auto;
    background-color: #fff;
    padding: 30px;
    padding-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px; 
}
p{
    text-align: center;
}
</style>
<h1>Dina prenumerationer</h1>

<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $subscribed_newsletters = get_user_subscribed_newsletters($user_id);

    if ($subscribed_newsletters) {
        foreach ($subscribed_newsletters as $newsletter) {
            echo "<div><p><b>Namn:</b> " . $newsletter['name'] . "</p>";
            echo "<p><b>Beskrivning:</b> " . $newsletter['description'] . "</p></div>";
        }
    } else {
        echo "Du prenumererar inte på några nyhetsbrev för närvarande.";
    }
} else {

    echo "Användar-ID:et är inte tillgängligt.";
}
?>
