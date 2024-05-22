<?php
session_start();
include_once("./functions.php");
$mysqli = connect_database();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Min webbapplikation</title>
<style>
        body, html {
            height: 100%;
            width: 60%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h3{
            text-align: center;
            font-size: 30px;
        }
        .loggaIn {
            padding: 20px;
        
        }
        form{
            text-align: left;
            
        }
        .loggaIn input {
            display: block;
            margin-bottom: 10px; 
        }

        .loggaIn button {
            margin: 0 auto; 
            display: block; 
        }

       
</style>
</head>
<body>

    <div class="loggaIn">
    <h3>Logga in</h3>
    <?php
        include_once('./login/index.php');
    ?>
    
   </div></body>
</html>