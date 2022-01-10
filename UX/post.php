<?php
require_once "../components/methods.php";
require_once "../components/header.php";
require_once "../interface/connection.php";
isUserLoggedIn();
$pdo = connectToDB();

loadPictureSite();

loadComments();