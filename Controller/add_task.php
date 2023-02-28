<?php

    require_once '../Model/Task.php';
    require_once '../Model/User.php';

    session_start();

    $task = new Task();

    if(isset($_SESSION['invited_id'])) {
        
        $task->add_task($_POST['task_title'], $_SESSION['invited_id']);

    }

    else {

        $task->add_task($_POST['task_title'], $_SESSION['user']->getId());

    }
?>