<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Återställ lösenord</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message, .success-message {
            margin-top: 20px;
            font-size: 16px;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }
    
        .back-button {
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }
.back-button:hover {
    background-color: #0056b3;
}
    </style>
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
                // echo "User ID: "; // Debugging: Skriv ut user_id för att verifiera att det är korrekt
                // Generera ett random salt
                $salt = bin2hex(random_bytes(16)); // Slumpmässigt genererat salt
        
                // Skapa det hashade lösenordet med md5 och saltet
                $hashed_password = md5($new_password . $salt);
                // var_dump($hashed_password);
                // Uppdatera lösenordet i databasen
                $success = update_password($hashed_password, $salt, $code);
        
                if ($success) {
                    echo "Lösenordet har uppdaterats framgångsrikt!";
                    echo "<a href='/index.php' class='back-button'>Tillbaka till startsidan</a>";

                    
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
