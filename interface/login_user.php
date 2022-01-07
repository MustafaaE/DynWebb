<?php 
require_once "../interface/connection.php";
require_once "../components/methods.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$pdo = connectToDB();

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username'); 
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();
echo $user;

if(!password_verify($password, $user['password'])) {
  header('location: ../UX/login.php');
};

$_SESSION['user'] = $user;
echo $_SESSION['user'];
header('location: ../UX/index.php');