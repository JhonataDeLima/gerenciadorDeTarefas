<?php
require 'config.php';
require 'models/Auth.php';


$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');


$auth = new Auth($pdo, $base);

if($name && $email && $password){

    if($auth->checkEmailExists($email) === false){

        $auth->registerUser($name, $email, $password);

        header("Location: $base/index.php");
        exit;

    }else{

        $_SESSION['flash'] = 'E-mail já cadastrado!';
        header("Location: $base/signup");
        exit;
    }

}

$_SESSION['flash'] = 'Digite as informações corretamente';
header("Location: $base/signup");