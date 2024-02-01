<?php

class Task{
    
    public $id;
    public $title;
    public $description;
    public $creat_at;
    public $finish_at;
    public $status;
    public $priority;
    public $user_id;

    public function __construct(){

        $this->creat_at = date('Y-m-d H:i:s');
        $this->status = 'pendente';
    }


}

interface TaskDao {

    public function select($user_id);
    public function insert(Task $t);
    public function findTaskById($id);
    
}