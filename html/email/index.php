<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
</head>
<body>
    <h2>Skicka E-post</h2>
    <form action="validate-email.php" method="post">
        <label for="email">E-postadress:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Skicka</button>
    </form>
</body>
</html>
