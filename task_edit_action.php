<?php
require_once "config.php";
require 'models/Auth.php';
require 'dao/TaskDaoMysql.php';
$auth = new Auth($pdo, $base);
$user = $auth->checkToken();


$title = filter_input(INPUT_GET, 'id');
$description = filter_input(INPUT_GET, 'id');
$creat_at = filter_input(INPUT_POST, )
$taskId = filter_input(INPUT_GET, 'id');




$taskDao = new TaskDaoMysql($pdo);
$task = $taskDao->findTaskById($taskId);

    if(!empty($task) && $task['status'] != 'Concluido'){

        $t = new Task();
        $t->id = $task['id'];
        $t->title = $task['title'];
        $t->description = $task['description'];
        $t->status = 'Concluido';
        $t->finish_at = date('Y-m-d H:i:s');
        $t->creat_at = $task['creat_at'];
        $t->user_id = $task['user_id'];        

        $taskDao->updateTask($t);

        header("Location: $base/index.php");
        exit;
    }

header("Location: $base/index.php");



