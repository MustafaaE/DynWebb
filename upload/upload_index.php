<?php 
require_once "../components/header.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css"/>
    <title>PHP File Upload</title>
</head>
<body>
<main>
    <div>
        <?php if(isset($_SESSION['flash'])): ?>
            <p><?php echo $_SESSION['flash']['message'] ?></p>
            <img src="/<?php echo $_SESSION['flash']['filepath'] ?>" width="200" height="200" />
            <p><?php echo $_SESSION['flash']['filepath'] ?></p>
        <?php endif; ?>
    </div>

    <form enctype="multipart/form-data" action="./upload.php" method="post">
        <div>
            <label for="file">Select a file:</label>
            <input type="file" id="file" name="my_file"/>
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</main>
</body>
</html>