<?php

    class User {

        private ?int $id;

        private ?string $login;

        private ?string $password;

        private ?array $invited;

        private ?array $invitations;



        public function __construct() {

            
        }



        public function setID(?int $id):User {

            $this->id = $id;

            return $this;
        }



        public function getID():int {
            
            return $this->id;
        }

    

        public function setLogin(?string $login):User {

            $this->login = $login;

            return $this;
        }



        public function getLogin():string {
            
            return $this->login;
        }

    

        public function setPassword(?string $password):User {

            $this->password = $password;

            return $this;
        }



        public function getPassword():string {
            
            return $this->password;
        }

        public function getInvited():array {

            return $this->invited;
        }

        public function getInvitations():array {

            return $this->invitations;
        }



        public function register(string $login, string $password) {

            $SQL = new PDO('mysql:host=localhost;dbname=todolist;charset=utf8', 'root','');

            //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

//Pour la gestion des droits d'accès au planning d'autres utilisateurs j'ai besoin d'ajouter l'id de l'user créé en colone des invitations. Je dois donc récupérer la derniere id créée et lui ajouter 1 pour avoir ma valeur
            $request_last_id = "SELECT MAX(id) FROM utilisateurs";

            $query_last_id = $SQL->prepare($request_last_id);

            $query_last_id->execute();

            $result_last_id = $query_last_id->fetchAll();

            $id_to_create = $result_last_id[0][0] + 1;  

            $request_create_user = "INSERT INTO utilisateurs(login, password, invites, invitations) VALUES (:login, :password, :invites, :invitations)";

            $query_create_user = $SQL->prepare($request_create_user);

            $query_create_user->execute(array(
                ':login' => $login, 
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':invites' => json_encode([$id_to_create]),
                ':invitations' => json_encode([0])
            ));

        }



        public function connect(string $login, string $password) {
            
            $SQL = new PDO('mysql:host=localhost;dbname=todolist;charset=utf8', 'root','');

            //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

            $request_fetch_user = "SELECT * FROM utilisateurs WHERE login = :login";

            $query_fetch_user = $SQL->prepare($request_fetch_user);

            $query_fetch_user->execute(['login' => $login]);

            $result_fetch_user = $query_fetch_user->fetchAll();

            $this->id = (int)$result_fetch_user[0][0];

            $this->login = $login;

            $this->password = $password;

            $this->invited = json_decode($result_fetch_user[0][3]);

            $this->invitations = json_decode($result_fetch_user[0][4]);

            return $this;
        }
    
    }

?>