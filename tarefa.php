<?php
require "config.php";
require "models/Auth.php";
require 'partials/head.php';
require 'dao/TaskDaoMysql.php';

$auth = new Auth($pdo, $base);
$user = $auth->checkToken();

$taskDao = new TaskDaoMysql($pdo);
$tasks = $taskDao->select($user->id);

?>



<form>
     <fieldset>
        <legend>Nova tarefa</legend>
            <label>
                Titulo:
                <input type="text" name="nome" id=”name”/>
            </label>
            </br>
                <label>
                    Descrição:
                    <input type="text" name="nome" id=”name”/>
                </label>
            </br>
                <fieldset>
                    <legend>Status:</legend>
                    <label>
                        <input type="radio" name="status" value="pendente" checked />
                            Pendente
                        <input type="radio" name="status" value="andamento" />
                            Em Andamento
                        <input type="radio" name="status" value="concluido" />
                            Concluido
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Prioridade:</legend>
                    <label>
                        <input type="radio" name="priority" value="low" checked />
                            Baixa
                        <input type="radio" name="priority" value="midle" />
                            Média
                        <input type="radio" name="priority" value="hight" />
                            Alta
                    </label>
                </fieldset>


                    <input type="submit" value="Adicionar" />
    </fieldset>
</form>