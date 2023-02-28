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

    if(isset($_GET['search'])) {

        $request_exact_user= "SELECT login FROM utilisateurs WHERE login LIKE :login LIMIT 10";
            
        $query_exact_user = $SQL->prepare($request_exact_user);

        $query_exact_user->execute(['login' => "%{$_GET['search']}%"]);

        $result_exact_user = $query_exact_user->fetchAll();


        // if(count($result_exact_user) < 10) {

        //     $limit = 10 - count($result_exact_user);
        
        //     $request_contain_user = "SELECT login FROM utilisateurs WHERE login LIKE :login LIMIT $limit";
            
        //     $query_contain_user = $SQL->prepare($request_contain_user);

        //     $query_contain_user->execute(['login' => "%{$_GET['search']}%"]);

        //     $result_contain_user = $query_contain_user->fetchAll();

            
        //     $all_result = array_merge($result_exact_user, $result_contain_user);

        //     echo json_encode($all_result);
        // }

        // else {

            echo json_encode($result_exact_user);
        // }
    }

?>