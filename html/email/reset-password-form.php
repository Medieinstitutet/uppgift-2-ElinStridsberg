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
            $new_password = $_POST['password']; // Lösenordet utan att hashas

            // Kontrollera om koden finns i databasen och hämta user_id
            $user_id = get_user_id_by_reset_code($code);

            if ($user_id) {
                // Uppdatera lösenordet i databasen
                $success = update_password($new_password, $code);

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
