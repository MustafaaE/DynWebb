<?php
require_once "../components/methods.php";
require_once "../components/header.php";
require_once "../interface/connection.php";
isUserLoggedIn();

$user_id =$_SESSION['user']['user_id'];
$username = $_SESSION['user']['username'];
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
                <a href="../UX/profil.php?id=<?php echo $user_id; ?> "  class="side-menu__user-avatar">
                    <img src="../assets/instagram-default-icon.png" alt="User Picture">
                </a>
                <div class="side-menu__user-info">
                    <a href="../UX/profil.php?id=<?php echo $user_id; ?> "><?php print_r($_SESSION['user']['username']); ?>
                    </a>
                </div>
            </div>
            <div class="side-menu__suggestions-section">
                 <div class="side-menu__suggestions-header">
                    <h2>Suggestions for You</h2>
                </div>

                <?php showSuggestedUsers(); ?>
                </div>
        </section>
    </main>

<?php require_once "../components/footer.php"?>