<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .resetPassword {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="resetPassword">
    <h2>Återställ lösenord</h2>
    <form action="validate-email.php" method="post">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Skicka</button>
    </form>
</div>
</body>
</html>
