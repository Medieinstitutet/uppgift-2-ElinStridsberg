<?php
include_once('../functions.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code = $_POST['code'];
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $success = update_password($new_password, $code);
    var_dump($code);

    if ($success) {
        echo "Lösenordet har uppdaterats framgångsrikt!".$success.$new_password;
    } else {
        echo "Misslyckades med att uppdatera lösenordet. Vänligen försök igen.";
    }
}
?>
