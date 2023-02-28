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


        if(isset($_POST['register_login']) && isset($_POST['register_password']) && isset($_POST['register_confirm_password'])) {
           
                $request_fetch_user = "SELECT * FROM utilisateurs WHERE login = :login";

                $query_fetch_user = $SQL->prepare($request_fetch_user);

                $query_fetch_user->execute(['login' => $_POST['register_login']]);

                $result_fetch_user = $query_fetch_user->fetchAll();

                if(!empty($result_fetch_user)) {

                        echo json_encode(["success" => false, "message" => "Ce pseudo existe déjà"]);

                }

                elseif(empty($result_fetch_user)) {

                        require_once '../Model/User.php';

                        $submiter = new User();

                        $submiter->register($_POST['register_login'], $_POST['register_password']);

                        echo json_encode(["success" => true, "message" => "Compte créé avec succès"]);
                }
        }


        if(isset($_POST['connexion_login']) && isset($_POST['connexion_password'])) {

                $request_fetch_user = "SELECT * FROM utilisateurs WHERE login = :login";
        
                $query_fetch_user = $SQL->prepare($request_fetch_user);
        
                $query_fetch_user->execute(['login' => $_POST['connexion_login']]);
        
                $result_fetch_user = $query_fetch_user->fetchAll();
        
                if(empty($result_fetch_user)) {
        
                    echo json_encode(["success" => false, "message" => "Identifiant ou mot de passe erronné"]);
                }
        
                elseif(!empty($result_fetch_user)) {
        
                    if(password_verify($_POST['connexion_password'], $result_fetch_user[0][2])) {
        
                        require_once '../Model/User.php';
        
                        if(session_id() == '') session_start();
        
                        $user = new User();
        
                        $_SESSION['user'] = $user->connect($_POST['connexion_login'], $_POST['connexion_password']);
        
                        echo json_encode(["success" => true, "message" => "Connexion réussie"]);
        
                    }
        
                    else {
        
                        echo json_encode(["success" => false, "message" => "Identifiant ou mot de passe erronné"]);
                    }
        
                }
            }
        
?>