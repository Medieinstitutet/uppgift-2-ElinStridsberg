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
    <h1>Welcome</h1>
    <button onclick="window.location.href='/account/create-account.php'">Create account</button>
    <button onclick="window.location.href='/login'">Log in</button>
    </div></body>
</html>