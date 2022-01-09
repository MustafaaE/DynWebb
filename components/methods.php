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
        redirectTo('../dynwebb/UX/login.php');
    }
}

function listProfile() {
    require_once "../interface/connection.php";
    $pdo = connectToDB();
    $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $_GET['id']);
    var_dump($_GET['id']);
    $statement->execute();
    $results = $statement->fetch(PDO::FETCH_ASSOC);
    print_r($results);
}

function showAllAttributes() {
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT image_file FROM posts WHERE user_id = :id'); 
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $get = $stmt->fetchAll();
    foreach($get as $image){
    $currentDirectory = "http://localhost";
     $path =  $currentDirectory . $image['image_file'];
     echo "<div class=gallery-item tabindex=0>";
     echo "<img src='  $path ' class=gallery-image height='100' width='100' alt=''>";
     echo "<div>";
    }

} 

function test() {

    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT image_file FROM posts WHERE user_id = :id'); 
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_CLASS);
    var_dump($results);




}
