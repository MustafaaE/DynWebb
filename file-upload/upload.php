<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$uploadDirectory = "/uploads/";
$currentDirectory = dirname(__DIR__ , 1);
$targetDirectory = $currentDirectory . $uploadDirectory;

$errors = [];



$fileName = $_FILES['my_file']['name'];
$fileSize = $_FILES['my_file']['size'];
$fileTmpName = $_FILES['my_file']['tmp_name'];
$fileType =$_FILES['my_file']['type'];
const MAX_SIZE = 5 * 1024 * 1024; //5MB

$tmp = explode('.',$fileName);
$fileExtension = strtolower(end($tmp));
$fileTypeAllowed = ['jpg','png'];


$uploadPath = $targetDirectory . basename($fileName);

if(isset($_FILES['my_file'])) {
  
    if(!in_array($fileExtension,$fileTypeAllowed)) {
        $errors[] = "File type not allowed. Please use JPG or PNG file";
    }
    if($fileSize > MAX_SIZE){
        $errors[] = "File size must be under 5 MB";
    }
    if(empty($errors) == true) {
        $uploaded = move_uploaded_file($fileTmpName,$uploadPath);
        echo "Success";
    //    redirect_with_message('upload successfully');
    } else {
        print_r($errors);
    }

}