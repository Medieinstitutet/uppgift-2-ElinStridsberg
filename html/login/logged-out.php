<?php
include_once('../functions.php');
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Utloggad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            background-color: #fff;
            padding: 30px;
            padding-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>Du är nu utloggad</h1>
        <p><i>Tack för att du besökte oss.</i></p>
        <a href="http://localhost:8080/index.php">Logga in igen</a>
    </div>
</body>
</html>
