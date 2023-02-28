<?php
    
    try {
    
        $SQL = new PDO('mysql:host=localhost;dbname=todolist;charset=utf8', 'root','');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_memory;charset=utf8', 'Namrod','azertyAZERTY123!');

        $SQL->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    catch (PDOException $e) {

        echo 'Echec de la connexion : ' . $e->getMessage();
        
        exit;
    }




    if(isset($_POST['end_task'])) {

        $request_end_task = "UPDATE taches SET date_fin = NOW(), finie = :finie WHERE id = :id";

        $query_end_task = $SQL->prepare($request_end_task);

        $query_end_task->execute([
            'finie' => 'OUI',
            'id' => $_POST['end_task']
        ]);

        $select_task = "SELECT *, DATE_FORMAT(date_debut, 'Le %d/%m/%Y à %H:%i') AS date_debut, DATE_FORMAT(date_fin, 'Finie le %d/%m/%Y à %H:%i') AS date_fin FROM taches WHERE id = :id";

        $query_select_task = $SQL->prepare($select_task);

        $query_select_task->execute(['id' => $_POST['end_task']]);

        $result_select_task = $query_select_task->fetch();

        echo json_encode($result_select_task);
    }


    if(isset($_POST['modify_task'])) {

        $request_modify_task = "UPDATE taches SET title = :title WHERE id = :id";

        $query_modify_task = $SQL->prepare($request_modify_task);

        $query_modify_task->execute([
            
            'title' => $_POST['title_task'],
            'id' => $_POST['modify_task']
        ]);

        $select_task = "SELECT *, DATE_FORMAT(date_debut, 'Le %d/%m/%Y à %H:%i') AS date_debut, DATE_FORMAT(date_fin, 'Finie le %d/%m/%Y à %H:%i') AS date_fin FROM taches WHERE id = :id";

        $query_select_task = $SQL->prepare($select_task);

        $query_select_task->execute(['id' => $_POST['modify_task']]);

        $result_select_task = $query_select_task->fetch();

        echo json_encode($result_select_task);
    }



    if(isset($_POST['restore_task'])) {

        $request_restore_task = "UPDATE taches SET date_fin = null, finie = :finie WHERE id = :id";

        $query_restore_task = $SQL->prepare($request_restore_task);

        $query_restore_task->execute([
            'finie' => 'NON',
            'id' => $_POST['restore_task']
        ]);

        // $select_task = "SELECT *, DATE_FORMAT(date_debut, 'Le %d/%m/%Y à %H:%i') AS date_debut, DATE_FORMAT(date_fin, 'Finie le %d/%m/%Y à %H:%i') AS date_fin FROM taches WHERE id = :id";

        // $query_select_task = $SQL->prepare($select_task);

        // $query_select_task->execute(['id' => $_POST['restore_task']]);

        // $result_select_task = $query_select_task->fetch();

        // echo json_encode($result_select_task);

        if($query_restore_task) {
            echo json_encode(["success" => true, "message" => "Tâche restaurée"]);
        }
    }


    if(isset($_POST['delete_task'])) {

        $request_delete_task = "DELETE FROM taches WHERE id = :id";

        $query_delete_task = $SQL->prepare($request_delete_task);

        $query_delete_task->execute([
            'id' => $_POST['delete_task']
        ]);

        if($query_delete_task) {

            echo json_encode(["success" => true, "message" => "Tâche supprimée"]);
        }

        // $select_task = "SELECT *, DATE_FORMAT(date_debut, 'Le %d/%m/%Y à %H:%i') AS date_debut, DATE_FORMAT(date_fin, 'Finie le %d/%m/%Y à %H:%i') AS date_fin FROM taches WHERE id = :id";

        // $query_select_task = $SQL->prepare($select_task);

        // $query_select_task->execute(['id' => $_POST['delete_task']]);

        // $result_select_task = $query_select_task->fetch();

        // echo json_encode($result_select_task);
    }
?>