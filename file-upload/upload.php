<?php
require '../interface/connection.php';
require '../components/methods.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$username = $_SESSION['user']['username'];

$pdo = connectToDB();


$uploadDirectory = "/Users/";
$currentDirectory = dirname(__DIR__ , 1);
$targetDirectory = $currentDirectory . $uploadDirectory;

$errors = [];

$user_id =$_SESSION['user']['user_id'];


$fileName = $_FILES['image_file']['name'];
$fileSize = $_FILES['image_file']['size'];
$fileTmpName = $_FILES['image_file']['tmp_name'];
$fileType =$_FILES['image_file']['type'];
const MAX_SIZE = 5 * 1024 * 1024; //5MB

$tmp = explode('.',$fileName);
$fileExtension = strtolower(end($tmp));
$fileTypeAllowed = ['jpg','png'];
$uploadPath = $targetDirectory .  $username . '/' . basename($fileName) ;
$uploadtoDatabasefile = '/Dynwebb' . $uploadDirectory .  $username . '/' . basename($fileName) ;

$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$statement = $pdo ->prepare('insert into posts(image_file,description,user_id)
values (:image_file,:description,:user_id)');
$statement ->bindValue('image_file', $uploadtoDatabasefile);
$statement ->bindValue('description', $description);
$statement ->bindValue('user_id', $user_id);




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