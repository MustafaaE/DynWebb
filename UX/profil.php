<?php
require_once "../components/methods.php";
require_once "../components/header.php";
require_once "../interface/connection.php";

isUserLoggedIn();

$pdo = connectToDB();
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt -> execute();


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

<div>
  <?php 
  get_all();
  ?>
</div>
<div class="container">
  <div class="profile">

    <div class="profile-image">

      <img src="../assets/instagram-default-icon.png" height="150" width="150" alt="">

    </div>

    <?php  print_r($_SESSION['user']['user_id']); ?>
  
    <div class="profile-user-settings">

      <h1 class="profile-user-name"><?php print_r($_SESSION['user']['user_id']); ?> </h1>
    </div>

<?php

if(isset($_POST['submit']))
{
  $hide=2;

  echo <<<TABLEROW
    <form method="post">
      <button class="btn-hide">Unfollow</button>
      <input type="hidden" name="unfollow" value="{$_SESSION['user']['user_id']}">
      <input type="hidden" name="user_id" id="user_id">
    </form>
  TABLEROW;
}
?>

<?php if(!isset($hide)) { ?>
    <form action="" method="post">
      <input class="btn-follow" type="submit" name="submit" value="Follow">
      <input type="hidden" name="follow" value="<?php echo $_SESSION['user']['user_id']?>">
      <input type="hidden" name="user_id" id="user_id">
    </form>
<?php }?>

    <div class="profile-stats">
      <ul>
        <li><span class="profile-stat-count"><?php followers(); ?></span> followers</li>
        <li><span class="profile-stat-count"><?php following(); ?></span> following</li>
      </ul>
    </div>
    <!-- End of profile section -->
  </div>
<!-- End of container -->
</header>

<main>

<div class="container">

  <div class="gallery">

    <!-- <div class="gallery-item" tabindex="0"> -->
    <?php showImageInProfile();
    ?>

</div>
<!-- End of container -->

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