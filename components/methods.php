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
     echo "<img src='  $path ' class=gallery-image alt=''>";
      echo "</div>";
    }

} 

function following() {
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT follow_id FROM following WHERE follow_id = :id'); 
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $get = $stmt->fetchAll();
    foreach($get as $following){
     $follow = $following['follow_id'];
     print_r($follow);
    }
}

function followers() {
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT follower_id FROM following WHERE follower_id = :id'); 
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $get = $stmt->fetchAll();
    foreach($get as $followers){
     $follows = $followers['follower_id'];
     print_r($follows);
    }
}