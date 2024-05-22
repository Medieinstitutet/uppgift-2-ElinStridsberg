<?php
session_start();

include('../functions.php');
include_once('../components/header.php');
if (!is_signed_in()) {

    header("Location: index.php");
    exit(); 
}

$user_id = $_SESSION['user_id'];

$user_name = get_username_by_id($user_id);
?>
<style>
    h1{
        text-align: center;
        margin-top: 200px;
    }
</style>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Välkommen</title>
</head>
<body>
    <h1>Välkommen <i><?php echo $user_name; ?></i></h1>
</body>
</html>
