<?php
require 'partials/head.php';
require "config.php";
?>

<div class="innerform">

<form class="login" method="POST" action="login_action.php">
    <div id="login"><h1>LOGIN</h1></div></br><bbr>
    
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
    <input type="submit" value="Entrar" /></br></br>
    <a href="<?=$base;?>/signup.php">não possui cadastro ? cadastre-se</a>
</form>

</div>


<?php require 'partials/footer.php';?>