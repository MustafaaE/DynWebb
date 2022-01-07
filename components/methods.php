<?php 
session_start();

function redirectTo($url = null)
{
    $url = $url ?? '';
    header("Location: http://localhost/grupparbete_dynweb/DynWebb/$url");
    exit;
}

function isUserLoggedIn()
{
    if(!isset($_SESSION['user'])){
        redirectTo('./login.php');
    }
}