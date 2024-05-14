<?php
// Starta en PHP-session för att hantera användarsessioner
session_start();
include_once('../functions.php');

// Inkludera functions.php för att använda dess funktioner

// Kontrollera om formuläret har skickats med POST-metoden
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Hämta e-postadressen från formuläret, om den är satt, annars sätt den till en tom sträng
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    // Hämta lösenordet från formuläret, om det är satt, annars sätt det till en tom sträng
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    // Hämta användaren från databasen baserat på den angivna e-postadressen
    $user = get_user_by_email($email);
    // Om användaren finns i databasen
    if ($user) {
        // Hämta det hashade lösenordet från databasen
        $hashed_password_from_db = $user["password"];
        
        // Jämför det angivna lösenordet med det hashade lösenordet från databasen
        if ($password === $hashed_password_from_db) {
            // Om lösenorden matchar, sätt sessionvariabler för att indikera att användaren är inloggad
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_role"] = $user["role"];
            $_SESSION["is_signed_in"] = true;
          
            // Omdirigera användaren till sidan "my-pages" efter inloggning
            header('Location: /my-pages');
            exit();
        } else {
            // Om lösenordet inte matchar, sätt ett felmeddelande
            $error_message = "Felaktigt lösenord."; 
        }
    } else {
        // Om användaren inte finns i databasen, sätt ett felmeddelande
        $error_message = "Användaren finns inte.";
    }

}
?>



<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Logga in</h2>
    <?php
    // Visa eventuellt felmeddelande om det är satt
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
    <!-- Skapa ett formulär för inloggning med POST-metoden -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div>
            <label for="email">E-post:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Logga in">
        </div>
    </form>
</body>
</html>
