


<div class="addTask">
        <form method="POST" action="<?=$base;?>\task_add.php?id=<?=$item['id'];?>">
            <input type="text" name="title" value="<?=$item['id'];?>"/>
            <input type="text" name="description" value="<?=$item['id'];?>"/>
            <input type="submit" value="Adicionar" value="<?=$item['id'];?>" />
            <?php if(!empty($_SESSION['flash'])):?>
                <?=$_SESSION['flash'];?>
                <?=$_SESSION['flash'] = null; ?>
            <?php endif; ?>
        </form>


    </div>
