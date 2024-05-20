<?php
session_start();
include_once('../functions.php');
include('../components/header-loggedout.php');
?>
<style>
    h1{
        text-align: center;
    }
    div{
        margin: 0 auto;
        
    }
    .text{
        margin-top: -50px;
        text-align: center;
        margin-bottom: 50px;
    }


</style>
<h1>Alla nyhetsbrev</h1>
<p class="text"><i>Vänligen logga in för att prenumerera</i></p>

<?php

get_newsletters_loggeout();
?>