<?php
session_start();
include_once('../functions.php');
include('../components/header.php');

if (is_signed_in()) {
    $user_id = $_SESSION['user_id'];
  
    $user_newsletters = get_user_newsletters($user_id);
    if ($user_newsletters) {
        echo '<h2>Your Newsletters</h2>';
        echo '<ul>';
        foreach ($user_newsletters as $newsletter) {
            echo '<div class="newsletters">';
            echo '<p>' .'<b>'. $newsletter['name'] .'</b>'. '</p>';
            echo '<br>';
            echo '<p>'. $newsletter['description']. '</p>';
           
            echo '<form method="get" action="edit-newsletter.php">';
            echo '<input type="hidden" name="id" value="' . $newsletter['id'] . '">';
            echo '<button type="submit">Edit</button>';
            echo '</form>';
            echo '</div>';
        }
        echo '</ul>';
        
    } else {
        echo '<p>You have no newsletters.</p>';
       
    }
} else {
    echo '<p>Please sign in to view your newsletters.</p>';
}
?>

 <!DOCTYPE html>
        <html lang="sv">
        <head>
            <meta charset="UTF-8">
            <title>Your Newsletters</title>
<style>

    h2{
        text-align: center;
        margin-top: 90px;
        margin-bottom: 50px;
    }
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .newsletters{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    div {
        background-color: #fff;
        padding: 30px;
        padding-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        margin: 0 auto; 
        display: flex; 
        justify-content: center; 
        align-items: center;
    }
    button {
            width: 120px; 
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            background-color: #f0ad4e;
    }
     button:hover {
            background-color: #eea236;
        }
</style>

        </html>
