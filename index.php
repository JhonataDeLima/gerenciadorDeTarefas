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
        <div class="action" id="new"><div class="t"><h3>NOVA TAREFA</h3></div></div>

        <div class="formTask">
            <form method="POST" action="<?=$base;?>/task_add.php">
                <label>Titulo: <input type="text" name="title" /></label></br>
                <label>Descrição: <input type="text" name="description" /></label>
                <fieldset>
                    <legend>Prioridade</legend>
                    <label>
                        <input type="radio" name="priority" value="regular" checked />
                        Regular
                        <input type="radio" name="priority" value="importante"/>
                        Importante
                        <input type="radio" name="priority" value="urgente"/>
                        Urgente
                    </label>
                </fieldset>
                <input type="submit" value="Adicionar" />
            </form>
        </div>
    </div>


    <div class="coluns">
        <div class="action" id="regular"><div class="t"><h3>REGULAR</h3></div></div>

        <?php foreach ($tasks as $item):?>
            <?php 
                //DATA DE CRIAÇÃO 
                $dateC = Auth::dateTimeConverter($item['creat_at']);
                //DATA DE CONCLUSÃO
                $dateF = Auth::dateTimeConverter($item['finish_at']);
                 ?>

                 
            <?php if($item['priority'] != 'regular') continue;?>
            <?php if($item['status'] == 'concluido' || $item['status'] == 'andamento' ) continue;?>
            <div class="tasks" id="tasksRegular">

                <div class="task">
                        <h1 style="display: none;"><?=$item['id'];?></h1>
                        <h3><?=$item['title'];?></h3>
                        <p><?=$item['description'];?></p>

                    <div class="po">
                        <div class="taskIcons">
                            <a href="<?=$base;?>/task_start.php?id=<?=$item['id'];?>"><img title="iniciar" src="<?=$base;?>/assets/img/iniciar.png"/></a>
                            <a href="<?=$base;?>/task_finish.php?id=<?=$item['id'];?>"><img title="concluir" src="<?=$base;?>/assets/img/concluir.png"/></a>
                            <a href="<?=$base;?>/task_delet.php?id=<?=$item['id'];?>"><img title="apagar" src="<?=$base;?>/assets/img/apagar.png"/></a>
                        </div>
                        <div class="taskDates">
                            <div class="date" ><b>inicio:</b> <p id="dateStart"><?=$dateC[0];?></p></div>
                            <div class="date" ><b>fim:_</b> <p id="dateDone"><?=$dateF[0];?></p></div>
                        </div> 
                    </div>
                </div> 
                          
            </div>
        <?php endforeach; ?>
    </div>


    <div class="coluns">
        <div class="action" id="importante"><h3>IMPORTANTE</h3></div>

        <?php foreach ($tasks as $item):?>
            <?php 
                //DATA DE CRIAÇÃO 
                $dateC = Auth::dateTimeConverter($item['creat_at']);
                //DATA DE CONCLUSÃO
                $dateF = Auth::dateTimeConverter($item['finish_at']);
                 ?>

            <?php if($item['priority'] != 'importante') continue;?>
            <?php if($item['status'] == 'concluido' || $item['status'] == 'andamento' ) continue;?>
            <div class="tasks" id="tasksImportante">

                <div class="task">
                        <h1 style="display: none;"><?=$item['id'];?></h1>
                        <h3><?=$item['title'];?></h3>
                        <p><?=$item['description'];?></p>

                    <div class="po">
                        <div class="taskIcons">
                            <a href="<?=$base;?>/task_start.php?id=<?=$item['id'];?>"><img title="iniciar" src="<?=$base;?>/assets/img/iniciar.png"/></a>
                            <a href="<?=$base;?>/task_finish.php?id=<?=$item['id'];?>"><img title="concluir" src="<?=$base;?>/assets/img/concluir.png"/></a>
                            <a href="<?=$base;?>/task_delet.php?id=<?=$item['id'];?>"><img title="apagar" src="<?=$base;?>/assets/img/apagar.png"/></a>
                        </div>
                        <div class="taskDates">
                            <div class="date" ><b>inicio:</b> <p id="dateStart"><?=$dateC[0];?></p></div>
                            <div class="date" ><b>fim:_</b> <p id="dateDone"><?=$dateF[0];?></p></div>
                        </div> 
                    </div>
                </div> 
                          
            </div>
        <?php endforeach; ?>
    </div>

    <div class="coluns">
        <div class="action" id="urgente"><h3>URGENTE</h3></div>

        <?php foreach ($tasks as $item):?>
            <?php 
                //DATA DE CRIAÇÃO 
                $dateC = Auth::dateTimeConverter($item['creat_at']);
                //DATA DE CONCLUSÃO
                $dateF = Auth::dateTimeConverter($item['finish_at']);
                 ?>


            <?php if($item['priority'] != 'urgente') continue;?>
            <?php if($item['status'] == 'concluido' || $item['status'] == 'andamento' ) continue;?>
            <div class="tasks" id="tasksUrgente">

                <div class="task">
                        <h1 style="display: none;"><?=$item['id'];?></h1>
                        <h3><?=$item['title'];?></h3>
                        <p><?=$item['description'];?></p>

                    <div class="po">
                        <div class="taskIcons">
                            <a href="<?=$base;?>/task_start.php?id=<?=$item['id'];?>"><img title="iniciar" src="<?=$base;?>/assets/img/iniciar.png"/></a>
                            <a href="<?=$base;?>/task_finish.php?id=<?=$item['id'];?>"><img title="concluir" src="<?=$base;?>/assets/img/concluir.png"/></a>
                            <a href="<?=$base;?>/task_delet.php?id=<?=$item['id'];?>"><img title="apagar" src="<?=$base;?>/assets/img/apagar.png"/></a>
                        </div>
                        <div class="taskDates">
                            <div class="date" ><b>inicio:</b> <p id="dateStart"><?=$dateC[0];?></p></div>
                            <div class="date" ><b>fim:_</b> <p id="dateDone"><?=$dateF[0];?></p></div>
                        </div> 
                    </div>
                </div> 
                          
            </div>
        <?php endforeach; ?>
    </div>


    <div class="coluns">
        <div class="action" id="andamento"><h3>EM ANDAMENTO</h3></div>

        <?php foreach ($tasks as $item):?>
            <?php 
                //DATA DE CRIAÇÃO 
                $dateC = Auth::dateTimeConverter($item['creat_at']);
                //DATA DE CONCLUSÃO
                $dateF = Auth::dateTimeConverter($item['finish_at']);
                 ?>


            <?php if($item['status'] != 'andamento') continue;?>
            <div class="tasks" id="tasksAndamento">

                <div class="task">
                        <div class="priority"> <p>Prioridade:  <?=$item['priority'];?></p></div>
                        <h3><?=$item['title'];?></h3>
                        <p><?=$item['description'];?></p>

                    <div class="po">
                        <div class="taskIcons">
                            <a href="<?=$base;?>/task_start.php?id=<?=$item['id'];?>"><img title="iniciar" src="<?=$base;?>/assets/img/iniciar.png"/></a>
                            <a href="<?=$base;?>/task_finish.php?id=<?=$item['id'];?>"><img title="concluir" src="<?=$base;?>/assets/img/concluir.png"/></a>
                            <a href="<?=$base;?>/task_delet.php?id=<?=$item['id'];?>"><img title="apagar" src="<?=$base;?>/assets/img/apagar.png"/></a>
                        </div>
                        <div class="taskDates">
                            <div class="date" ><b>inicio:</b> <p id="dateStart"><?=$dateC[0];?></p></div>
                            <div class="date" ><b>fim:_</b> <p id="dateDone"><?=$dateF[0];?></p></div>
                        </div> 
                    </div>
                </div> 
                          
            </div>
        <?php endforeach; ?>
    </div>


    <div class="coluns">
        <div class="action" id="concluido"><h3>CONCLUIDO</h3></div>

        <?php foreach ($tasks as $item):?>
            <?php 
                //DATA DE CRIAÇÃO 
                $dateC = Auth::dateTimeConverter($item['creat_at']);
                //DATA DE CONCLUSÃO
                $dateF = Auth::dateTimeConverter($item['finish_at']);
                 ?>


            <?php if($item['status'] != 'concluido') continue;?>
            <div class="tasks" id="tasksConcluido">

                <div class="task">
                        <div class="priority"> <p>Prioridade:  <?=$item['priority'];?></p></div>
                        <h3><?=$item['title'];?></h3>
                        <p><?=$item['description'];?></p>

                    <div class="po">
                        <div class="taskIcons">
                            <a href="<?=$base;?>/task_start.php?id=<?=$item['id'];?>"><img title="iniciar" src="<?=$base;?>/assets/img/iniciar.png"/></a>
                            <a href="<?=$base;?>/task_finish.php?id=<?=$item['id'];?>"><img title="concluir" src="<?=$base;?>/assets/img/concluir.png"/></a>
                            <a href="<?=$base;?>/task_delet.php?id=<?=$item['id'];?>"><img title="apagar" src="<?=$base;?>/assets/img/apagar.png"/></a>
                        </div>
                        <div class="taskDates">
                            <div class="date" ><b>inicio:</b> <p id="dateStart"><?=$dateC[0];?></p></div>
                            <div class="date" ><b>fim:_</b> <p id="dateDone"><?=$dateF[0];?></p></div>
                        </div> 
                    </div>
                </div> 
                          
            </div>
        <?php endforeach; ?>
    </div>





</div>

<?php require 'partials/footer.php'; ?>