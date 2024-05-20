<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Återställ lösenord</title>
    <!-- Länk till din CSS-fil för att styla sidan -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Återställ lösenord</h2>

        <?php
        // Kontrollera om återställningskoden finns som parameter i URL:en
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            ?>
            <form action="update-password.php" method="post">
                <!-- Dolt fält för att skicka återställningskoden till update-password.php -->
                <input type="hidden" name="code" value="<?php echo htmlspecialchars($code); ?>">
                <label for="password">Nytt lösenord:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Återställ lösenord</button>
            </form>
            <?php
        } else {
            echo "Ogiltig återställningskod.";
        }
        ?>
    </div>
</body>
</html>
