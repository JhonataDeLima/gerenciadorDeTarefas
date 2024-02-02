<?php

require_once 'dao/UserDaoMysql.php';

class Auth {
    
    private $pdo;
    private $base;
    
    //RECEBE OS DADOS PARA MONTAR A AUTENTICAÇÃO
    public function __construct(PDO $pdo, $base){
        $this->pdo = $pdo;
        $this->base = $base;

    }

    
    public function checkToken(){
        //VERIFICA SE A SESSION ESTÁ PREENCHIDA COM TOKEN
        if(!empty($_SESSION['token'])){
            //GUARDA O TOKEN E VERIFICA SE É VALIDO
            $token = $_SESSION['token'];
            $userDao = new UserDaoMysql($this->pdo);
            $user = $userDao->findByToken($token);

            //USUARIO ENCONTADO ?? RETORNA O USUARIO
            if($user){

                return $user;
            }
        }

        //NAO ESTÁ PREENCHIA ou TOKEN INVALIDO ?? REDIRECIONA PARA PAGINA DE LOGIN
        header("Location: ".$this->base."/login.php");
        exit;
    }

     
    public function validateLogin($email, $senha){
        //BUSCA USUARIO ATRAVEZ DO EMAIL
        $userDao = new UserDaoMysql($this->pdo);
        $user = $userDao->findByEmail($email);

        if($user){
            //ENCONTROU USUARIO ? VERIFICA PASSWORD
            if(password_verify($senha, $user->password)){
                //LOGIN REALIZADO (INICIA SESSÃO E ATUALIZA TOKEN)
                $token = md5(time().rand(0, 9999));

                $_SESSION['token'] = $token;
                $user->token = $token;
                $userDao->update($user);

                return true;
            }
        }
        //ENCONTROU USUARIO
        return false;
    }

    //VERIFICA DE O EMAIL JA ESTA EM USO E RETORNA TRUE OU FALSE
    public function checkEmailExists($email){

        $userDao = new UserDaoMysql($this->pdo);
        $user = $userDao->findByEmail($email);

        if($user){

            return true;
            exit;
        }
        
        return false;
    }


    //REGISTRO DE USUARIO
    public function registerUser($name, $email, $password){
        $userDao = new UserDaoMysql($this->pdo);
        
        //GERA UM HASH ATRAVEZ DO PASSWORD
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        //GERA UM HASH DO TOKEN PARA O LOGIN
        $token = md5(time().rand(0, 9999));

        //MONTA O USUARIO PARA ADICIONAR AO DB
        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $hash;
        $newUser->token = $token;

        //ADICIONA O USUARIO
        $userDao->insert($newUser);

        //INICIA SESSION PARA LOGAR O USUARIO
        $_SESSION['token'] = $token;

    }

    //CONVERTE CONVERTE DATE_HORA PARA PADRÃO BR
    public static function dateTimeConverter($dateTime){
        if($dateTime){
            list($date, $hour) = explode(" ", $dateTime);
            $date = explode("-", $date);
            $date = $date[2]."/".$date[1]."/".$date[0];
           
            return array($date, $hour); 
        }
            
            return array(' ');
        
    }   
}