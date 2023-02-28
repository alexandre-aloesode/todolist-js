<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script defer src="../Controller/index_display.js"></script>
    <script defer src="../Controller/connexion.js"></script>
    <script defer src="../Controller/register.js"></script>
    <title>Accueil</title>
</head>

<body>

    <?php require_once '../View/header.php' ?>

    <main>

        <button id="show_register_form">S'inscrire</button>
        <button id="show_connexion_form">Se connecter</button>

        <form method="POST" id="register_form">

            <label id="login_error"></label>
            <input type="text" name="register_login" id="register_login" placeholder="Pseudo">
            
            <input type="password" name="register_password" id="register_password" placeholder="Mot de passe">
            <label id="password_error"></label>
            <input type="password" name="register_confirm_password" id="register_confirm_password" placeholder="Confirmez votre mot de passe">

            <button type="submit" name="register" id="register_button">Inscription</button>

        </form>


        <form method="POST" id="connexion_form">

        <label id="connexion_error"></label>

            <input type="text" name="connexion_login" id="connexion_login" placeholder="Pseudo">

            <input type="password" name="connexion_password" id="connexion_password" placeholder="Mot de passe">

            <button type="submit" name="Connexion" id="connexion_button">Connexion</button>

        </form>

    </main>
    
</body>
</html>