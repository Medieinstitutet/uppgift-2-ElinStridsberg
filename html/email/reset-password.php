<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Återställ lösenord</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f2f2f2; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; padding: 0; }
        .resetPassword { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; display: flex; flex-direction: column; align-items: center; }
        .resetPassword h2 { margin-bottom: 20px; }
        .resetPassword label { width: 100%; margin-bottom: 5px; text-align: left; }
        .resetPassword input[type="email"] { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .resetPassword button { width: 100%; padding: 10px; border: none; border-radius: 4px; background-color: #007bff; color: #fff; cursor: pointer; transition: background-color 0.3s; }
        .resetPassword button:hover { background-color: #0056b3; }
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
