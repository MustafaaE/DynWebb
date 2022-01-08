<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connection.php';

$pdo = connectToDB();


$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$statement = $pdo ->prepare('insert into users(username,password,email)
values (:username,:password,:email)');
$statement ->bindValue('username', $username);
$statement ->bindValue('password', $hashedPassword );
$statement ->bindValue('email', $email);

try {
    $statement->execute();
    header("Location: ../UX/login.php");
} catch (PDOException $e) {
    var_dump($e ->getMessage());
}