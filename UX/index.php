<?php
require_once "../components/methods.php";
require_once "../components/header.php";
require_once "../interface/connection.php";
//require_once "../components/footer.php";
isUserLoggedIn();

 $user_id =$_SESSION['user']['user_id'];
 $username = $_SESSION['user']['username'];
 print_r($user_id);
 print_r($username);
 $pdo = connectToDB();
?>

    <main class="main-container">
        <section class="content-container">
        <div class="content">
            <?php ShowPostOnIndex(); ?>
        </div>
        </section>

        <section class="side-menu">
            <div class="side-menu__user-profile">
                <a href="../UX/profil.php?id=<?php echo $user_id; ?> " target="_blank" class="side-menu__user-avatar">
                    <img src="../assets/instagram-default-icon.png" alt="User Picture">
                </a>
                <div class="side-menu__user-info">
                    <a href="../UX/profil.php" target="_blank"><?php print_r($_SESSION['user']['username']); ?> </a>
                    <span><?php print_r($_SESSION['user']['username']); ?> </span>
                </div>
                <button class="side-menu__user-button">Switch</button>
            </div>
            <div class="side-menu__suggestions-section">
                 <div class="side-menu__suggestions-header">
                    <h2>Suggestions for You</h2>
                </div>

                <?php 
                
                showSuggestedUsers();
                

                ?>
                </div>
        </section>
    </main>

<?php require_once "../components/footer.php"?>