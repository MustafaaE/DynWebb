<?php 
require_once "../components/methods.php";
require_once "../components/header.php";
require_once "../interface/connection.php";
isUserLoggedIn();
$pdo =connectToDB();
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt -> execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Profile Page</title>
</head>
<body>
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

      <h1 class="profile-user-name"><?php print_r($_SESSION['user']['username']); ?> </h1>
    
      
    </div>
          <button class="btn-follow">Följ</button>
          <buttuon class="btn-hide" hidden>avfölj</buttuon>
    <div class="profile-stats">
      <ul>
        <li><span class="profile-stat-count">188</span> followers</li>
        <li><span class="profile-stat-count">206</span> following</li>
      </ul>
    </div>
    <!-- End of profile section -->
  </div>
<!-- End of container -->
</header>

<main>

<div class="container">

  <div class="gallery">

     <div class="gallery-item" tabindex="0"> 
      <?php showAllAttributes() ?>

    </div>

    <div class="gallery-item" tabindex="0">

      <img src="https://images.unsplash.com/photo-1497445462247-4330a224fdb1?w=500&h=500&fit=crop" class="gallery-image" alt="">

      <div class="gallery-item-info">

        <ul>
          <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 89</li>
          <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 5</li>
        </ul>

      </div>

    </div>

    <div class="gallery-item" tabindex="0">

      <img src="https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=500&h=500&fit=crop" class="gallery-image" alt="">

      <div class="gallery-item-type">

        <span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

      </div>

      <div class="gallery-item-info">

        <ul>
          <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 42</li>
          <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
        </ul>

      </div>

    </div>

    <div class="gallery-item" tabindex="0">

      <img src="https://images.unsplash.com/photo-1502630859934-b3b41d18206c?w=500&h=500&fit=crop" class="gallery-image" alt="">

      <div class="gallery-item-type">

        <span class="visually-hidden">Video</span><i class="fas fa-video" aria-hidden="true"></i>

      </div>

      <div class="gallery-item-info">

        <ul>
          <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 38</li>
          <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
        </ul>

      </div>

    </div>

    <div class="gallery-item" tabindex="0">

      <img src="https://images.unsplash.com/photo-1498471731312-b6d2b8280c61?w=500&h=500&fit=crop" class="gallery-image" alt="">

      <div class="gallery-item-type">

        <span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>


  </div>
  <!-- End of gallery -->


</div>
<!-- End of container -->


</main>
<script>
const user = document.querySelector('.profile-user-name');

  let url_string = window.location;
  let url = new URL(url_string);
  let name = url.searchParams.get("username");
  let id = url.searchParams.get("user_id");

user.innerHTML = name;

</script>
</body>
</html>