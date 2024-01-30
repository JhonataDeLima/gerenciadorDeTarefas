<?php
require 'partials/head.php';
require "config.php";
?>

<div class="innerform">

<form method="POST" action="login_action.php">
<h1>Login</h1>

    
    <input placeholder="Digite seu E-mail" type="email" name="email" />
    </br>   
    <input placeholder="Digite sua Senha" type="password" name="password" />
    </br>
        <?php if(!empty($_SESSION['flash'])):?>
        <?=$_SESSION['flash'];?>
        <?=$_SESSION['flash'] = null; ?>
        <?php endif; ?>
    </br>
    <input type="submit" value="Login" />
</form>
<a href="<?=$base;?>/signup.php">não possui cadastro ? cadastre-se</a>
</div>


<?php require 'partials/footer.php';?>