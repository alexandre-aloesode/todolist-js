<?php

    require_once '../Model/Task.php';

    require_once '../Model/User.php';

    session_start();
    
    try {
    
        $SQL = new PDO('mysql:host=localhost;dbname=todolist;charset=utf8', 'root','');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_memory;charset=utf8', 'Namrod','azertyAZERTY123!');

        $SQL->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    catch (PDOException $e) {

        echo 'Echec de la connexion : ' . $e->getMessage();
        
        exit;
    }


        $request_fetch_tasks = "SELECT *, DATE_FORMAT(date_debut, 'Créée le %d/%m/%Y à %H:%i') AS date_debut, DATE_FORMAT(date_fin, 'Finie le %d/%m/%Y à %H:%i') AS date_fin FROM taches WHERE id_utilisateur = :id_utilisateur";

        $query_fetch_tasks = $SQL->prepare($request_fetch_tasks);

        $query_fetch_tasks->execute(['id_utilisateur' => $_POST['invited_id']]);

        $result_fetch_tasks = $query_fetch_tasks->fetchAll();

        echo json_encode($result_fetch_tasks);

        $_SESSION['invited_id'] = $_POST['invited_id'];

?>