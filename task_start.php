<?php
require_once "config.php";
require 'models/Auth.php';
require 'dao/TaskDaoMysql.php';
$auth = new Auth($pdo, $base);
$user = $auth->checkToken();



$taskId = filter_input(INPUT_GET, 'id');




$taskDao = new TaskDaoMysql($pdo);
$task = $taskDao->findTaskById($taskId);

    
    if(!empty($task) && $task['status'] != 'concluido' && $task['status'] != 'andamento'){

        $t = new Task();
        $t->id = $task['id'];
        $t->title = $task['title'];
        $t->description = $task['description'];
        $t->status = 'andamento';
        $t->priority = $task['priority'];
        $t->finish_at = null;
        $t->creat_at = $task['creat_at'];
        $t->user_id = $task['user_id'];        

        $taskDao->updateTask($t);

        header("Location: $base/index.php");
        exit;
    }
    
    if(!empty($task) && $task['status'] != 'concluido' && $task['status'] != 'pendente'){

        $t = new Task();
        $t->id = $task['id'];
        $t->title = $task['title'];
        $t->description = $task['description'];
        $t->status = 'pendente';
        $t->priority = $task['priority'];
        $t->finish_at = null;
        $t->creat_at = $task['creat_at'];
        $t->user_id = $task['user_id'];        

        $taskDao->updateTask($t);

        header("Location: $base/index.php");
        exit;
    }

header("Location: $base/index.php");



