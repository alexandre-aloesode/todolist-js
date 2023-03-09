<link rel="stylesheet" href="todolist.css">

<?php 

    require_once '../Model/User.php';

    session_start();

    if(isset($_POST['deco'])) {
            
        session_destroy();

        header('Location: ../View/index.php');
    }

?>

<nav>
    
    <a href="index.php">Accueil</a>

    <?php if(isset($_SESSION['user'])): ?>


        <form method="POST" id ="deco_form">
            <button type="submit" name="deco" id="deco">Déconnexion</button>
        </form>

    <?php else: ?>

        <!-- <a href="../View/connexion.php">Connexion</a>

        <a href="../View/inscription.php">Inscription</a> -->

    <?php endif ?>
        
</nav>

