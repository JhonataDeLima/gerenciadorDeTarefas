<?php
require "config.php";
require 'partials/head.php';
?>

<div class="innerform">
    
    <form method="POST" action="signup_action.php"> 
        <h1>Cadastre-se</h1>
        <input placeholder="Digite seu nome" type="name" name="name" />
        </br>
        <input placeholder="Digite seu E-mail" type="email" name="email" />
        </br>
        <input placeholder="Digite sua Senha" type="password" name="password" />
        </br>
        <?php if(!empty($_SESSION['flash'])):?>
            <?=$_SESSION['flash'];?>
            <?=$_SESSION['flash'] = null; ?>
        <?php endif; ?>
        </br>
        <input type="submit" value="Salvar Informações" />
    </form>
    <a href="<?=$base;?>/index.php">Voltar</a>
</div>

<?php require 'partials/footer.php';?>