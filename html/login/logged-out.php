<?php
include_once('../functions.php');
include_once('../components/header-loggedout.php');

?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Utloggad</title>
    <style>


        .logout-container {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            padding: 30px;
            
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
            margin: 0 auto;
            margin-top: 200px;
        }

     
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>Du är nu utloggad</h1>
        <p><i>Tack för att du besökte oss.</i></p>
    </div>
</body>
</html>
