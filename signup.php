<?php
require "config.php";
require 'partials/head.php';
?>

<div class="innerform">
    
    <form class="cadastro" method="POST" action="signup_action.php"> 
        <div id="cadastro"><h1>Cadastre-se</h1></div></br><br>


        <input placeholder="Digite seu nome" type="name" name="name" />
        </br>
        <input placeholder="Digite seu E-mail" type="email" name="email" />
        </br>
        <input placeholder="Digite sua Senha" type="password" name="password" />
        </br>
        <?php if(!empty($_SESSION['flash'])):?>
            <?php echo"</br>";?>
            <?php echo "<font color=".'red'.">";?>
            <?=$_SESSION['flash'];?>
            <?php echo "</font>";?>
            <?php echo"</br>";?>
            <?=$_SESSION['flash'] = null; ?>
        <?php endif; ?>
        </br>
        <input type="submit" value="Salvar Informações" /></br></br>
        <a href="<?=$base;?>/index.php">Voltar</a>
    </form>
    
</div>

<?php require 'partials/footer.php';?>