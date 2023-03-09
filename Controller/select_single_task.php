<?php

    session_start();
    
    try {
    
        $SQL = new PDO('mysql:host=localhost;dbname=todolist;charset=utf8', 'root','');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $SQL->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    catch (PDOException $e) {

        echo 'Echec de la connexion : ' . $e->getMessage();
        
        exit;
    }

    
    $select_task = "SELECT *, DATE_FORMAT(date_debut, '%d/%m/%Y à %H:%i') AS date_debut, DATE_FORMAT(date_fin, 'Finie le %d/%m/%Y à %H:%i') AS date_fin FROM taches WHERE id = :id";

    $query_select_task = $SQL->prepare($select_task);

    $query_select_task->execute(['id' => $_POST['task_number']]);

    $result_select_task = $query_select_task->fetch();

    echo json_encode($result_select_task);

   
?>