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


    <div class="coluns">
        <form method="POST" action="<?=$base;?>\task_add.php">
            <input type="text" name="title" />
            <input type="text" name="description" />
            <input type="submit" value="Adicionar" />
            <?php if(!empty($_SESSION['flash'])):?>
                <?=$_SESSION['flash'];?>
                <?=$_SESSION['flash'] = null; ?>
            <?php endif; ?>
        </form>


    </div>

    <div class="coluns">
                <div class="action" id="regular"><div class="t"><h3>REGULAR</h3></div></div>

        <?php foreach ($tasks as $item):?>
            <div class="regular">
                <div class="task">  
                        <h1 style="display: none;"><?=$item['id'];?></h1>
                        <h3><?=$item['title'];?></h3>
                        <p><?=$item['description'];?></p>
                        <a href="<?=$base;?>/task_edit.php?id=<?=$item['id'];?>"><img title="iniciar" src="<?=$base;?>/assets/img/iniciar.png"/></a>
                        <a href="<?=$base;?>/task_finish.php?id=<?=$item['id'];?>"><img title="concluir" src="<?=$base;?>/assets/img/concluir.png"/></a>
                        <a href="<?=$base;?>/task_delet.php?id=<?=$item['id'];?>"><img title="apagar" src="<?=$base;?>/assets/img/apagar.png"/></a>
                </div>           
            </div>
        <?php endforeach; ?>

    </div>

    <div class="coluns">
        <div class="action" id="importante"><h3>IMPORTANTE</h3></div>

<?php foreach ($tasks as $item):?>
    <div class="task1">
                <h1><?=$item['id'];?></h1>
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

<div class="coluns">
    <div class="action" id="urgente"><h3>URGENTE</h3></div>

<?php foreach ($tasks as $item):?>
    <div class="task1">
                <h1><?=$item['id'];?></h1>
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


<div class="coluns">
    <div class="action" id="andamento"><h3>EM ANDAMENTO</h3></div>

<?php foreach ($tasks as $item):?>
    <div class="task1">
                <h1 style="display: none;"><?=$item['id'];?></h1>
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


<div class="coluns">
    <div class="action" id="concluido"><h3>CONCLUIDO</h3></div>

<?php foreach ($tasks as $item):?>
    <div class="task1">
                <h1><?=$item['id'];?></h1>
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