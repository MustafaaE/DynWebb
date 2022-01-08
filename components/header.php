<?php 
require_once "../interface/connection.php";
require_once "../components/methods.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = connectToDB();
$stmt = $pdo -> prepare('SELECT * FROM users');
$stmt -> execute();

if(!empty($_GET['search']))
{
    $search = htmlspecialchars($_GET['search']);
}

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
    <div id="header-cont">
        <nav class="header-nav">
            <li><a href="../UX/index.php">Home</a></li>
            <li><a href="../UX/profil.php">Profile</a></li>
            <li><a href="../file-upload/index.php">Upload</a></li>
            <li><a href="../interface/logout.php">Log out</a></li>
        </nav>

        <form action="#" method="get">
                <input id="search" type="text" name="search" placeholder="Search">
                <input id="submit" type="submit" value="🔍">
        </form>
    </div>
<?php
    while($result = $stmt -> fetch())
    {
        if(!empty($_GET['search']))
        {
            if(strpos($result['username'], $search) !== false)
            {
                echo <<<TABLEROW
                <table>
                    <tr>
                        <th>Users</th>
                    </tr>

                    <tr>
                        <td>{$result['username']}</td>
                    </tr>
                </table>
                TABLEROW;
            }
        }
    }
?>