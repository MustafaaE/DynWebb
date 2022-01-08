<?php

require '../interface/connection.php';
require '../components/methods.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function uploadImagetoDB(){
require 'upload.php';
$pdo = connectToDB();
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$statement = $pdo ->prepare('insert into posts(image_file,description)
values (:image_file,:description)');
$statement ->bindValue('image_file', $uploadPath);
$statement ->bindValue('description', $description);

try {
    $statement -> execute();
    redirectTo("index.php");
} catch (PDOException $e) {
    var_dump($e ->getMessage());
}    
}