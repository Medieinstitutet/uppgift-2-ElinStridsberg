<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Återställ lösenord</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Återställ lösenord</h2>
        <?php
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
        
            ?>
            <form method="POST" action="reset-password-form.php">
                <input type="hidden" name="code" value="<?php echo htmlspecialchars($_GET['code']); ?>">
                <label for="password">Nytt lösenord:</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Återställ lösenord</button>
            </form>
            <?php
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            include_once('../functions.php');
            $code = $_POST['code'];
            $new_password = $_POST['password'];
        
            // Kontrollera om koden finns i databasen och hämta user_id
            $user_id = get_user_id_by_reset_code($code);
        
            if ($user_id) {
                echo "User ID: " . $user_id; // Debugging: Skriv ut user_id för att verifiera att det är korrekt
                // Generera ett random salt
                $salt = bin2hex(random_bytes(16)); // Slumpmässigt genererat salt
        
                // Skapa det hashade lösenordet med md5 och saltet
                $hashed_password = md5($new_password . $salt);
                var_dump($hashed_password);
                // Uppdatera lösenordet i databasen
                $success = update_password($hashed_password, $salt, $code);
        
                if ($success) {
                    echo "Lösenordet har uppdaterats framgångsrikt!";
                } else {
                    echo "Misslyckades med att uppdatera lösenordet. Vänligen försök igen.";
                }
            } else {
                echo "Ogiltig återställningskod.";
            }
        }
        
        
        ?>
    </div>
</body>
</html>
