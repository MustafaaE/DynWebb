<?php 
session_start();

function redirectTo($url = null)
{
    $url = $url ?? '';
    header("Location: http://localhost/DynWebb/$url");
    exit;
}

function isUserLoggedIn()
{
    if(!isset($_SESSION['user'])){
        redirectTo('../UX/login.php');
    }
}