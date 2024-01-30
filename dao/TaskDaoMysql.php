<?php

require_once 'models/Task.php';

class TaskDaoMysql implements taskDao {
    private $pdo;

    public function __construct(PDO $pdo){

        $this->pdo = $pdo;

    }


    public function select($user_id){

        $sql = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = :id");
        $sql->bindValue(':id', $user_id);
        $sql->execute();
        $array = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    public function insert(Task $t){

        $sql = $this->pdo->prepare('INSERT INTO tasks (
            title, description, status, user_id, creat_at
            ) VALUES (
            :title, :description, :status, :user_id, :creat_at
            )');

        $sql->bindValue(':title', $t->title);
        $sql->bindValue(':description', $t->description);
        $sql->bindValue(':status', $t->status); 
        $sql->bindValue(':user_id', $t->user_id);
        $sql->bindValue(':creat_at', $t->creat_at);
        $sql->execute();

        
    }


    public function findTaskById($id){
        $sql = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
        $task = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $task;

        }

        return null;
    }

    public function updateTask(Task $t){
        
        $sql = $this->pdo->prepare("UPDATE tasks SET

            title = :title,
            description = :description,
            status = :status,
            creat_at = :creat_at,
            finish_at = :finish_at,
            user_id = :user_id

        WHERE id = :id");

        $sql->bindValue(':id', $t->id);
        $sql->bindValue(':title', $t->title);
        $sql->bindValue(':description', $t->description);
        $sql->bindValue(':status', $t->status); 
        $sql->bindValue(':user_id', $t->user_id);
        $sql->bindValue(':creat_at', $t->creat_at);
        $sql->bindValue(':finish_at', $t->finish_at);
        $sql->execute();

        return true;

    }

    public function deletTask($t){
        $sql = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $sql->bindValue(':id', $t['id']);
        $sql->execute();

        return true;
    }

}