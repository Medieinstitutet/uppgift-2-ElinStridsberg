<?php
session_start();
include_once('../functions.php');
include('../components/header.php');
?>
<style>
    h1{
        text-align: center;
    }
    div{
        margin: 0 auto;
        
    }


</style>
<h1>Alla nyhetsbrev</h1>

<?php
if (isset($_SESSION['message'])) {
    echo "<div id='message'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']); 
}

get_newsletters();
?>