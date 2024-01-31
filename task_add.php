<?php
require_once "config.php";
require 'models/Auth.php';
require 'dao/TaskDaoMysql.php';


$title = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');

$auth = new Auth($pdo, $base);
$user = $auth->checkToken();

if($title && $description){
  
  $taskDao = new TaskDaoMysql($pdo);

  $task = new Task();
  $task->title = $title;
  $task->description = $description;
  $task->user_id = $user->id;
  
  $taskDao->insert($task);
  
  header("Location: $base/index.php");  
  exit;
}

$_SESSION['flash'] = 'Titulo e descrição obrigatorios';
header("Location: $base/index.php");



