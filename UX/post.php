<?php
require_once "../components/methods.php";
require_once "../components/header-post.php";
require_once "../interface/connection.php";
isUserLoggedIn();
$pdo = connectToDB();


if (isset($_POST['submit-comment'])) {
  $connect = connectToDB();
  
  $comment = $_POST['comment'];

  $stmt = $connect->prepare('INSERT INTO comments (content) VALUES (:comment)');
  $stmt->bindParam('comment', $comment);
  try {
    $stmt->execute();
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
  header( "refresh:1;url=http://localhost/dynwebb/" );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="wrapper">
    <div class="container">
      
      <article class="gallery-card">
        <button class="close"><i class="fa fa-times"></i></button>        
        <?php loadPictureSite(); ?>
        <section class="gallery-info">
          
          <div class="gallery-author">
            <img src="../assets/instagram-default-icon.png" height="50" width="50" alt="">
            <a href="#"><?php loadUserSite(); ?></a>
          </div>
          
          <p class="gallery-descr">
            <?php loadDescriptionSite(); ?>
          </p>
  
          
          <div class="gallery-comments">
            <form  method="POST">
              <div class="comment-add">
                <input name="comment" id="comment-input" autocomplete="off" maxlength="60" placeholder="Say something nice..">
                <button name="submit-comment">Submit</button>
              </form>
            </div>
            <?php loadComments(); ?>
          </div>
          
        </section>
      </article>
      
    </div>
  </div>

  <?php 
    require_once "../components/footer.php";
  ?>
  
  <style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,700');
    
    * {
      margin: 0;
      padding: 0;
      font-family: 'lato', sans-serif;
    }
    
    a {
      color: #039BE5;
      text-decoration: none;
    }
    
    a:hover {
      text-decoration: underline;
    }
    
    hr {
      border: none;
      border-top: 1px dotted #aaa;
    }
    
    .wrapper {
      text-align: center;
    }
    
    .container {
      display: inline-block;
    }
    
    .gallery-card {
      margin-top: 40px;
      display: grid;
      width: 1200px;
      height: 600px;
      box-shadow: 1px 2px 4px #aaa;
      position: relative;
      
      grid-template-columns: 0.6fr 0.4fr;
      grid-template-areas: 'image info';
    }
    
    .gallery-image {
      position:relative;
      grid-area: image;
      background-image: url(https://cdn-image.foodandwine.com/sites/default/files/styles/medium_2x/public/1519844002/fast-food-mobile-apps-chick-fil-a-FT-BLOG0218.jpg?itok=7d_gu0JA);
      background-size: cover;
    }
    
    .more {
      transition: .1s;
      position:absolute;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      background-color: rgba(0, 0, 0, .85);
      color: #fff;
      border: none;
      padding: 8px 30px;
      font-weight: bold;
      border-radius: 20px;
      outline: 0;
      cursor: pointer;
      animation: float 5s infinite;
      font-size: 18px;
    }
    
    .more:active {
      transition: .1s;
      bottom: -16px;
      background-color: #F50057;
      animation: none;
    }
    
    @keyframes float {
      0% {box-shadow: none;}
      50% {box-shadow: 0 0 0 5px rgba(245,0,87, .7);}
      100% {box-shadow: none;}
    }
    
    .gallery-info {
      grid-area: info;
      padding: 20px;
      text-align: left;
    }
    
    .close {
      background: none;
      border: none;
      color: #aaa;
      font-size: 14px;
      position: absolute;
      top: 5px;
      right: 10px;
      cursor: pointer;
      outline: 0;
    }
    
    .gallery-title {
      font-size: 26px;
    }
    
    .gallery-author img {
      height: 3em;
      border-radius: 3px;
    }
    
    .gallery-author a {
      font-size: 16px;
      vertical-align: top;
      margin-left: 4px;
    }
    
    .gallery-descr {
      margin: 20px 0 15px;
      font-size: 15px;
    }
    
    .gallery-actions {
      margin-bottom: 15px;
    }
    
    .gallery-actions span {
      margin-right: 10px;
      font-size: 14px;
    }
    
    .gallery-actions .fa {
      cursor: pointer;
    }
    
    .gallery-actions .fa-heart {
      color: #F50057;
    }
    
    .gallery-tags {
      margin-bottom: 15px;
    }
    
    .gallery-tags a {
      margin: 0 2px;
      font-size: 14px;
      color: rgba(0, 0, 0, .8);
      background-color: #eee;
      padding: 4px;
      border-radius: 3px;
    }
    
    .gallery-tags a:hover {
      text-decoration: none;
      background-color: #ddd;
    }
    
    .gallery-comments {
      margin-top: 15px;
    }
    
    .chars-counter {
      font-size: 12px;
      color: #aaa;
    }
    
    .comment-add {
      display: block;
      margin-bottom: 20px;
    }
    
    .comment-add input {
      display: block;
      border: 1px solid #ccc;
      padding: 10px;
      width: calc(100% - 20px);
      outline: 0;
      background-color: #fafafa;
      border-radius: 3px;
    }
    
    .comment {
      margin-top: 8px;
      font-size: 15px;
    }
    
    .comment a {
      font-weight: bold;
      cursor: pointer;
    }
    
    .more-comments {
      margin-top: 15px;
      display: block;
      color: #aaa;
    }
    
    @media only screen and (max-width: 1200px) {
      .gallery-card {
        height: auto;
        width: 800px;
        margin-top: 0;
        grid-template-columns: auto;
        grid-template-rows: 1fr 1fr;
        grid-template-areas: 'image' 'info';
      }
      
      .gallery-title {
        margin-top: 10px;
      }
    }
    
    @media only screen and (max-width: 800px) {
      .gallery-card {
        width: auto;
      }
    }
    </style>
    <script>
      $(document).ready(function() {
          let default_color = $(".chars-counter").css("color");

          $("#comment-input").on('keydown keyup', function() {
            let comment_len = $(this).val().length;
            
            $("#chars-current").html(comment_len);
            
            if(comment_len == 60)
              $(".chars-counter").css("color", "red");
            
            if(comment_len < 60 && $('.chars-counter').css("color") != default_color)
              $(".chars-counter").css("color", default_color);
          });
          
        });
    </script>
    
  </body>
  </html>