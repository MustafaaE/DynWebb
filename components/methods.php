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
    $get = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentDirectory = "http://localhost";
    $path = $currentDirectory .$get['image_file'] ;
    print_r($path);

} 

function test() {

    $pdo = connectToDB();
    $stmt = $pdo->prepare('SELECT image_file FROM posts WHERE user_id = :id'); 
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_CLASS);
    var_dump($results);


 /*    echo '<ul>';
    foreach ($results as $blogpost) {
        echo '<img href="../UX/profil.php?id='. $blogpost->user_id .'">'.$blogpost->image_file. '</img>';
    }
    echo '</ul>'; */
?>

    <div href ="" class="gallery-item" tabindex="0">

      <img src="<?php  ?>" class="gallery-image" alt=""> 

    <div class="gallery-item-info">

    </div>

  </div>
  <?php 
}
