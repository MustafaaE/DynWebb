<?php
require '../interface/connection.php';
require '../components/methods.php';

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = connectToDB();


$uploadDirectory = "/uploads/";
$currentDirectory = dirname(__DIR__ , 1);
$targetDirectory = $currentDirectory . $uploadDirectory;

$errors = [];



$fileName = $_FILES['image_file']['name'];
$fileSize = $_FILES['image_file']['size'];
$fileTmpName = $_FILES['image_file']['tmp_name'];
$fileType =$_FILES['image_file']['type'];
const MAX_SIZE = 5 * 1024 * 1024; //5MB

$tmp = explode('.',$fileName);
$fileExtension = strtolower(end($tmp));
$fileTypeAllowed = ['jpg','png'];
$uploadPath = $targetDirectory . basename($fileName);

$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$statement = $pdo ->prepare('insert into posts(image_file,description)
values (:image_file,:description)');
$statement ->bindValue('image_file', $uploadPath);
$statement ->bindValue('description', $description);




if(isset($_FILES['image_file'])) {

    if(!in_array($fileExtension,$fileTypeAllowed)) {
        $errors[] = "File type not allowed. Please use JPG or PNG file";
    }
    if($fileSize > MAX_SIZE){
        $errors[] = "File size must be under 5 MB";
    }
    if(empty($errors) == true) {
        $uploaded = move_uploaded_file($fileTmpName,$uploadPath);
        echo "Success";
        try {
            $statement -> execute();
            redirectTo("file-upload/index.php");
        } catch (PDOException $e) {
            var_dump($e ->getMessage());
        } 
    //    redirect_with_message('upload successfully');
    } else {
        print_r($errors);
    }

} 