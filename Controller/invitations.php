<?php

    require_once '../Model/Task.php';

    require_once '../Model/User.php';

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


//Fonction pour sélectionner les invitations qu'a l'utilisateur
if(isset($_POST['load_list'])) {

    $result_select_invitations = [];

    foreach($_SESSION['user']->getInvitations() as $value) {

            $request_select_invitations = "SELECT login, id FROM utilisateurs WHERE id = :id";

            $query_select_invitations = $SQL->prepare($request_select_invitations);

            $query_select_invitations->execute(['id' => $value]);

            array_push($result_select_invitations, $query_select_invitations->fetchAll());
        
    }

    echo json_encode($result_select_invitations);
    
}


if(isset($_POST['display_list'])) {

    $result_display_invitations = [];

    foreach($_SESSION['user']->getInvitations() as $value) {

            $request_display_invitations = "SELECT login FROM utilisateurs WHERE id = :id";

            $query_display_invitations = $SQL->prepare($request_display_invitations);

            $query_display_invitations->execute(['id' => $value]);

            if($value !== $_SESSION['user']->getID()) {

                array_push($result_display_invitations, $query_display_invitations->fetchAll());
            }
    }

    echo json_encode($result_display_invitations);
    
}

//Fonction pour rajouter un invité grâce à son pseudo
// if(isset($_POST['add_invited_input'])) {

// //Je commence par récupérer l'id de l'utilisateur qu'on souhaite inviter, puis ses invitations pour les mettre à jour à la fin
//     $request_select_invited_id = "SELECT id, invitations FROM utilisateurs WHERE login = :login";

//     $query_select_invited_id = $SQL->prepare($request_select_invited_id);

//     $query_select_invited_id->execute(['login' => $_POST['add_invited_input']]);

//     $result_select_invited_id = $query_select_invited_id->fetchAll();

// //Ensuite je récupère la colonne des invites qu'a déjà l'utilisateur

//     if($request_select_invited_id) {

//         $request_user_invited = "SELECT invites FROM utilisateurs WHERE id = :id";

//         $query_user_invited = $SQL->prepare($request_user_invited);

//         $query_user_invited->execute(['id' => $_SESSION['user']->getID()]);

//         $result_user_invited = $query_user_invited->fetchAll();

//         $invited_update = json_decode($result_user_invited[0][0]);

// //Puis je la mets à jour en ajoutant l'invité
//         array_push($invited_update, $result_select_invited_id[0][0]);

//         $request_add_invited = "UPDATE utilisateurs SET invites = :invites WHERE id = :id";

//         $query_add_invited = $SQL->prepare($request_add_invited);

//         $query_add_invited->execute([

//             'invites' => json_encode($invited_update),
//             'id' => $_SESSION['user']->getID()]);

// //Enfin je rajoute à l'invité dans sa colonne invitations l'id de l'utilisateur
//         $invitations_update = json_decode($result_select_invited_id[0][1]);

//         array_push($invitations_update, $_SESSION['user']->getID());

//         $request_update_invitations = "UPDATE utilisateurs SET invitations = :invitations WHERE id = :id";

//         $query_update_invitations = $SQL->prepare($request_update_invitations);

//         $query_update_invitations->execute([

//             'invitations' => json_encode($invitations_update),
//             'id' => $result_select_invited_id[0][0]
//         ]);
//         echo json_encode(["success" => true, "message" => "Utilisateur ajouté"]);
//     }

//     else {

//         echo json_encode(["success" => false, "message" => "Cet utilisateur n'existe pas"]);


//     }
// }

?>