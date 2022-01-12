<?php
require_once "../components/methods.php";
require_once "../components/header-post.php";
require_once "../interface/connection.php";
isUserLoggedIn();
$pdo = connectToDB();

$user_id =$_SESSION['user']['user_id'];
$username = $_SESSION['user']['username'];

if(!empty($_POST['comment']) && !empty($_POST['post-id'])) {

    $user_id =$_SESSION['user']['user_id'];
    $comment = htmlspecialchars($_POST['comment']);
    $post_id = htmlspecialchars($_POST['post-id']);

    $stmt = $pdo->prepare('INSERT INTO comments (content,user_id,post_id) VALUES (:comment,:user_id,:post_id)');
  
    $stmt->bindValue('comment', $comment);
    $stmt->bindValue('user_id', $user_id);
    $stmt->bindValue('post_id', $post_id);
    $stmt -> execute();
  
   header("Location: ../UX/post.php?id=$post_id");
  
  }

  if(!empty($_POST['hide']))
  {
    $comment_id = htmlspecialchars($_POST['comment_id']);
    $post_id = htmlspecialchars($_POST['post_id']);
    $user_id = htmlspecialchars($_POST['user_id']);

    $stmt = $pdo -> prepare("UPDATE comments SET isVisible=0 WHERE comment_id=('{$comment_id}') AND post_id=('{$post_id}') AND user_id=('{$user_id}')");
    $stmt -> execute();
  }

?>
  <div class="wrapper">
    <div class="container">
      
      <article class="gallery-card">
        <button class="close"><i class="fa fa-times"></i></button>        
        
        <?php loadPictureSite(); ?>
        <section class="gallery-info">
          
          <div class="gallery-author">
            <img src="../assets/instagram-default-icon.png" height="50" width="50" alt="">
            <?php loadUserSite(); ?>
          </div>
          
            <?php loadDescriptionSite(); ?>
          
          <hr>
          
          <div class="gallery-comments">

          <form  method="post">

              <div class="comment-add">

                <input name="comment" id="comment-input" autocomplete="off" maxlength="60" placeholder="Say something nice..">

                <input type="hidden" name="post-id" value="<?php echo $post_id = $_GET['id']; ?>">

                <input type="submit" value="Submit">

                </div>

              </form>
            <?php loadComments(); ?>
            
            <a href="#" class="more-comments">Show more...</a>
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
      text-decoration: none;
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
    
    .gallery-author{
      display: grid;
      grid-template-columns: 15% 85%;
    }

    .gallery-author img {
      height: 3em;
      border-radius: 3px;
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
    
    .comment{
      margin: 0;
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
    
    .user-commenter {
      font-size: 15px;
      font-weight: bold;
      color: black;
    }
    .user-comment {
      font-size: 15px;
      color: darkslategrey;
    }
    .more-comments {
      margin-top: 15px;
      display: block;
      color: #aaa;
    }

    #comment-time{
      color: lightgray;
      font-size: 10px;
    }

    #comment-form{
      display: flex;
      justify-content: flex-end;
      margin-top: -17px;
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
