<?php

require_once 'models/User.php'; 

class UserDaoMysql implements UserDao {
    private $pdo;

    public function __construct($pdo){  
        $this->pdo = $pdo;
    }

    //MONTA O USUARIO A PARTIR DO ARRAY
    public function generateUser ($array){

        $u = new User();

        $u->id = $array['id'] ?? 0;
        $u->name = $array['name'] ?? '';
        $u->email = $array['email'] ?? '';
        $u->password = $array['password']?? '';
        $u->token = $array['token'] ?? '';

        return $u;
    }

    //RECEBE O TOKEN E BUSCA PELO USUARIO
    public function findByToken($token){
        if(!empty($token)){

            $sql = $this->pdo->prepare("SELECT * FROM users WHERE token = :token");
            $sql->bindValue(':token', $token);
            $sql->execute();

            //VERIFICA SE ENCONTROU E RETORNA O USUARIO
            if($sql->rowCount() > 0){

                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);

                return $user;
            }
        }   
        //NAO ENCONTROU USUARIO OU TOKEN INVALIDO
        return false;
    }

    //RECEBE O EMAIL E BUSCA PELO USUARIO
    public function findByEmail($email){
        if(!empty($email)){

            $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            //VERIFICA SE ENCONTROU E RETORNA O USUARIO
            if($sql->rowCount() > 0){

                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);

                return $user;
            }
        }   
        //NAO ENCONTROU USUARIO OU TOKEN INVALIDO
        return false;
    }

    //ATUALIZA INFORMAÇOES DO USUARIO
    public function update(User $user){
        $sql = $this->pdo->prepare("UPDATE users SET
        name = :name,
        password = :password,
        email = :email,
        token = :token
        WHERE id = :id");

        $sql->bindValue(':id', $user->id);
        $sql->bindValue(':name', $user->name);
        $sql->bindValue(':password', $user->password);
        $sql->bindValue(':email', $user->email);
        $sql->bindValue(':token', $user->token);
        $sql->execute();

        return true;    
    }


    //INSERE USUARIO NO DB
    public function insert(User $u){
        $sql = $this->pdo->prepare("INSERT INTO users 
        (name, email, password, token) 
        VALUES 
        (:name, :email, :password, :token)");

        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':token', $u->token);
        $sql->execute();

        return true;
    }

}