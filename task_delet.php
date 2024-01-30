<?php
require_once "config.php";
require 'models/Auth.php';
require 'dao/TaskDaoMysql.php';
$auth = new Auth($pdo, $base);
$user = $auth->checkToken();

$taskId = filter_input(INPUT_GET, 'id');

$taskDao = new TaskDaoMysql($pdo);
$task = $taskDao->findTaskById($taskId);

    if(!empty($task)){

        $taskDao->deletTask($task);

        header("Location: $base/index.php");
        exit;
    }

header("Location: $base/index.php");