<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles-3.css">
    <title>Footer</title>
</head>
<body>
 <!-- Site footer -->
 <footer class="site-footer">

  <div class="footer-cont">
      <h3 class="footer-header">Location</h3>
      <p>Drottninggatan 4B, 212 11 Malmö</p>
  </div>
  <div>
    <h3 class="footer-header">Quick links</h3>
    <nav class="footer-nav">
        <li><a href="../UX/index.php">Home</a></li>
        <li><a href="../UX/profil.php?id=<?php echo $user_id; ?> "> Profile </a></li>
        <li><a href="../file-upload/index.php">Upload</a></li>
        <li><a href="../interface/logout.php">Log out</a></li>
    </nav>
   </div>



   <div class="footer-cont">
     <h3 class="footer-header">Created By</h3>
     <p>Grupp 1</p>
  </div>
</footer>

</body>
</html>