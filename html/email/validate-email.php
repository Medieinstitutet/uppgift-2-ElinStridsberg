<?php
include('../functions.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $user = get_user_by_email($email);

    if ($user) {
        // Spara reset-koden i databasen
        $user_id = $user['id'];
        // $reset_code = bin2hex(random_bytes(16));
        // save_reset_password_code($user_id, $reset_code);

        // Skicka återställningslänken via e-post
        include_once('send-email.php');
    } else {
        echo "E-postadressen finns inte i databasen.";
    }
}
?>
