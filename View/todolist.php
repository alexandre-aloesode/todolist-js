<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="todolist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>ToDoList</title>
    <script defer src="../Controller/tasks.js"></script>
</head>
<body>

    <?php require_once '../View/header.php' ?>

    <main>

        <div id="boards_list">
            
            <!-- <label>utilisateurs</label> -->
            
            <select id="boards_select">

            </select>

        </div>

        <form method="POST" id="list_form">

            <input type="text" name="task_title" id="list_input" placeholder="Intitulé">

            <button type="submit" id="add_task_button">Ajouter une tâche</button>

        </form>

        <button id="users_button">Gestion des droits</button>

        <div id="users_management">

            <i class="fa-regular fa-circle-xmark" id="users_cross"></i>

            <div id="invitations_list_div">

                <h2>Mes invitations</h2>

                <div id="invitations_list">
                </div>

            </div>

            <div id="invited_list_div">

                <h2>Mes invités</h2>

                <div id="invited_list">
                </div>

            </div>

            <form method="POST" id="add_invited_form">

                <h2>Ajouter un utilisateur</h2>

                <input type="text" id="add_invited_input" name="add_invited_input" placeholder="Pseudo">
                    <div id="suggestions">

                    </div>
                <button type="submit" name="add_invited" id="add_invited_button">Ajouter</button>
                
            </form> 

            
            
        </div>

        <div id="display_task_board">

            <i class="fa-regular fa-circle-xmark" id="task_cross"></i>

            <form method="POST" id="modify_title_form">

                <input type="text" id="modify_title_input">

                <button type="submit" id="modify_title_button">Modifier</button>

            </form>

            <h3 id="display_start_date">Créée le:</h3>
            
            <!-- <form method="POST" id="modify_title_form">

                <span>Ajouter une sous-tâche</span>

                <input type="text" id="add_user">

                <button type="submit" id="modify_task_button">Ajouter</button>

            </form> -->
                
        </div>

        <div id="tasks_display">

            <div id="to_do_area">

                <h1>Tâches à réaliser</h1>

                <div id="to_do">

                </div>
                
            </div>

            <div id="done_area">       

                <h1>Tâches terminées</h1>

                <div id="done">

                </div>

            </div>
        </div>
    </main>
    
</body>
</html>