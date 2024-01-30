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

<div class="home">


    <div class="addTask">
        <form method="POST" action="taskAction">
            <input type="text" name="title" />
            <input type="text" name="description" />
            <input type="submit" value="Adicionar" />
            <?php if(!empty($_SESSION['flash'])):?>
                <?=$_SESSION['flash'];?>
                <?=$_SESSION['flash'] = null; ?>
            <?php endif; ?>
        </form>


    </div>

    <div class="task">

        <?php foreach ($tasks as $item):?>
            <div class="task1">
                        <h1><?=$item['title'];?></h1>
                        <h3><?=$item['status'];?></h3>
                        <div class="desc"><p><?=$item['description'];?></p></div>
                        <h3>Inicio: <?=$item['creat_at'];?></h3><h3>Fim: <?=$item['finish_at'];?></h3>
                        <div class="botao"><a href="<?=$base;?>/task_finish.php?id=<?=$item['id'];?>"><button>CONCLUIR</button></a></div>
                        <div class="botao"><a href="<?=$base;?>/task_edit.php?id=<?=$item['id'];?>"><button>EDITAR</button></a></div>
                        <div class="botao"><a href="<?=$base;?>/task_delet.php?id=<?=$item['id'];?>"><button>EXCLUIR</button></a></div>           
            </div>
        <?php endforeach; ?>

    </div>




</div>

<?php require 'partials/footer.php'; ?>