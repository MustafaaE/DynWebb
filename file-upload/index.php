<?php 
require '../components/header.php';
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

    <form enctype="multipart/form-data"  action="./upload.php" method="post">

<main>

    <form enctype="multipart/form-data"  action="./upload.php" method="post">

<main>

    <form id="form" enctype="multipart/form-data"  action="./upload.php" method="post">
        <div>
            <label for="file">Select a file:</label>
            <input type="file" id="file" name="image_file"/>
            <label for="description">Write a description:</label>
            <textarea row="5" cols="50" name="description"> </textarea>
            
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</main>
</body>
</html>