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

function show_index_page_user()
{
    $pdo = connectToDB();
    $statement = $pdo->prepare('SELECT id, /* images, usernames, något mer  */ FROM /* Någonstans */');
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS);
    echo '<ul>';
    foreach ($results as $item) {
        echo '<li class="post"><a class="post" href="/dynweb/UX/index.php?id='. $item->id .'">'.$item->title. '</a></li>';
    }
    echo '</ul>';
}