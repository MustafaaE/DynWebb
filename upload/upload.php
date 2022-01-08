<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/help.php';
const FLASH_ERROR = 'error';
const FLASH_WARNING = 'warning';
const FLASH_INFO = 'info';
const FLASH_SUCCESS = 'success';

const ALLOWED_FILES = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg'
];

const MAX_SIZE = 5 * 1024 * 1024; //  5MB

const UPLOAD_DIR = __DIR__ . '/upload';


$is_post_request = strtolower($_SERVER['REQUEST_METHOD']) === 'post';

$has_file = isset($_FILES['my_file']);

if (!$is_post_request || !$has_file) {
    redirect_with_message('Invalid file upload operation', FLASH_ERROR);
}

//
$status = $_FILES['my_file']['error'];
$filename = $_FILES['my_file']['name'];

$tmp = $_FILES['my_file']['tmp_name'];


// an error occurs
if ($status !== UPLOAD_ERR_OK) {
    redirect_with_message($messages[$status], FLASH_ERROR);
}

// validate the file size
$filesize = filesize($tmp);
if ($filesize > MAX_SIZE) {
    redirect_with_message('Error! your file size is ' . format_filesize($filesize) . ' , which is bigger than allowed size ' . format_filesize(MAX_SIZE), FLASH_ERROR);
}

// validate the file type
$mime_type = get_mime_type($tmp);
if (!in_array($mime_type, array_keys(ALLOWED_FILES))) {
    redirect_with_message('The file type is not allowed to upload', FLASH_ERROR);
}

// set the filename as the basename + extension
$fileName = pathinfo($filename, PATHINFO_FILENAME) . '.' . ALLOWED_FILES[$mime_type];
// new file location
$filepath = UPLOAD_DIR . '/' . $fileName;

// move the file to the upload dir
$success = move_uploaded_file($tmp, $filepath);
if ($success) {
    $imageSrc = "upload". "/" . $fileName;
    redirect_with_message('The file was uploaded successfully.', FLASH_SUCCESS, 'upload', 'upload_index.php', $imageSrc);
}

redirect_with_message('Error moving the file to the upload folder.', FLASH_ERROR);