<?php
require_once "../components/methods.php";
require_once "../components/header.php";
require_once "../interface/connection.php";

isUserLoggedIn();

$pdo = connectToDB();
$stmt = $pdo->prepare("SELECT * FROM users");
$getUsers = $stmt -> execute();
$currentProfile =$_GET['id'];
$testar = $_SESSION['user']['user_id'];

if(!empty($_POST['follow']) && !empty($_POST['user_id']))
{
  $pdo = connectToDB();

  $follow_id = htmlspecialchars($_POST['follow']);
  $user_id = htmlspecialchars($_POST['user_id']);
  
  $stmtfollow = $pdo -> prepare("insert into following(user_id ,follower_id) VALUES (:user_id, :follower_id)");
  $stmtfollow ->bindValue('user_id', $user_id);
  $stmtfollow ->bindValue('follower_id', $follow_id);
  $stmtfollow -> execute();
}

if(!empty($_POST['unfollow']) && !empty($_POST['user_id']))
{
  $pdo = connectToDB();

  $unfollow_id = htmlspecialchars($_POST['unfollow']);
  $user_id = htmlspecialchars($_POST['user_id']);

  $stmtunfollow = $pdo -> prepare("DELETE FROM following WHERE user_id=('{$user_id}') AND follower_id =('{$unfollow_id}') ");
  $stmtunfollow -> execute();
}

?>

<header>

<div class="container">
  <div class="profile">

    <div class="profile-image">

      <img src="../assets/instagram-default-icon.png" height="150" width="150" alt="">

    </div>

    <?php echo "<span class='profile-user-name'>{$_SESSION['user']['user_id']}</span>" ?>
  
    <div class="profile-user-settings">

      <h2 class= "profile-username"><?php 
      $getUsers = $stmt->fetchAll();
      foreach($getUsers as $currentUser){
        if($currentUser['user_id'] == $currentProfile){
           print_r($currentUser['username']); 
        }
      }?> </h2>
    </div>

<?php

  $pdo = connectToDB();
  $follow_id = $_SESSION['user']['user_id'];
  $user_id = $_GET['id'];
  $stmt = $pdo -> prepare("SELECT COUNT(user_id) AS usercount FROM following WHERE user_id = :user_id AND follower_id = :follower_id");
  $stmt->bindValue(':user_id', $user_id);
  $stmt ->bindValue(':follower_id', $follow_id);
  $stmt->execute();
  $get = $stmt->fetch();
  
  if($get['usercount'] == 1){
  echo <<<TABLEROW
    <form method="post">
      <button class="btn-hide">Unfollow</button>
      <input type="hidden" name="unfollow" value="{$_SESSION['user']['user_id']}">
      <input type="hidden" name="user_id" id="user_id">
    </form>
  TABLEROW;
} else {
  echo <<<TABLEROW
    <form  method="post">
    TABLEROW;
     if(($_SESSION['user']['user_id'] != $user_id)){
      echo "<input class='btn-follow' type='submit' name='submit' value='Follow'>";}   
      echo <<<TABLEROW
      <input type="hidden" name="follow" value="{$_SESSION['user']['user_id']}">
      <input type="hidden" name="user_id" id="user_id">
    </form>
  TABLEROW;
   }

?>

    <div class="profile-stats">
      <ul>
        <li><span class="profile-stat-count"><?php followers(); ?></span> followers</li>
        <li><span class="profile-stat-count"><?php following(); ?></span> following</li>
      </ul>
    </div>
  </div>
</header>

<main>

<div class="container">

  <div class="gallery">

    <?php showImageInProfile();
    ?>

</div>

</main>
<script>
const user = document.querySelector('.profile-user-name');
const user_id = document.querySelector('#user_id');

let url_string = window.location;
let url = new URL(url_string);
let id = url.searchParams.get("id");

user.innerHTML = id;

user_id.setAttribute("value", id);

</script>

<?php require_once "../components/footer.php" ?>