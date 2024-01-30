<?php
session_start();

//CONFIGURA O BASE DE ACORDO COM A PASTA DO SEU PROJETO
$base = 'http://localhost/praticar/gerenciadorDeTarefas';

//INFORMAÇÕES DO BANCO DE DADOS
$db_name = 'gerenciador_db';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);