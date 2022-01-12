<?php 
require_once "../interface/connection.php";
require_once "../components/methods.php";
$user_id =$_SESSION['user']['user_id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../UX/styles.css">
    <style> @import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap'); </style>
    <title>Instagram</title>
</head>
<body>
    <header id="header-cont">
        <nav class="header-nav">
            <li><a href="../UX/index.php?id=<?php echo $user_id; ?> ">Home</a></li>
            <li><a href="../UX/profil.php?id=<?php echo $user_id; ?> "> Profile </a></li>
            <li><a href="../file-upload/index.php">Upload</a></li>
            <li><a href="../interface/logout.php">Log out</a></li>
        </nav>
    </header>
<style>
.header-nav {
  display: flex;
  justify-content: space-evenly;
  list-style: none;
  height: 9rem;
}
</style>

</body>
</html>