<?php

    class Task {

        private ?int $id_task;

        private ?string $title;

        private ?int $id_user;

        private ?DateTime $start_date;

        private ?DateTime $end_date;



        public function __construct() {
            
        }



        public function add_task(string $title, int $id_user) {

            $this->start_date = new DateTime();

            $SQL = new PDO('mysql:host=localhost;dbname=todolist;charset=utf8', 'root','');

            //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');


            $request_add_task = "INSERT INTO `taches`(`title`, `date_debut`, `id_utilisateur`, `finie`) VALUES (:title, NOW(), :id_utilisateur, :finie)";

            $query_add_task = $SQL->prepare($request_add_task);

            $parameter = [

                'title' => $title,
                'id_utilisateur' => $id_user,
                'finie' => 'NON'
            ];

            $query_add_task->execute($parameter);

        }



    }

?>