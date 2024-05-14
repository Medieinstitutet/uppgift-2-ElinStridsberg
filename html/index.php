<?php
session_start();
include_once("./functions.php");
$mysqli = connect_database();
// include('./account/create-account.php');
// get_users();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Min webbapplikation</title>
</head>
<body>
<div>
    <h1>Välkommen!</h1>
    <p>Vänligen logga in eller registrera dig nedan</p>
    <button onclick="window.location.href='/account/create-account.php'">Registrera</button>
    <button onclick="window.location.href='/login'">Logga in</button>
    </div></body>
</html>