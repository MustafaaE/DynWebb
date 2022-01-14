<?php
require_once "../interface/connection.php";
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_id =$_SESSION['user']['user_id'];
$username = $_SESSION['user']['username'];
function redirectTo($url = null)
{
    $url = $url ?? '';
    header("Location: http://localhost/DynWebb/$url");
    exit;
}

function isUserLoggedIn()
{
    if (!isset($_SESSION['user'])) {
        redirectTo('../dynwebb/UX/login.php');
    }
}

function listProfile()
{
    $pdo = connectToDB();
    $statement = $pdo->prepare('SELECT user_id FROM users WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $_GET['id']);
    var_dump($_GET['id']);
    $statement->execute();
    $results = $statement->fetch(PDO::FETCH_ASSOC);
    print_r($results);
}

function showImageInProfile()
{
    
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT * FROM posts LEFT JOIN users ON posts.user_id = users.user_id WHERE posts.user_id = :id
    ORDER BY created_time DESC');
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $get = $stmt->fetchAll(pdo::FETCH_OBJ);
    $imagelinkstarter = 'http://localhost/DynWebb/UX/post.php';
    foreach ($get as $image) {
        $currentDirectory = "http://localhost/Dynwebb/Users";
        $path = $currentDirectory . '/' . $image->username . $image ->image_file;
        echo "<div class=gallery-item tabindex=0>";
        echo "<a href= '{$imagelinkstarter}?id={$image->post_id}'><img src='{$path}'class=gallery-image> </a>";
        echo "</div>";
    }
}

function following()
{
    $currentProfile =$_GET['id'];
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT COUNT(follower_id) FROM following WHERE follower_id = :id');
    $stmt->bindParam(':id', $currentProfile);
    $stmt->execute();
    $get = $stmt->fetch();
    print_r($get[0]);
}

function followers()
{
    $currentProfile =$_GET['id'];
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT COUNT(user_id)FROM following WHERE user_id = :id');
    $stmt->bindValue(':id',$currentProfile);
    $stmt->execute();
    $get = $stmt->fetch();
    print_r($get[0]);

}

function username_index()
{
    $userid = $_SESSION['user']['user_id'];
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT * FROM users INNER JOIN posts ON users.user_id = posts.user_id WHERE users.user_id = :user_id');
    $stmt->execute(['user_id' => $userid]);
    $user = $stmt->fetch();
    print_r($user['username']);

}


function showSuggestedUsers()
{
    $username = $_SESSION['user']['username'];
    $pdo = connectToDB();
    $stmt = $pdo->prepare("SELECT * FROM users  WHERE NOT username = '$username'");
    $stmt->execute();
    $users = $stmt->fetchAll();

    echo "<div class='side-menu__suggestion'>" . "<ul>";
    foreach ($users as $user) {

        echo '<li class = "testlist">' . "<img src='../assets/instagram-default-icon.png' class='side-menu__suggestion-avatar'>"
            . '<a href = "profil.php?id=' . $user['user_id'] . '">' . $user['username'] .  "</a>" .  '</li>';
    }
    echo  "</div>" . "</ul>";
}




function ShowPostOnIndex() {

    $pdo = connectToDB();
    $user_id =$_SESSION['user']['user_id'];
    $stmt = $pdo->prepare('SELECT * FROM Users LEFT JOIN posts ON users.user_id = posts.user_id 
    LEFT JOIN following ON following.user_id = Posts.user_id WHERE following.follower_id = :id ORDER BY created_time DESC');
    $stmt->execute([':id' => $user_id]);
    $get = $stmt->fetchAll();
     foreach($get as $items) {
        $c= "http://localhost/Dynwebb/UX/post.php?id=";
        $getid = $items['post_id'];
        $sumlink = $c . $getid;
        $currentDirectory = "http://localhost/Dynwebb/Users/";
        $path = $currentDirectory .$items['username'] . $items['image_file'] ;
        
        echo "<article class='post'>";
        echo    "<div class='post__header'>";
        echo      "<div class='post__profile'>";
        echo        "<a href='#' class='post__avatar'>";
        echo         "<img src='../assets/instagram-default-icon.png' alt='User Picture'>";
        echo        "</a>";
        echo         "<a class=post__user href=#> $items[username] </a>"; 
        echo      "</div>";
        echo     "</div>";
        echo    "<div class='post__content'>";
        echo    "<div id='post__content-img'>";
        echo    "<a href='$sumlink'>";
        echo        "<img id='post__content-img' src='$path'>";
        echo    "</a>"; 
        echo    "</div>";
        echo    "</div>";
        echo    "<div class='post__footer'>";
        echo        '<div class="post__infos">';
        echo            '<div class="post__description">';
        echo            "<span> $items[description] </span>";
        echo           '</div>';
        echo        "<span class='post__date-time'> $items[created_time] </span>";
        echo        '</div>';
        echo      '</div>';
        echo '</article>';
     }
    }

    

function loadPictureSite(){

    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE posts.post_id = :id' );
    $stmt->execute( ['id' => $_GET['id']]);
    $get = $stmt->fetch(pdo::FETCH_OBJ);
    $currentDirectory = "http://localhost/Dynwebb/Users";
    $image =  $get->username;
    $file = $get->image_file; 
    $path =  $currentDirectory . '/' . $image  . $file;
    echo        "<img src='$path' width= 700px height=600px>";
    }


function loadDescriptionSite(){
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE posts.post_id = :id');
    $stmt->execute( ['id' => $_GET['id']]);
    $get = $stmt->fetch(pdo::FETCH_OBJ);
        $description = $get->description;
    echo "<p class='gallery-descr'> $description </p>"; 
}   

function loadUserSite(){
    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE posts.post_id = :id');
    $stmt->execute( ['id' => $_GET['id']]);
    $get = $stmt->fetch(pdo::FETCH_OBJ);
    $username = $get->username;
    $time = $get->created_time;
    echo "<span>$username ";
    echo "<p id='comment-time'>at : $time</p></span>";
}   


function loadComments(){
   $pdo = connectToDB();
   $user= $_SESSION['user']['user_id'];
   $stmt = $pdo -> prepare('SELECT comments.content, comments.created_time, comments.comment_id, users.username, comments.user_id AS commenteruserid,
    posts.post_id, posts.user_id AS postuserid FROM comments INNER JOIN users ON 
    comments.user_id = users.user_id INNER JOIN posts ON
    comments.post_id = posts.post_id WHERE posts.post_id = :id AND isVisible=1 ORDER BY comments.created_time ASC');
    $stmt->execute (['id' => $_GET['id']]);
    $get = $stmt->fetchAll(pdo::FETCH_OBJ);
  
    foreach($get as $comments) {
        echo  "<div class='comment'>";
        echo  "<span class = 'user-commenter'>{$comments->username} :</span> <span class='user-comment'>{$comments->content}</span>";
        if($_SESSION['user']['user_id'] == $comments->commenteruserid || $user  == $comments->postuserid ){
        echo  "<form id='comment-form' method='post'> <input type='submit' name='hide' value='x'> <input type='hidden' name='comment_id'
        value='{$comments -> comment_id}'> <input type='hidden' name='post_id' value='{$_GET['id']}'> <input type='hidden' name='user_id' value='{$comments-> commenteruserid}'> </form>";
        }
    
        echo  "<p id='comment-time'>time sent:{$comments-> created_time}</p>";
        echo  "</div>";
    }
    }

