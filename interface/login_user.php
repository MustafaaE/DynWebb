<?php 
require 'connection.php';
require '../components/methods.php';
$user_id =$_SESSION['user']['user_id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$pdo = connectToDB();

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username'); 
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();


if(!password_verify($password, $user['password'])) {
  redirectTo('UX/login.php');
};

$_SESSION['user'] = $user;
echo $_SESSION['user'];
redirectTo('UX/index.php?id=' . $_SESSION['user']['user_id']);


